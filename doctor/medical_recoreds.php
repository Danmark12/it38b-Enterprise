<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Records</title>
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
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-semibold text-gray-800">Medical Records</h2>
        <button id="add-patient-record-button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Add patient record
        </button>
    </div>

    <div class="bg-white shadow-md rounded-lg p-4 overflow-x-auto">
        <table class="min-w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Note</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Note Type</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Author</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Consulted Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="rounded-full h-10 w-10 bg-gray-500 text-white flex items-center justify-center mr-2">
                                C
                            </div>
                            <div class="text-sm font-medium text-gray-900">
                                Clint
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Prostate</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">History</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Dr. Jonard</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">3/24/2025</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded mr-1">View</button>
                        <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded mr-1">Edit</button>
                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Delete</button>
                    </td>
                </tr>
                <tr>
                   <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="rounded-full h-10 w-10 bg-red-500 text-white flex items-center justify-center mr-2">
                                R
                            </div>
                            <div class="text-sm font-medium text-gray-900">
                                Robert
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Bruise</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Cardiology Consultation</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Dr. Jonard</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">3/24/2025</td>
                     <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded mr-1">View</button>
                        <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded mr-1">Edit</button>
                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="rounded-full h-10 w-10 bg-green-500 text-white flex items-center justify-center mr-2">
                                J
                            </div>
                            <div class="text-sm font-medium text-gray-900">
                                John Doe
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">DHA</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">History and Physical</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Dr. Jonard</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">3/24/2025</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded mr-1">View</button>
                        <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded mr-1">Edit</button>
                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Delete</button>
                    </td>
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
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Urinary Control levels</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">History, Physical consultation</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Dr. Jonard</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">3/24/2025</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded mr-1">View</button>
                        <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded mr-1">Edit</button>
                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Delete</button>
                    </td>
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
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Abnormal levels</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">History, Physical consultation</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Dr. Jonard</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">3/24/2025</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded mr-1">View</button>
                        <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded mr-1">Edit</button>
                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Delete</button>
                    </td>
                </tr>
                 <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="rounded-full h-10 w-10 bg-yellow-500 text-white flex items-center justify-center mr-2">
                                L
                            </div>
                            <div class="text-sm font-medium text-gray-900">
                                Lisa
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Globulins</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Cardiology</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Dr. Jonard</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">3/24/2025</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded mr-1">View</button>
                        <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded mr-1">Edit</button>
                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Delete</button>
                    </td>
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
            const addPatientRecordButton = document.getElementById('add-patient-record-button');
            const prevButton = document.getElementById('prev-button');
            const nextButton = document.getElementById('next-button');
            const pageNumbers = document.querySelectorAll('.page-number');

            addPatientRecordButton.addEventListener('click', () => {
                alert('Add Patient Record functionality not implemented yet.');
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