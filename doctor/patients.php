<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patients</title>
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
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-semibold text-gray-800">Patients</h2>
        <button id="add-patient-button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Add patient
        </button>
    </div>

    <div class="bg-white shadow-md rounded-lg p-4 overflow-x-auto">
        <table class="min-w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Patient</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gender</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Age</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Blood</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last Visit</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="rounded-full h-10 w-10 bg-blue-500 text-white flex items-center justify-center mr-2">
                                D
                            </div>
                            <div class="text-sm font-medium text-gray-900">
                                Dan Mark Javier
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Male</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">22</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">A+</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">3/24/2025</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Common Cold</td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                         <div class="flex items-center">
                            <div class="rounded-full h-10 w-10 bg-green-500 text-white flex items-center justify-center mr-2">
                                J
                            </div>
                            <div class="text-sm font-medium text-gray-900">
                                Josh
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Male</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">63</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">O+</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">3/24/2025</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Common Cold</td>
                </tr>
                <tr>
                   <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="rounded-full h-10 w-10 bg-yellow-500 text-white flex items-center justify-center mr-2">
                                A
                            </div>
                            <div class="text-sm font-medium text-gray-900">
                                Anthony
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Male</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">15</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">B+</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">3/24/2025</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Common Cold</td>
                </tr>
                 <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="rounded-full h-10 w-10 bg-indigo-500 text-white flex items-center justify-center mr-2">
                                C
                            </div>
                            <div class="text-sm font-medium text-gray-900">
                                Carl
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Male</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">41</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">AB+</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">3/24/2025</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Common Cold</td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="rounded-full h-10 w-10 bg-pink-500 text-white flex items-center justify-center mr-2">
                                S
                            </div>
                            <div class="text-sm font-medium text-gray-900">
                                Stacy
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Female</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">7</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">A-</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">3/24/2025</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Common Cold</td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                         <div class="flex items-center">
                            <div class="rounded-full h-10 w-10 bg-gray-500 text-white flex items-center justify-center mr-2">
                                L
                            </div>
                            <div class="text-sm font-medium text-gray-900">
                                Lisa
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Female</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">35</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">O+</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">3/24/2025</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Common Cold</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="flex justify-center mt-4">
        <button id="prev-button" class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 rounded-l border-gray-300">
            Prev
        </button>
        <button class="page-number bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border-gray-300">
            1
        </button>
        <button class="page-number bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border-gray-300">
            2
        </button>
        <button class="page-number bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border-gray-300">
            3
        </button>
        <button class="page-number bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border-gray-300">
            4
        </button>
        <button id="next-button" class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 rounded-r border-gray-300">
            Next
        </button>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const addPatientButton = document.getElementById('add-patient-button');
            const prevButton = document.getElementById('prev-button');
            const nextButton = document.getElementById('next-button');
            const pageNumbers = document.querySelectorAll('.page-number');

            addPatientButton.addEventListener('click', () => {
                alert('Add Patient functionality not implemented yet.');
            });

            prevButton.addEventListener('click', () => {
                alert('Previous page functionality not implemented yet.');
            });

            nextButton.addEventListener('click', () => {
                alert('Next page functionality not implemented yet.');
            });

            pageNumbers.forEach(number => {
                number.addEventListener('click', () => {
                    alert(`Go to page ${number.textContent} functionality not implemented yet.`);
                });
            });
        });
    </script>
</body>
</html>