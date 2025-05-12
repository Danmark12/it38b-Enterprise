<?php
session_start();
require '../feature/config.php';

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../feature/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Handle form submission for new appointment
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['appointment_date'], $_POST['description'])) {
    $appointment_date = $_POST['appointment_date'];
    $description = $_POST['description'];

    // Insert the new appointment into the database
    $stmt = $conn->prepare("INSERT INTO appointments (user_id, appointment_date, description, status) VALUES (?, ?, ?, 'pending')"); // Set default status to 'pending'
    $stmt->execute([$user_id, $appointment_date, $description]);

    // Optionally, you might want to fetch the newly inserted appointment again for immediate display
    $stmtNewAppt = $conn->prepare("SELECT * FROM appointments WHERE user_id = ? ORDER BY appointment_date DESC LIMIT 1");
    $stmtNewAppt->execute([$user_id]);
    $newAppointment = $stmtNewAppt->fetch();
}

// Fetch appointment stats for the smaller vertical cards (no longer displayed)
$currentDate = date('Y-m-d');

// $stmtAllCount = $conn->prepare("SELECT COUNT(*) FROM appointments WHERE user_id = ?");
// $stmtAllCount->execute([$user_id]);
// $allCount = $stmtAllCount->fetchColumn();

// $stmtTodayCount = $conn->prepare("SELECT COUNT(*) FROM appointments WHERE user_id = ? AND appointment_date = ?");
// $stmtTodayCount->execute([$user_id, $currentDate]);
// $todayCount = $stmtTodayCount->fetchColumn();

// $stmtUpcomingCount = $conn->prepare("SELECT COUNT(*) FROM appointments WHERE user_id = ? AND appointment_date > ? AND status = 'pending'");
// $stmtUpcomingCount->execute([$user_id, $currentDate]);
// $upcomingCount = $stmtUpcomingCount->fetchColumn();

// $stmtDoneCount = $conn->prepare("SELECT COUNT(*) FROM appointments WHERE user_id = ? AND status = 'completed'");
// $stmtDoneCount->execute([$user_id]);
// $doneCount = $stmtDoneCount->fetchColumn();

// Fetch all user appointments for the main list
$stmtAll = $conn->prepare("SELECT * FROM appointments WHERE user_id = ? ORDER BY appointment_date DESC");
$stmtAll->execute([$user_id]);
$appointments = $stmtAll->fetchAll();

// Fetch monthly appointment summary (for the top-right card)
$currentMonth = date('Y-m');
$stmtMonthlyStats = $conn->prepare("
    SELECT
        COUNT(*) AS total,
        SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) AS pending,
        SUM(CASE WHEN status = 'completed' THEN 1 ELSE 0 END) AS completed
    FROM appointments
    WHERE user_id = ? AND DATE_FORMAT(appointment_date, '%Y-%m') = ?
");
$stmtMonthlyStats->execute([$user_id, $currentMonth]);
$monthlyStats = $stmtMonthlyStats->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointments</title>
    <link rel="stylesheet" href="../patientcss/appointments.css">
