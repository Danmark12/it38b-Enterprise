<?php
session_start();
require '../feature/config.php';

// Dummy data for charts (replace with real DB data)
$lastMedicalRecordData = [98, 97, 99, 96, 100]; // Example: blood pressure over time
$generalInfoData = [65, 120, 70]; // Example: weight, systolic BP, heart rate
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Appointments</title>
    <link rel="stylesheet" href="../patientcss/appointments.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="page-content">
        <p>Welcome to your patient dashboard, <?= htmlspecialchars($_SESSION['first_name'] ?? 'User') ?>!</p>

        <div class="dashboard-cards">
            <div class="card">
                <h3>Last Medical Record</h3>
                <canvas id="lastMedicalRecordChart"></canvas>
            </div>

            <div class="card">
                <h3>General Information</h3>
                <canvas id="generalInfoChart"></canvas>
            </div>

            <div class="card appointment-card">
                <h3>Need an Appointment?</h3>
                <button onclick="window.location.href='schedule_appointment.php'">Schedule Appointment</button>
            </div>
        </div>

        <div class="upcoming-section">
            <h3>Upcoming Appointments</h3>
            <p>No upcoming appointments.</p> <!-- Replace with actual data -->
        </div>
    </div>

    <script>
        // Last Medical Record Chart
        const lastMedicalCtx = document.getElementById('lastMedicalRecordChart').getContext('2d');
        new Chart(lastMedicalCtx, {
            type: 'line',
            data: {
                labels: ['Day 1', 'Day 2', 'Day 3', 'Day 4', 'Day 5'],
                datasets: [{
                    label: 'Blood Pressure',
                    data: <?= json_encode($lastMedicalRecordData) ?>,
                    borderColor: '#4CAF50',
                    borderWidth: 2,
                    fill: false,
                }]
            },
            options: {
                responsive: true,
                scales: { y: { beginAtZero: true } }
            }
        });

        // General Info Chart
        const generalInfoCtx = document.getElementById('generalInfoChart').getContext('2d');
        new Chart(generalInfoCtx, {
            type: 'bar',
            data: {
                labels: ['Weight (kg)', 'BP (systolic)', 'Heart Rate'],
                datasets: [{
                    label: 'Vitals',
                    data: <?= json_encode($generalInfoData) ?>,
                    backgroundColor: ['#2196F3', '#FFC107', '#FF5722']
                }]
            },
            options: {
                responsive: true,
                scales: { y: { beginAtZero: true } }
            }
        });
    </script>
</body>
</html>
