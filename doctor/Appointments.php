<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointments</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
     <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 p-6">
    <div class="flex justify-between items-start mb-4">
        <div>
            <h2 class="text-2xl font-semibold text-gray-800 mb-2">Add appointment to the schedule</h2>
            <button id="add-appointment-button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                + Add Appointment
            </button>
        </div>
        <div class="text-right">
            <p class="text-3xl font-bold text-blue-500">50</p>
            <p class="text-sm text-gray-600">Total appointments this month</p>
            <p class="text-3xl font-bold text-blue-500">40</p>
            <p class="text-sm text-gray-600">Total pending appointments this month</p>
             <p class="text-3xl font-bold text-blue-500">10</p>
            <p class="text-sm text-gray-600">Total completed appointments this month</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white shadow-md rounded-lg p-4">
            <h3 class="text-lg font-semibold text-gray-700 mb-2">Recent Patients</h3>
            <div class="bg-gray-200 rounded p-4">
                 <p class = "text-center">May 2025</p>
            </div>
        </div>
        <div class="bg-white shadow-md rounded-lg p-4">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-700">Appointment Requests</h3>
                 <button id="view-all-button" class="bg-transparent hover:text-blue-500 text-blue-700 font-semibold py-2 px-4 rounded">
                    View all
                </button>
            </div>
            <div class="grid grid-cols-2 gap-4 items-center">
                <div class="flex items-center">
                    <div class="rounded-full h-10 w-10 bg-blue-500 text-white flex items-center justify-center mr-2">
                        D
                    </div>
                    <div>
                        <p class="text-gray-800 font-medium">Patient Name</p>
                        <p class="text-sm text-gray-600">Don</p>
                    </div>
                </div>
                <div>
                    <p class="text-gray-800 font-medium">Date</p>
                    <p class="text-sm text-gray-600">March 30, 2025</p>
                </div>
                 <div>
                    <p class="text-gray-800 font-medium">Time</p>
                    <p class="text-sm text-gray-600">2:00 PM</p>
                </div>
                 <div>
                    <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Accept
                    </button>
                </div>
                 <div>
                    <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        Decline
                    </button>
                </div>
            </div>
        </div>
    </div>
     <div class="bg-white shadow-md rounded-lg p-4 mt-6">
        <h3 class="text-lg font-semibold text-gray-700 mb-2">New List of Patients</h3>
        <div class="grid grid-cols-3 gap-4">
            <div>
                <p class="text-gray-800 font-medium">First Name</p>
                <p class="text-sm text-gray-600">Don</p>
            </div>
            <div>
                <p class="text-gray-800 font-medium">Last Name</p>
                <p class="text-sm text-gray-600">Tee</p>
            </div>
            <div>
                <p class="text-gray-800 font-medium">Description</p>
                <p class="text-sm text-gray-600">Common Cold</p>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const addAppointmentButton = document.getElementById('add-appointment-button');
            const viewAllButton = document.getElementById('view-all-button');

            addAppointmentButton.addEventListener('click', () => {
                alert('Add Appointment functionality not implemented yet.');
            });

            viewAllButton.addEventListener('click', () => {
                alert('View All Appointments functionality not implemented yet.');
            });
        });
    </script>
</body>
</html>