<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>inTime - Driver Dashboard</title>
     <!-- Include Tailwind CSS -->
     @vite('resources/css/app.css')
    <!-- Include Flatpickr for date/time picker -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css">
</head>
<body class="bg-gray-50">
    <!-- Header/Navigation -->
    <header class="px-4 py-4 flex items-center justify-between bg-white shadow-sm">
        <div class="flex items-center space-x-8">
            <!-- Logo -->
            <a href="#" class="text-2xl font-bold">inTime</a>
            
            <!-- Navigation Links -->
            <nav class="hidden md:flex space-x-6">
                <a href="#" class="font-medium">Create Ride</a>
                <a href="#" class="font-medium text-black">Attention Needed <span class="bg-red-500 text-white rounded-full px-2 py-0.5 text-xs">3</span></a>
                <a href="#" class="font-medium">Awaiting Rides</a>
                <a href="#" class="font-medium">My Profile</a>
            </nav>
        </div>
        
        <!-- User Profile -->
        <div class="flex items-center space-x-4">
            <div class="h-10 w-10 rounded-full bg-gray-300 overflow-hidden">
                <img src="/api/placeholder/40/40" alt="Profile" class="h-full w-full object-cover">
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <div class="max-w-7xl mx-auto">
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold">Attention Needed</h1>
                <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-sm font-medium">3 pending requests</span>
            </div>
            
            <!-- Requests Table -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Passenger</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pickup</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Drop-off</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Departure</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <!-- Row 1 -->
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <div>Feb 27, 2025</div>
                                    <div>10:30 AM</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gray-200 overflow-hidden">
                                            <img src="/api/placeholder/40/40" alt="Passenger" class="h-full w-full object-cover">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">Sarah Johnson</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    +212 6 12 34 56 78
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    Avenue Mohammed V
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    Marrakech Train Station
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <div>Mar 1, 2025</div>
                                    <div>08:15 AM</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                    <button class="bg-green-500 text-white py-1 px-3 rounded-md hover:bg-green-600 transition">Accept</button>
                                    <button class="bg-red-500 text-white py-1 px-3 rounded-md hover:bg-red-600 transition">Decline</button>
                                </td>
                            </tr>
                            
                            <!-- Row 2 -->
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <div>Feb 26, 2025</div>
                                    <div>03:45 PM</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gray-200 overflow-hidden">
                                            <img src="/api/placeholder/40/40" alt="Passenger" class="h-full w-full object-cover">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">Mohammed Ali</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    +212 6 98 76 54 32
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    Gueliz District
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    Menara Airport
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <div>Feb 28, 2025</div>
                                    <div>02:30 PM</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                    <button class="bg-green-500 text-white py-1 px-3 rounded-md hover:bg-green-600 transition">Accept</button>
                                    <button class="bg-red-500 text-white py-1 px-3 rounded-md hover:bg-red-600 transition">Decline</button>
                                </td>
                            </tr>
                            
                            <!-- Row 3 -->
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <div>Feb 25, 2025</div>
                                    <div>09:15 AM</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gray-200 overflow-hidden">
                                            <img src="/api/placeholder/40/40" alt="Passenger" class="h-full w-full object-cover">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">Fatima Zahra</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    +212 6 55 44 33 22
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    Hivernage District
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    Jamaa el-Fnaa Square
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <div>Mar 2, 2025</div>
                                    <div>10:00 AM</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                    <button class="bg-green-500 text-white py-1 px-3 rounded-md hover:bg-green-600 transition">Accept</button>
                                    <button class="bg-red-500 text-white py-1 px-3 rounded-md hover:bg-red-600 transition">Decline</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Pagination -->
            <div class="flex items-center justify-between mt-6">
                <div class="text-sm text-gray-700">
                    Showing <span class="font-medium">1</span> to <span class="font-medium">3</span> of <span class="font-medium">3</span> results
                </div>
                <div class="flex-1 flex justify-end">
                    <button class="relative inline-flex items-center px-4 py-2 bg-white text-sm font-medium text-gray-700 border border-gray-300 rounded-md hover:bg-gray-50 opacity-50 cursor-not-allowed">
                        Previous
                    </button>
                    <button class="ml-3 relative inline-flex items-center px-4 py-2 bg-white text-sm font-medium text-gray-700 border border-gray-300 rounded-md hover:bg-gray-50 opacity-50 cursor-not-allowed">
                        Next
                    </button>
                </div>
            </div>
        </div>
    </main>
</body>
</html>