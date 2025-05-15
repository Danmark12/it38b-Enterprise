<div class="dashboard-container">
    <div class="overview-cards">
        <div class="performance-card">
            <h3>Weekly Performance</h3>
            <div class="chart-container">
                <canvas id="weeklyPerformanceChart"></canvas>
            </div>
            <div class="performance-details">
                <p>This week shows a <span class="indicator up">&#8593;</span> 15% increase in visits compared to last week.</p>
            </div>
        </div>
        <div class="performance-card">
            <h3>Overall Performance</h3>
            <div class="chart-container">
                <canvas id="overallPerformanceChart"></canvas>
            </div>
            <div class="performance-details">
                <p>Overall, patient visits have been <span class="indicator down">&#8595;</span> 5% in the past month.</p>
            </div>
        </div>
        <div class="total-patients-card">
            <h3>Total Patients</h3>
            <div class="patient-count">
                <?php
                // In a real application, you would fetch this from your database
                $totalPatients = 40;
                echo $totalPatients;
                ?>
            </div>
            <div class="patient-details">
                <p>Out of these, <span class="highlight">10</span> are new patients this month.</p>
            </div>
        </div>
    </div>

    <div class="data-tables">
        <div class="appointments-table">
            <h3>Upcoming Appointments</h3>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Patient Name</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Action</th> </tr>
                    </thead>
                    <tbody id="upcomingAppointmentsBody">
                        <tr>
                            <td>Don</td>
                            <td>March 30, 2025</td>
                            <td>2:00 PM</td>
                            <td><button class="view-button">View</button></td> </tr>
                        </tbody>
                </table>
            </div>
            <div class="table-footer">
                <a href="appointments.php">View All Appointments</a>
            </div>
        </div>

        <div class="patients-table">
            <h3>New List of Patients</h3>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Description</th>
                            <th>Added On</th> </tr>
                    </thead>
                    <tbody id="newPatientsBody">
                        <tr>
                            <td>Don</td>
                            <td>Tee</td>
                            <td>Common Cold</td>
                            <td>May 15, 2025</td> </tr>
                        </tbody>
                </table>
            </div>
            <div class="table-footer">
                <a href="patients.php">View All Patients</a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Sample data for the charts (replace with your actual data fetched from the backend)
    const weeklyPerformanceData = {
        labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
        datasets: [{
            label: 'Visits',
            data: [12, 19, 3, 5, 2, 3, 15],
            backgroundColor: 'rgba(54, 162, 235, 0.7)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    };

    const overallPerformanceData = {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
        datasets: [{
            label: 'Visits',
            data: [50, 65, 80, 70, 90],
            backgroundColor: 'rgba(255, 99, 132, 0.7)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
        }]
    };

    // Get the chart contexts and create the charts
    const weeklyChartCanvas = document.getElementById('weeklyPerformanceChart').getContext('2d');
    const overallChartCanvas = document.getElementById('overallPerformanceChart').getContext('2d');

    new Chart(weeklyChartCanvas, {
        type: 'bar',
        data: weeklyPerformanceData,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    new Chart(overallChartCanvas, {
        type: 'line',
        data: overallPerformanceData,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // In a real application, you would use JavaScript or PHP to fetch and populate the table data dynamically.
    // Example using fetch API (you'll need to create the backend endpoints)
    fetch('/api/upcoming_appointments')
        .then(response => response.json())
        .then(data => {
            const tbody = document.getElementById('upcomingAppointmentsBody');
            tbody.innerHTML = ''; // Clear existing rows
            data.forEach(appointment => {
                const row = tbody.insertRow();
                row.insertCell().textContent = appointment.patient_name;
                row.insertCell().textContent = appointment.date;
                row.insertCell().textContent = appointment.time;
                const actionCell = row.insertCell();
                const viewButton = document.createElement('button');
                viewButton.textContent = 'View';
                viewButton.classList.add('view-button');
                // Add event listener for the view button if needed
                actionCell.appendChild(viewButton);
            });
        })
        .catch(error => console.error('Error fetching upcoming appointments:', error));

    fetch('/api/new_patients')
        .then(response => response.json())
        .then(data => {
            const tbody = document.getElementById('newPatientsBody');
            tbody.innerHTML = ''; // Clear existing rows
            data.forEach(patient => {
                const row = tbody.insertRow();
                row.insertCell().textContent = patient.first_name;
                row.insertCell().textContent = patient.last_name;
                row.insertCell().textContent = patient.description;
                row.insertCell().textContent = patient.added_on; // Assuming your API returns an 'added_on' field
            });
        })
        .catch(error => console.error('Error fetching new patients:', error));
</script>