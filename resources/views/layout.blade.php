<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaxiGo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Hover effect for buttons */
        .hover-scale {
            transition: transform 0.2s ease-in-out;
        }
        .hover-scale:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body class="bg-gray-900 text-white">
    <!-- Navbar -->
    <nav class="bg-black shadow-md">
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <!-- Brand/Logo -->
                <a href="/" class="text-2xl font-bold text-white hover:text-gray-300 transition duration-300">
                    TaxiGo
                </a>

                <!-- Mobile Toggle Button -->
                <button class="lg:hidden text-white focus:outline-none">
                    <i class="fas fa-bars text-2xl"></i>
                </button>

                <!-- Navbar Links -->
                <div class="hidden lg:flex items-center space-x-6">
                    @auth
                        <!-- Dashboard Link -->
                        <a href="{{ route('dashboard') }}" class="text-gray-400 hover:text-white transition duration-300">
                            Dashboard
                        </a>

                        <!-- Driver-Specific Links -->
                        @if(auth()->user()->role === 'driver')
                            <a href="{{ route('availability.index') }}" class="text-gray-400 hover:text-white transition duration-300">
                                My Availability
                            </a>
                        @endif

                        <!-- Profile Dropdown -->
                        <div class="relative">
                            <button class="text-gray-400 hover:text-white transition duration-300 focus:outline-none">
                                {{ Auth::user()->name }} <i class="fas fa-chevron-down ml-1"></i>
                            </button>
                            <div class="absolute right-0 mt-2 w-48 bg-gray-800 rounded-lg shadow-lg py-2 hidden border border-gray-700">
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-300 hover:bg-gray-700">
                                    Profile
                                </a>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-gray-300 hover:bg-gray-700">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <!-- Login/Register Links -->
                        <a href="{{ route('login') }}" class="text-gray-400 hover:text-white transition duration-300">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="bg-gray-800 text-white px-4 py-2 rounded-md hover-scale transition duration-300 border border-gray-700">
                            Register
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto px-6 py-8">
        @if(session('success'))
            <div class="bg-gray-800 border-l-4 border-green-500 text-green-400 p-4 mb-6">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="bg-black text-gray-400 py-6 mt-8">
        <div class="container mx-auto px-6 text-center">
            <p>&copy; 2023 TaxiGo. All rights reserved.</p>
            <div class="mt-4 space-x-4">
                <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                    <i class="fab fa-facebook"></i>
                </a>
                <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                    <i class="fab fa-instagram"></i>
                </a>
            </div>
        </div>
    </footer>

    <!-- Script for Dropdown -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const profileDropdown = document.querySelector('.relative');
            const dropdownMenu = profileDropdown.querySelector('.hidden');

            profileDropdown.addEventListener('click', function () {
                dropdownMenu.classList.toggle('hidden');
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function (event) {
                if (!profileDropdown.contains(event.target)) {
                    dropdownMenu.classList.add('hidden');
                }
            });
        });
    </script>
</body>
</html>