<x-guest-layout>
    <!-- Register Form -->
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="bg-black rounded-xl p-8 max-w-md mx-auto shadow-2xl border border-gray-800">
        @csrf

        <!-- Form Title -->
        <h2 class="text-3xl font-bold text-center text-white mb-8">Join <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-purple-600">TaxiGO</span></h2>

        <!-- Name -->
        <div class="mb-6">
            <x-input-label for="name" :value="__('Name')" class="block text-sm font-medium text-gray-300 mb-2" />
            <x-text-input id="name" class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-white transition duration-300"
                          type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="John Doe" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-sm text-red-400" />
        </div>

        <!-- Email Address -->
        <div class="mb-6">
            <x-input-label for="email" :value="__('Email')" class="block text-sm font-medium text-gray-300 mb-2" />
            <x-text-input id="email" class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-white transition duration-300"
                          type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="you@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-400" />
        </div>

        <!-- Phone Number -->
        <div class="mb-6">
            <x-input-label for="phone" :value="__('Phone Number')" class="block text-sm font-medium text-gray-300 mb-2" />
            <x-text-input id="phone" class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-white transition duration-300"
                          type="text" name="phone" :value="old('phone')" autocomplete="tel" placeholder="+1 (555) 123-4567" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2 text-sm text-red-400" />
        </div>

        <!-- Role Selection -->
        <div class="mb-6">
            <x-input-label for="role" :value="__('I want to')" class="block text-sm font-medium text-gray-300 mb-2" />
            <div class="grid grid-cols-2 gap-4">
                <label class="flex items-center justify-center p-4 bg-gray-900 border border-gray-700 rounded-lg cursor-pointer transition-all duration-300 hover:border-blue-500">
                    <input type="radio" name="role" value="passenger" class="sr-only" {{ old('role') == 'passenger' ? 'checked' : '' }}>
                    <div class="text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto mb-2 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span class="text-sm font-medium text-gray-300">Ride</span>
                    </div>
                </label>
                <label class="flex items-center justify-center p-4 bg-gray-900 border border-gray-700 rounded-lg cursor-pointer transition-all duration-300 hover:border-blue-500">
                    <input type="radio" name="role" value="driver" class="sr-only" {{ old('role') == 'driver' ? 'checked' : '' }}>
                    <div class="text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto mb-2 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                        </svg>
                        <span class="text-sm font-medium text-gray-300">Drive</span>
                    </div>
                </label>
            </div>
            <x-input-error :messages="$errors->get('role')" class="mt-2 text-sm text-red-400" />
        </div>

        <!-- Profile Photo -->
        <div class="mb-6">
            <x-input-label for="profile_photo" :value="__('Profile Photo')" class="block text-sm font-medium text-gray-300 mb-2" />
            <div class="flex items-center justify-center w-full">
                <label for="profile_photo" class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed rounded-lg cursor-pointer bg-gray-900 border-gray-700 hover:border-blue-500 transition duration-300">
                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mb-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <p class="text-xs text-gray-400">Upload your photo</p>
                    </div>
                    <input id="profile_photo" type="file" name="profile_photo" accept="image/*" class="hidden" />
                </label>
            </div>
            <x-input-error :messages="$errors->get('profile_photo')" class="mt-2 text-sm text-red-400" />
        </div>

        <!-- Password -->
        <div class="mb-6">
            <x-input-label for="password" :value="__('Password')" class="block text-sm font-medium text-gray-300 mb-2" />
            <x-text-input id="password" class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-white transition duration-300"
                          type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-400" />
        </div>

        <!-- Confirm Password -->
        <div class="mb-6">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="block text-sm font-medium text-gray-300 mb-2" />
            <x-text-input id="password_confirmation" class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-white transition duration-300"
                          type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-red-400" />
        </div>

        <!-- Already Registered Link -->
        <div class="flex items-center justify-between mb-6">
            <a class="text-sm text-blue-400 hover:text-blue-300 transition duration-300" href="{{ route('login') }}">
                {{ __('Already have an account?') }}
            </a>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-center">
            <x-primary-button class="w-full bg-gradient-to-r from-blue-500 to-purple-600 text-white px-6 py-4 rounded-lg hover:from-blue-600 hover:to-purple-700 font-medium text-base transition duration-300 transform hover:scale-[1.02]">
                {{ __('Create Account') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>