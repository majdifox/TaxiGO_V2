<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-8" :status="session('status')" />

    <div class="max-w-md mx-auto p-6 bg-white rounded-xl shadow-md">
        <!-- Logo Area -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">TaxiGO</h1>
            <p class="text-gray-600 mt-2">Welcome back</p>
        </div>

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-5">
                <x-input-label for="email" :value="__('Email')" class="block text-sm font-medium text-gray-700 mb-1" />
                <x-text-input id="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-1 focus:ring-black focus:border-black transition duration-200"
                            type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Enter your email" />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600" />
            </div>

            <!-- Password -->
            <div class="mb-5">
                <x-input-label for="password" :value="__('Password')" class="block text-sm font-medium text-gray-700 mb-1" />
                <x-text-input id="password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-1 focus:ring-black focus:border-black transition duration-200"
                            type="password" name="password" required autocomplete="current-password" placeholder="Enter your password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-600" />
            </div>

            <!-- Remember Me and Forgot Password -->
            <div class="flex items-center justify-between mb-6">
                <label for="remember_me" class="flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-black shadow-sm focus:ring-black"
                        name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-sm text-black hover:text-gray-700 transition duration-200" href="{{ route('password.request') }}">
                        {{ __('Forgot password?') }}
                    </a>
                @endif
            </div>

            <!-- Submit Button -->
            <div class="mb-6">
                <x-primary-button class="w-full bg-black text-white px-6 py-3 rounded-lg hover:bg-gray-800 transition duration-200 font-medium">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>

            <!-- Sign Up Suggestion -->
            <div class="text-center pb-3">
                <p class="text-sm text-gray-600">Don't have an account?
                    <a href="{{ route('register') }}" class="text-black font-medium hover:text-gray-700 transition duration-200">
                        {{ __('Sign up') }}
                    </a>
                </p>
            </div>
        </form>

        <!-- Divider -->
        <div class="flex items-center my-6">
            <div class="flex-grow border-t border-gray-300"></div>
            <span class="px-3 text-gray-500 text-sm">or</span>
            <div class="flex-grow border-t border-gray-300"></div>
        </div>

        <!-- Continue with Google Button -->
        <div>
            <a href="{{ route('auth.google') }}" class="w-full flex items-center justify-center px-6 py-3 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition duration-200">
                <img src="https://imagepng.org/wp-content/uploads/2019/08/google-icon.png" alt="Google Logo" class="w-5 h-5 mr-2">
                {{ __('Continue with Google') }}
            </a>
        </div>
    </div>
</x-guest-layout>