<?php
include '../feature/config.php';

// Function to add a new appointment
function addAppointment($user_id, $appointment_date, $appointment_time, $reason, $description) {
    global $conn;
    $dateTime = $appointment_date . ' ' . $appointment_time . ':00';
    $sql = "INSERT INTO appointments (user_id, appointment_date, reason, description, status) VALUES (:user_id, :appointment_date, :reason, :description, 'pending')";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':appointment_date', $dateTime);
    $stmt->bindParam(':reason', $reason);
    $stmt->bindParam(':description', $description);
    return $stmt->execute();
}

// Function to get total appointments this month
function getTotalAppointmentsThisMonth() {
    global $conn;
    $month = date('m');
    $year = date('Y');
    $sql = "SELECT COUNT(*) FROM appointments WHERE MONTH(appointment_date) = :month AND YEAR(appointment_date) = :year";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':month', $month);
    $stmt->bindParam(':year', $year);
    $stmt->execute();
    return $stmt->fetchColumn();
}

// Function to get total pending appointments this month
function getTotalPendingAppointmentsThisMonth() {
    global $conn;
    $month = date('m');
    $year = date('Y');
    $sql = "SELECT COUNT(*) FROM appointments WHERE MONTH(appointment_date) = :month AND YEAR(appointment_date) = :year AND status = 'pending'";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':month', $month);
    $stmt->bindParam(':year', $year);
    $stmt->execute();
    return $stmt->fetchColumn();
}

// Function to get total completed appointments this month
function getTotalCompletedAppointmentsThisMonth() {
    global $conn;
    $month = date('m');
    $year = date('Y');
    $sql = "SELECT COUNT(*) FROM appointments WHERE MONTH(appointment_date) = :month AND YEAR(appointment_date) = :year AND status = 'completed'";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':month', $month);
    $stmt->bindParam(':year', $year);
    $stmt->execute();
    return $stmt->fetchColumn();
}

// Function to get recent patients (patients with recent appointments)
function getRecentPatients($limit = 5) {
    global $conn;
    $sql = "SELECT DISTINCT u.id, u.first_name, u.last_name
            FROM appointments a
            JOIN users u ON a.user_id = u.id
            ORDER BY a.appointment_date DESC
            LIMIT :limit";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
}

// Function to get pending appointment requests
function getAppointmentRequests() {
    global $conn;
    $sql = "SELECT a.id AS appointment_id, u.first_name, u.last_name, a.appointment_date, TIME(a.appointment_date) AS appointment_time, a.reason
            FROM appointments a
            JOIN users u ON a.user_id = u.id
            WHERE a.status = 'pending'
            ORDER BY a.appointment_date ASC";
    $stmt = $conn->query($sql);
    return $stmt->fetchAll();
}

// Function to accept or decline an appointment request
function updateAppointmentStatus($appointment_id, $status) {
    global $conn;
    $sql = "UPDATE appointments SET status = :status WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':id', $appointment_id, PDO::PARAM_INT);
    return $stmt->execute();
}

// Function to get the new list of patients (newly registered users)
function getNewPatients($limit = 5) {
    global $conn;
    $sql = "SELECT id, first_name, last_name, created_at
            FROM users
            WHERE user_type = 'patient'
            ORDER BY created_at DESC
            LIMIT :limit";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
}

// Handle form submission for adding a new appointment
if (isset($_POST['add_appointment'])) {
    $user_id = 1; // Replace with the actual logged-in doctor's user ID
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];
    $reason = $_POST['reason'];
    $description = $_POST['description'];

    if (addAppointment($user_id, $appointment_date, $appointment_time, $reason, $description)) {
        echo '<div class="bg-green-200 text-green-800 p-3 rounded mb-4">Appointment added successfully!</div>';
    } else {
        echo '<div class="bg-red-200 text-red-800 p-3 rounded mb-4">Error adding appointment. Please try again.</div>';
    }
}

// Handle accept/decline actions
if (isset($_GET['action']) && isset($_GET['appointment_id'])) {
    $action = $_GET['action'];
    $appointment_id = $_GET['appointment_id'];
    if ($action === 'accept') {
        if (updateAppointmentStatus($appointment_id, 'accepted')) {
            echo '<div class="bg-green-200 text-green-800 p-3 rounded mb-4">Appointment accepted.</div>';
        } else {
            echo '<div class="bg-red-200 text-red-800 p-3 rounded mb-4">Error updating appointment status.</div>';
        }
    } elseif ($action === 'decline') {
        if (updateAppointmentStatus($appointment_id, 'declined')) {
            echo '<div class="bg-yellow-200 text-yellow-800 p-3 rounded mb-4">Appointment declined.</div>';
        } else {
            echo '<div class="bg-red-200 text-red-800 p-3 rounded mb-4">Error updating appointment status.</div>';
        }
    }
}

$totalAppointments = getTotalAppointmentsThisMonth();
$pendingAppointments = getTotalPendingAppointmentsThisMonth();
$completedAppointments = getTotalCompletedAppointmentsThisMonth();
$recentPatients = getRecentPatients();
$appointmentRequests = getAppointmentRequests();
$newPatients = getNewPatients();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointments</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../doctorcss/appointment.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .appointment-form {
            display: none; /* Initially hidden */
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white shadow-md rounded-lg p-6;
            z-index: 10;
        }
        .appointment-form.show {
            display: block;
        }
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9;
        }
        .overlay.show {
            display: block;
        }
    </style>
