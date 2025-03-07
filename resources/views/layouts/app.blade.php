<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaxiGo - Driver Dashboard</title>
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Flatpickr for date/time picker -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css">
    
    <style>
        /* Uber-inspired styles */
        .accent-color {
            color: #06C167;
        }
        .accent-bg {
            background-color: #06C167;
        }
        .dark-bg {
            background-color: #000000;
        }
        .ongoing-badge {
            background-color: #276EF1;
            color: white;
        }
        .completed-badge {
            background-color: #06C167;
            color: white;
        }
        .nav-link.active {
            border-color: #06C167;
            color: #06C167;
        }
        .nav-link {
            transition: all 0.2s ease;
        }
        .nav-link:hover:not(.active) {
            color: #333333;
            border-color: #DDDDDD;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Header/Navigation -->
    <header class="px-4 py-4 flex items-center justify-between dark-bg text-white shadow-md">
        <div class="flex items-center space-x-8">
            <!-- Logo -->
            <a href="#" class="text-2xl font-bold">TaxiGo</a>
            
            <!-- Navigation Links -->
            <nav class="hidden md:flex space-x-6">
                <a href="#" class="font-medium text-gray-300 hover:text-white transition">Create Ride</a>
                <a href="#" class="font-medium text-gray-300 hover:text-white transition">Attention Needed <span class="bg-red-500 text-white rounded-full px-2 py-0.5 text-xs">3</span></a>
                <a href="#" class="font-medium text-white">Awaiting Rides</a>
                <a href="#" class="font-medium text-gray-300 hover:text-white transition">My Profile</a>
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
                    <span class="px-3 py-1 ongoing-badge rounded-full text-sm font-medium">2 ongoing</span>
                    <span class="px-3 py-1 completed-badge rounded-full text-sm font-medium">1 completed</span>
                </div>
            </div>
            
            <!-- Tabs -->
            <div class="mb-6 border-b border-gray-200">
                <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                    <a href="#" class="px-1 py-4 border-b-2 nav-link active font-medium text-sm">
                        Ongoing
                    </a>
                    <a href="#" class="px-1 py-4 border-b-2 border-transparent nav-link font-medium text-sm text-gray-500">
                        Completed
                    </a>
                </nav>
            </div>
            
            <!-- Rides List -->
            <div class="space-y-6">
                <!-- Ride Card 1 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100">
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
                            <span class="px-3 py-1 ongoing-badge rounded-full text-sm font-medium">Ongoing</span>
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
                                <button class="w-full md:w-auto accent-bg text-white py-2 px-6 rounded-md font-medium hover:bg-green-600 transition">
                                    Mark as Complete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Ride Card 2 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100">
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
                            <span class="px-3 py-1 ongoing-badge rounded-full text-sm font-medium">Ongoing</span>
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
                                <button class="w-full md:w-auto accent-bg text-white py-2 px-6 rounded-md font-medium hover:bg-green-600 transition">
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