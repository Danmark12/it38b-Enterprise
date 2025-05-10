<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Patient Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            background-color: #f4f6f8;
            color: #333;
            line-height: 1.6;
        }

        .page-content {
            max-width: 1100px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1, h2, h3 {
            color: #2c3e50;
            margin-bottom: 20px;
        }

        h1 {
            font-size: 2.2rem;
            font-weight: 700;
        }

        h2 {
            font-size: 1.8rem;
            font-weight: 600;
        }

        h3 {
            font-size: 1.2rem;
            font-weight: 600;
            margin-top: 0;
        }

        p {
            margin-bottom: 16px;
            color: #555;
        }

        .dashboard-cards {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 20px;
        }

        .card {
            flex: 1;
            min-width: 300px;
            background-color: #f9f9f9;
            border: 1px solid #e0e0e0;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.08);
        }

        .card h3 {
            margin-bottom: 16px;
            color: #34495e;
        }

        .appointment-card {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .appointment-card button {
            margin-top: 16px;
            padding: 12px 24px;
            font-size: 18px;
            color: #fff;
            background-color: #4CAF50;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out, transform 0.1s ease;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .appointment-card button:hover {
            background-color: #45a049;
            transform: scale(1.05);
            box-shadow: 0 3px 7px rgba(0, 0, 0, 0.15);
        }

        .upcoming-section {
            margin-top: 40px;
            padding: 20px;
            background-color: #e3f2fd;
            border-radius: 12px;
            border: 1px solid #b0e0f0;
        }

        .upcoming-section h3 {
            color: #2c3e50;
            margin-bottom: 20px;
        }

        .chart-container {
            width: 100%;
            height: 300px;
            margin-top: 20px;
            position: relative;
        }

        @media (max-width: 768px) {
            .dashboard-cards {
                flex-direction: column;
            }

            .card {
                min-width: 100%;
            }
        }

        /* Styles for the calendar - simplified for demonstration */
        .calendar {
            width: 100%;
            max-width: 350px;
            margin: 20px auto;
            border-collapse: collapse;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .calendar th, .calendar td {
            width: 14.28%; /* Even distribution of columns */
            padding: 8px;
            border: 1px solid #ddd;
            text-align: center;
            vertical-align: top;
            font-size: 0.9rem;
        }

        .calendar th {
            background-color: #f0f0f0;
            font-weight: 600;
            color: #333;
        }

        .calendar td {
            background-color: #fff;
            color: #444;
        }

        .calendar td.today {
            background-color: #e0f7fa;
            font-weight: bold;
            color: #2196f3;
        }

        .calendar td.selected {
            background-color: #b2ebf2;
            color: #00897b;
        }

        .calendar td:hover {
            background-color: #f5f5f5;
        }

        .month-navigation {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            padding: 0 10px;
        }

        .month-navigation button {
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out;
            font-size: 0.9rem;
        }

        .month-navigation button:hover {
            background-color: #f0f0f0;
        }

        .month-navigation h2 {
            margin: 0;
            font-size: 1.5rem;
            color: #4CAF50;
        }
    </style>
</head>
<body>
    <div class="page-content">
        <h1>Patient Dashboard</h1>
        <p>Welcome to your patient dashboard!</p>

        <div class="dashboard-cards">
            <div class="card">
                <h3>Last Medical Record</h3>
                <div class="chart-container">
                    <canvas id="lastMedicalRecordChart"></canvas>
                </div>
            </div>

            <div class="card">
                <h3>General Information</h3>
                <div class="chart-container">
                    <canvas id="generalInfoChart"></canvas>
                </div>
            </div>

            <div class="card appointment-card">
                <h3>Need an Appointment?</h3>
                <button onclick="window.location.href='schedule_appointment.php'">Schedule Appointment</button>
            </div>
        </div>

        <div class="upcoming-section">
            <h3>Upcoming Appointments</h3>
            <p>No upcoming appointments.</p>
        </div>

        <div class="calendar-container">
            <div class="month-navigation">
                <button id="prev-month">❮</button>
                <h2 id="month-name">May 2024</h2>
                <button id="next-month">❯</button>
            </div>
            <table class="calendar" id="calendar">
                <thead>
                    <tr>
                        <th>Sun</th>
                        <th>Mon</th>
                        <th>Tue</th>
                        <th>Wed</th>
                        <th>Thu</th>
                        <th>Fri</th>
                        <th>Sat</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // --- Charts ---
        // Last Medical Record Chart
        const lastMedicalCtx = document.getElementById('lastMedicalRecordChart').getContext('2d');
        const lastMedicalChart = new Chart(lastMedicalCtx, {
            type: 'line',
            data: {
                labels: ['Day 1', 'Day 2', 'Day 3', 'Day 4', 'Day 5'],
                datasets: [{
                    label: 'Blood Pressure',
                    data: [98, 97, 99, 96, 100],
                    borderColor: '#4CAF50',
                    borderWidth: 2,
                    fill: false,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // General Info Chart
        const generalInfoCtx = document.getElementById('generalInfoChart').getContext('2d');
        const generalInfoChart = new Chart(generalInfoCtx, {
            type: 'bar',
            data: {
                labels: ['Weight (kg)', 'BP (systolic)', 'Heart Rate'],
                datasets: [{
                    label: 'Vitals',
                    data: [65, 120, 70],
                    backgroundColor: ['#2196F3', '#FFC107', '#FF5722']
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });



        // --- Calendar ---
        const calendarEl = document.getElementById('calendar');
        const monthNameEl = document.getElementById('month-name');
        const prevMonthBtn = document.getElementById('prev-month');
        const nextMonthBtn = document.getElementById('next-month');

        let currentDate = new Date();
        let selectedDate = null; // To store the selected date


        function renderCalendar() {
            const year = currentDate.getFullYear();
            const month = currentDate.getMonth();
            const firstDay = new Date(year, month, 1).getDay();
            const daysInMonth = new Date(year, month + 1, 0).getDate();

            const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
            monthNameEl.textContent = `${monthNames[month]} ${year}`;
            let calendarBody = '<tbody>';
            let dayCount = 1;

            for (let i = 0; i < 6; i++) { // Max 6 rows
                calendarBody += '<tr>';
                for (let j = 0; j < 7; j++) {
                    if ((i === 0 && j < firstDay) || dayCount > daysInMonth) {
                        calendarBody += '<td></td>';
                    } else {
                        const isToday = (
                            currentDate.getDate() === dayCount &&
                            currentDate.getMonth() === month &&
                            currentDate.getFullYear() === year
                        );

                        const isSelected = selectedDate &&
                            selectedDate.getDate() === dayCount &&
                            selectedDate.getMonth() === month &&
                            selectedDate.getFullYear() === year;


                        let dayClasses = '';
                        if (isToday) dayClasses += 'today ';
                        if (isSelected) dayClasses += 'selected';

                        calendarBody += `<td class="${dayClasses}" data-date="${year}-${month}-${dayCount}">${dayCount}</td>`;
                        dayCount++;
                    }
                }
                calendarBody += '</tr>';
                if (dayCount > daysInMonth) break;
            }
            calendarBody += '</tbody>';
            calendarEl.innerHTML = calendarBody;

            // Add event listener to each day cell
            const dayCells = calendarEl.querySelectorAll('td[data-date]');
            dayCells.forEach(cell => {
                cell.addEventListener('click', () => {
                    const [year, month, day] = cell.dataset.date.split('-').map(Number);
                    selectedDate = new Date(year, month, day);
                    renderCalendar(); // Re-render to update selected day
                    // You can add logic here to show appointments for the selected date
                    console.log('Selected Date:', selectedDate);
                });
            });
        }

        prevMonthBtn.addEventListener('click', () => {
            currentDate.setMonth(currentDate.getMonth() - 1);
            renderCalendar();
        });

        nextMonthBtn.addEventListener('click', () => {
            currentDate.setMonth(currentDate.getMonth() + 1);
            renderCalendar();
        });

        renderCalendar(); // Initial render


        // --- Data Updates (Simulated) ---
        // Simulate updating chart data
        setInterval(() => {
            // Last Medical Record Chart - Simulate blood pressure change
            const newData = [
                Math.max(80, Math.min(120, lastMedicalChart.data.datasets[0].data[0] + Math.floor(Math.random() * 20) - 10)),
                Math.max(80, Math.min(120, lastMedicalChart.data.datasets[0].data[1] + Math.floor(Math.random() * 20) - 10)),
                Math.max(80, Math.min(120, lastMedicalChart.data.datasets[0].data[2] + Math.floor(Math.random() * 20) - 10)),
                Math.max(80, Math.min(120, lastMedicalChart.data.datasets[0].data[3] + Math.floor(Math.random() * 20) - 10)),
                Math.max(80, Math.min(120, lastMedicalChart.data.datasets[0].data[4] + Math.floor(Math.random() * 20) - 10))
            ];

            lastMedicalChart.data.datasets[0].data = newData;
            lastMedicalChart.update();

            // General Info Chart - Simulate weight and heart rate change
            generalInfoChart.data.datasets[0].data = [
                Math.max(50, Math.min(150, generalInfoChart.data.datasets[0].data[0] + Math.floor(Math.random() * 10) - 5)),
                generalInfoChart.data.datasets[0].data[1], // Keep BP constant for simplicity
                Math.max(60, Math.min(100, generalInfoChart.data.datasets[0].data[2] + Math.floor(Math.random() * 8) - 4))
            ];
            generalInfoChart.update();
        }, 5000); // Update every 5 seconds
    </script>
</body>
</html>
