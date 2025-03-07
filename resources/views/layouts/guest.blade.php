<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <title>TaxiGo</title>
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Custom Styles -->
        <style>
            .dark-bg {
                background-color: #000000;
            }
            .hover-scale {
                transition: transform 0.2s ease-in-out;
            }
            .hover-scale:hover {
                transform: scale(1.05);
            }
            .accent-color {
                color: #06C167;
            }
            .accent-bg {
                background-color: #06C167;
            }
            /* Fancy background pattern */
            .pattern-bg {
                background-color: #000000;
                background-image: radial-gradient(rgba(6, 193, 103, 0.1) 2px, transparent 2px);
                background-size: 40px 40px;
                position: relative;
            }
            .pattern-bg::before {
                content: "";
                position: absolute;
                top: 0;
                right: 0;
                bottom: 0;
                left: 0;
                background: linear-gradient(to bottom, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.6) 100%);
                z-index: 0;
            }
            .content-container {
                position: relative;
                z-index: 1;
            }
            .auth-card {
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.1);
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <!-- Background and Layout -->
        <div class="min-h-screen pattern-bg flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div class="content-container flex flex-col items-center w-full">
                
                <!-- Card Container -->
                <div class="w-full sm:max-w-md mx-4 my-6 bg-white rounded-xl shadow-2xl overflow-hidden auth-card">
                    <!-- Card Content -->
                    <div class="px-8 py-10">
                        {{ $slot }}
                    </div>
                </div>
                
                <!-- Footer -->
                <div class="mb-8 text-center text-white mt-6">
                    <p class="text-sm">&copy; {{ date('Y') }} TaxiGo. All rights reserved.</p>
                    <div class="mt-4 space-x-4">
                        <a href="#" class="text-white hover:text-gray-200 transition duration-300">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a href="#" class="text-white hover:text-gray-200 transition duration-300">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-white hover:text-gray-200 transition duration-300">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>