</head>
<body class="bg-gray-100 p-6">
    <div class="relative">
        <div id="add-appointment-modal" class="appointment-form">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Add New Appointment</h2>
            <form method="post" action="">
                <div class="mb-4">
                    <label for="appointment_date" class="block text-gray-700 text-sm font-bold mb-2">Date:</label>
                    <input type="date" id="appointment_date" name="appointment_date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label for="appointment_time" class="block text-gray-700 text-sm font-bold mb-2">Time:</label>
                    <input type="time" id="appointment_time" name="appointment_time" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label for="reason" class="block text-gray-700 text-sm font-bold mb-2">Reason for Visit:</label>
                    <input type="text" id="reason" name="reason" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description:</label>
                    <textarea id="description" name="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                </div>
                <div class="flex justify-end">
                    <button type="submit" name="add_appointment" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-2">Save Appointment</button>
                    <button type="button" id="cancel-add-appointment" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Cancel</button>
                </div>
            </form>
        </div>
        <div id="overlay" class="overlay"></div>

        <div class="flex justify-between items-start mb-4">
            <div>
                <h2 class="text-2xl font-semibold text-gray-800 mb-2">Add appointment to the schedule</h2>
                <button id="add-appointment-button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    + Add Appointment
                </button>
            </div>
            <div class="text-right">
                <p class="text-3xl font-bold text-blue-500"><?php echo $totalAppointments; ?></p>
                <p class="text-sm text-gray-600">Total appointments this month</p>
                <p class="text-3xl font-bold text-yellow-500"><?php echo $pendingAppointments; ?></p>
                <p class="text-sm text-gray-600">Total pending appointments this month</p>
                <p class="text-3xl font-bold text-green-500"><?php echo $completedAppointments; ?></p>
                <p class="text-sm text-gray-600">Total completed appointments this month</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-white shadow-md rounded-lg p-4">
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Recent Patients</h3>
                <?php if (!empty($recentPatients)): ?>
                    <ul class="list-disc pl-5">
                        <?php foreach ($recentPatients as $patient): ?>
                            <li><?php echo $patient['first_name'] . ' ' . $patient['last_name']; ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p class="text-gray-500">No recent patients found.</p>
                <?php endif; ?>
            </div>
            <div class="bg-white shadow-md rounded-lg p-4">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-700">Appointment Requests</h3>
                    <button id="view-all-requests-button" class="bg-transparent hover:text-blue-500 text-blue-700 font-semibold py-2 px-4 rounded">
                        View all
                    </button>
                </div>
                <?php if (!empty($appointmentRequests)): ?>
                    <div class="divide-y divide-gray-200">
                        <?php foreach ($appointmentRequests as $request): ?>
                            <div class="py-2 flex items-center justify-between">
                                <div>
                                    <p class="font-semibold text-gray-800"><?php echo $request['first_name'] . ' ' . $request['last_name']; ?></p>
                                    <p class="text-sm text-gray-600"><?php echo date('F j, Y', strtotime($request['appointment_date'])) . ' at ' . date('h:i A', strtotime($request['appointment_time'])); ?></p>
                                    <p class="text-sm text-gray-600">Reason: <?php echo $request['reason']; ?></p>
                                </div>
                                <div>
                                    <a href="?action=accept&appointment_id=<?php echo $request['appointment_id']; ?>" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded text-sm mr-2">Accept</a>
                                    <a href="?action=decline&appointment_id=<?php echo $request['appointment_id']; ?>" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded text-sm">Decline</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="text-gray-500">No pending appointment requests.</p>
                <?php endif; ?>
            </div>
        </div>

        <div class="bg-white shadow-md rounded-lg p-4 mt-6">
            <h3 class="text-lg font-semibold text-gray-700 mb-2">New List of Patients</h3>
            <?php if (!empty($newPatients)): ?>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">First Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Registered On</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($newPatients as $patient):
                            ?>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo $patient['id']; ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo $patient['first_name']; ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo $patient['last_name']; ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo date('F j, Y', strtotime($patient['created_at'])); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <p class="text-gray-500">No new patients registered.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const addAppointmentButton = document.getElementById('add-appointment-button');
            const addAppointmentModal = document.getElementById('add-appointment-modal');
            const cancelAddAppointmentButton = document.getElementById('cancel-add-appointment');
            const overlay = document.getElementById('overlay');

            addAppointmentButton.addEventListener('click', () => {
                addAppointmentModal.classList.add('show');
                overlay.classList.add('show');
            });

            cancelAddAppointmentButton.addEventListener('click', () => {
                addAppointmentModal.classList.remove('show');
                overlay.classList.remove('show');
            });

            overlay.addEventListener('click', () => {
                addAppointmentModal.classList.remove('show');
                overlay.classList.remove('show');
            });

            const viewAllRequestsButton = document.getElementById('view-all-requests-button');
            viewAllRequestsButton.addEventListener('click', () => {
                alert('View All Appointment Requests functionality not implemented yet.');
                // In a real application, this would navigate to a page listing all requests.
            });
        });
    </script>
</body>
</html>