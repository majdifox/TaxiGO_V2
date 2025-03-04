<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>inTime - Driver Dashboard</title>
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Flatpickr for date/time picker -->
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
                <a href="#" class="font-medium">Attention Needed <span class="bg-red-500 text-white rounded-full px-2 py-0.5 text-xs">3</span></a>
                <a href="#" class="font-medium text-black">Awaiting Rides</a>
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
        <div class="max-w-5xl mx-auto">
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold">Awaiting Rides</h1>
                <div class="flex space-x-4">
                    <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm font-medium">2 ongoing</span>
                    <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">1 completed</span>
                </div>
            </div>
            
            <!-- Tabs -->
            <div class="mb-6 border-b border-gray-200">
                <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                    <a href="#" class="px-1 py-4 border-b-2 border-black font-medium text-sm">
                        Ongoing
                    </a>
                    <a href="#" class="px-1 py-4 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300">
                        Completed
                    </a>
                </nav>
            </div>
            
            <!-- Rides List -->
            <div class="space-y-6">
                <!-- Ride Card 1 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <div class="flex items-center mb-3">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gray-200 overflow-hidden mr-3">
                                        <img src="/api/placeholder/40/40" alt="Passenger" class="h-full w-full object-cover">
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-medium">Ride with Karim Ahmed</h3>
                                        <p class="text-sm text-gray-500">Booked 2 days ago</p>
                                    </div>
                                </div>
                            </div>
                            <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm font-medium">Ongoing</span>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-4">
                            <!-- Left Column -->
                            <div class="space-y-3">
                                <div>
                                    <p class="text-sm text-gray-500">Pickup</p>
                                    <p class="font-medium">Gueliz District</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Passenger Phone</p>
                                    <p class="font-medium">+212 6 11 22 33 44</p>
                                </div>
                            </div>
                            
                            <!-- Middle Column -->
                            <div class="space-y-3">
                                <div>
                                    <p class="text-sm text-gray-500">Dropoff</p>
                                    <p class="font-medium">Menara Mall</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Departure</p>
                                    <p class="font-medium">Feb 28, 2025 at 9:30 AM</p>
                                </div>
                            </div>
                            
                            <!-- Right Column - Buttons -->
                            <div class="flex md:justify-end items-end">
                                <button class="w-full md:w-auto bg-green-500 text-white py-2 px-6 rounded-md font-medium hover:bg-green-600 transition">
                                    Mark as Complete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Ride Card 2 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <div class="flex items-center mb-3">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gray-200 overflow-hidden mr-3">
                                        <img src="/api/placeholder/40/40" alt="Passenger" class="h-full w-full object-cover">
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-medium">Ride with Laila Bensouda</h3>
                                        <p class="text-sm text-gray-500">Booked 3 days ago</p>
                                    </div>
                                </div>
                            </div>
                            <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm font-medium">Ongoing</span>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-4">
                            <!-- Left Column -->
                            <div class="space-y-3">
                                <div>
                                    <p class="text-sm text-gray-500">Pickup</p>
                                    <p class="font-medium">Majorelle Garden</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Passenger Phone</p>
                                    <p class="font-medium">+212 6 99 88 77 66</p>
                                </div>
                            </div>
                            
                            <!-- Middle Column -->
                            <div class="space-y-3">
                                <div>
                                    <p class="text-sm text-gray-500">Dropoff</p>
                                    <p class="font-medium">Marrakech Railway Station</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Departure</p>
                                    <p class="font-medium">Mar 1, 2025 at 11:00 AM</p>
                                </div>
                            </div>
                            
                            <!-- Right Column - Buttons -->
                            <div class="flex md:justify-end items-end">
                                <button class="w-full md:w-auto bg-green-500 text-white py-2 px-6 rounded-md font-medium hover:bg-green-600 transition">
                                    Mark as Complete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js"></script>
    <script>
        // Initialize Flatpickr if needed
        document.addEventListener('DOMContentLoaded', function() {
            // Your JavaScript code here
        });
    </script>
</body>
</html>