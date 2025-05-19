<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../doctorcss/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 p-6">
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Welcome Doc. Jonard</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
        <div class="bg-white shadow-md rounded-lg p-4">
            <h3 class="text-lg font-semibold text-gray-700 mb-2">Weekly Performance</h3>
            <div class="chart-placeholder h-32 bg-gray-200 rounded">
                <p class = "text-center pt-12">Weekly Performance Chart</p>
            </div>
        </div>
        <div class="bg-white shadow-md rounded-lg p-4">
            <h3 class="text-lg font-semibold text-gray-700 mb-2">Overall Performance</h3>
            <div class="chart-placeholder h-32 bg-gray-200 rounded">
                 <p class = "text-center pt-12">Overall Performance Chart</p>
            </div>
        </div>
        <div class="bg-white shadow-md rounded-lg p-4 flex items-center justify-center">
            <div>
                <h3 class="text-lg font-semibold text-gray-700">Total Patients</h3>
                <p class="text-2xl font-bold text-blue-500">40</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white shadow-md rounded-lg p-4">
            <h3 class="text-lg font-semibold text-gray-700 mb-2">Upcoming Appointments</h3>
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
            </div>
        </div>
        <div class="bg-white shadow-md rounded-lg p-4">
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
    </div>
</body>
</html>