</head>
<body>
    <div class="appointment-container">
        <div class="top-section">
            <div class="left-top">
                <div class="request-appointment-box">
                    <h2>Request an appointment</h2>
                    <div class="request-appointment-content">
                        <button class="add-btn small-button" onclick="document.getElementById('appointmentModal').style.display='block'">+ Add Appointment</button>
                        <img src="../image/doctor.jpg" alt="Doctor" class="doctor-illustration-small">
                    </div>
                </div>
                <div class="calendar-only">
                    <div class="calendar">
                        <h3><?= date('F Y') ?></h3>
                        <div id="calendar">
                            <table>
                                <tr><?php foreach (['Su','Mo','Tu','We','Th','Fr','Sa'] as $day) echo "<th>$day</th>"; ?></tr>
                                <?php
                                $firstDay = date('w', strtotime("$currentMonth-01"));
                                $daysInMonth = date('t');
                                $day = 1;
                                for ($i = 0; $i < 6; $i++) {
                                    echo "<tr>";
                                    for ($j = 0; $j < 7; $j++) {
                                        if ($i === 0 && $j < $firstDay || $day > $daysInMonth) {
                                            echo "<td></td>";
                                        } else {
                                            $isToday = ($day == date('j')) ? "background:#5d5dfc;color:white;" : "";
                                            echo "<td style='padding:5px;text-align:center;font-size:0.75em;$isToday'>$day</td>";
                                            $day++;
                                        }
                                    }
                                    echo "</tr>";
                                    if ($day > $daysInMonth) break;
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="right-top">
                <div class="appointment-summary">
                    <div>
                        <h3><?= $monthlyStats['total'] ?? 0 ?></h3>
                        <p>Total Appointments this month</p>
                    </div>
                    <div>
                        <h3><?= $monthlyStats['pending'] ?? 0 ?></h3>
                        <p>Total pending appointments this month</p>
                    </div>
                    <div>
                        <h3><?= $monthlyStats['completed'] ?? 0 ?></h3>
                        <p>Total completed appointments this month</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-section">
            <div class="appointment-tabs">
                <button class="tab-button active" onclick="showTab('all')">All</button>
                <button class="tab-button" onclick="showTab('today')">Today</button>
                <button class="tab-button" onclick="showTab('upcoming')">Upcoming</button>
                <button class="tab-button" onclick="showTab('done')">Done</button>
            </div>

            <div id="tab-content">
                <?php if (empty($appointments) && !isset($newAppointment)): ?>
                    <p>No appointments found.</p>
                <?php else: ?>
                    <?php foreach ($appointments as $appt): ?>
                        <div class="appointment-card" data-status="<?= $appt['status'] ?>" data-date="<?= $appt['appointment_date'] ?>">
                            <strong><?= htmlspecialchars(date('F j, Y', strtotime($appt['appointment_date']))) ?></strong><br>
                            <?= htmlspecialchars($appt['description']) ?><br>
                            <em>Status: <?= htmlspecialchars(ucfirst($appt['status'])) ?></em>
                        </div>
                    <?php endforeach; ?>
                    <?php if (isset($newAppointment)): ?>
                        <div class="appointment-card" data-status="<?= $newAppointment['status'] ?>" data-date="<?= $newAppointment['appointment_date'] ?>">
                            <strong><?= htmlspecialchars(date('F j, Y', strtotime($newAppointment['appointment_date']))) ?></strong><br>
                            <?= htmlspecialchars($newAppointment['description']) ?><br>
                            <em>Status: <?= htmlspecialchars(ucfirst($newAppointment['status'])) ?></em>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="modal" id="appointmentModal">
            <div class="modal-content">
                <h3>New Appointment</h3>
                <form method="POST">
                    <label for="appointment_date">Date:</label>
                    <input type="date" id="appointment_date" name="appointment_date" required><br><br>
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" required></textarea><br><br>
                    <button type="submit" class="add-btn">Submit</button>
                    <button type="button" onclick="document.getElementById('appointmentModal').style.display='none'">Cancel</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function showTab(tab) {
            const cards = document.querySelectorAll('.appointment-card');
            const today = new Date().toISOString().slice(0, 10);

            cards.forEach(card => {
                const date = card.dataset.date;
                const status = card.dataset.status;
                let show = false;

                if (tab === 'all') show = true;
                else if (tab === 'today' && date === today) show = true;
                else if (tab === 'upcoming' && new Date(date) > new Date(today) && status === 'pending') show = true;
                else if (tab === 'done' && status === 'completed') show = true;

                card.style.display = show ? 'block' : 'none';
            });

            document.querySelectorAll('.tab-button').forEach(button => button.classList.remove('active'));
            document.querySelector(`.tab-button[onclick="showTab('${tab}')"]`).classList.add('active');
        }

        // Initially show all appointments
        showTab('all');
    </script>
</body>
</html>