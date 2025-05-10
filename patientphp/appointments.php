<?php
// Include DB config
include '../feature/config.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $patient_id = 1; // Replace with session-based patient ID
    $appointment_date = $_POST['appointment_date'];
    $description = $_POST['description'];
    $status = 'pending'; // Default status is pending

    $stmt = $conn->prepare("INSERT INTO appointments (patient_id, appointment_date, description, status) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $patient_id, $appointment_date, $description, $status);
    $stmt->execute();
    $stmt->close();

    // Redirect to prevent resubmission
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Patient Dashboard</title>
    <link rel="stylesheet" href="../patientcss/appointments.css">
    <link rel="stylesheet" href="../patientcss/modal.css">
</head>
<body>
    <div class="dashboard-container">
        <!-- Appointment Request Section -->
        <div class="appointment-request">
            <div>
                <h2>Request an appointment</h2>
                <button class="add-appointment-button" onclick="openModal()">+ Add Appointment</button>
            </div>
            <div class="doctor-illustration">
                <img src="doctor_illustration.svg" alt="Doctor Illustration" width="150">
            </div>
        </div>

        <!-- Appointment Summary Section -->
        <div class="appointment-summary">
            <div><p>Total appointments this month</p><h3>10</h3></div>
            <div><p>Total pending appointments this month</p><h3>7</h3></div>
            <div><p>Total completed appointments this month</p><h3>3</h3></div>
        </div>

        <!-- Appointments Section -->
        <div class="appointments-section">
            <div class="calendar">
                <h3>May 2023</h3>
                <div class="calendar-controls">
                    <button>&lt;</button>
                    <button>&gt;</button>
                </div>
                <table>
                    <thead>
                        <tr><th>Mo</th><th>Tu</th><th>We</th><th>Th</th><th>Fr</th><th>Sa</th><th>Su</th></tr>
                    </thead>
                    <tbody>
                        <tr><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td><td>7</td></tr>
                        <tr><td>8</td><td>9</td><td>10</td><td>11</td><td>12</td><td>13</td><td>14</td></tr>
                        <tr><td>15</td><td>16</td><td>17</td><td class="highlighted">18</td><td>19</td><td>20</td><td>21</td></tr>
                        <tr><td>22</td><td>23</td><td>24</td><td>25</td><td>26</td><td>27</td><td>28</td></tr>
                        <tr><td>29</td><td>30</td><td>31</td><td>1</td><td>2</td><td>3</td><td>4</td></tr>
                    </tbody>
                </table>
            </div>

            <div class="appointment-list">
                <div class="appointment-tabs">
                    <button class="tab active">All <span>4</span></button>
                    <button class="tab">Today</button>
                    <button class="tab">Upcoming</button>
                    <button class="tab">Done</button>
                </div>
                <div class="tab-content">
                    <p>No appointments to display yet.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Appointment Modal Form -->
    <div id="appointmentModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>New Appointment</h2>
            <form method="POST" action="">
                <label for="appointment_date">Date:</label>
                <input type="date" name="appointment_date" required>

                <label for="description">Description:</label>
                <textarea name="description" rows="4" required></textarea>

                <button type="submit" class="submit-btn">Add Appointment</button>
            </form>
        </div>
    </div>

    <script>
        // Open the modal form
        function openModal() {
            document.getElementById('appointmentModal').style.display = 'block';
        }

        // Close the modal form
        function closeModal() {
            document.getElementById('appointmentModal').style.display = 'none';
        }

        // Close modal when clicking outside
        window.onclick = function(e) {
            if (e.target == document.getElementById('appointmentModal')) {
                closeModal();
            }
        }

        // Tabs functionality
        const tabs = document.querySelectorAll('.appointment-tabs .tab');
        const tabContent = document.querySelector('.tab-content');

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                tabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');
                tabContent.innerHTML = `<p>Content for ${tab.textContent.split(' ')[0]} appointments.</p>`;
            });
        });
    </script>
</body>
</html>
