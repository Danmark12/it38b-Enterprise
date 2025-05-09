<?php
require '../feature/config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Patient Dashboard</title>
    <link rel="stylesheet" href="../patientcss/P_dashboard.css">
</head>
<body>
    <div class="page-content">
        <h2>Welcome Mr. <?= htmlspecialchars($_SESSION['first_name'] ?? 'User') ?></h2>

        <div class="dashboard-top">
            <div class="dashboard-card">
                <h3>Last Medical Record</h3>
                <div class="graph-placeholder">Graph Here</div>
            </div>
            <div class="dashboard-card">
                <h3>General Information</h3>
                <div class="graph-placeholder">Graph Here</div>
            </div>
            <div class="dashboard-card appointment-card">
                <h3>Schedule</h3>
                <button class="schedule-button" onclick="location.href='schedule_appointment.php'">Schedule Appointment</button>
            </div>
        </div>

        <div class="appointments-container">
            <h3>Upcoming Appointments</h3>
            <div class="appointment-card">
                <p><strong>Dr. Smith</strong> - May 12, 2025 @ 2:00 PM</p>
                <p>Status: Confirmed</p>
            </div>
            <div class="appointment-card">
                <p><strong>Dr. Jane</strong> - May 20, 2025 @ 10:00 AM</p>
                <p>Status: Pending</p>
            </div>

            <h3>Recent Appointments</h3>
            <table class="appointments-table">
                <thead>
                    <tr>
                        <th>Doctor</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Dr. Samuels</td>
                        <td>April 10, 2025</td>
                        <td>3:00 PM</td>
                        <td>Completed</td>
                    </tr>
                    <tr>
                        <td>Dr. Anne</td>
                        <td>March 28, 2025</td>
                        <td>11:30 AM</td>
                        <td>Cancelled</td>
                    </tr>
                    <tr>
                        <td>Dr. Kim</td>
                        <td>March 15, 2025</td>
                        <td>9:00 AM</td>
                        <td>Completed</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
