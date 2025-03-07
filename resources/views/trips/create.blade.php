@extends('layout')

@section('content')
<div class="container mx-auto px-4 py-6 bg-gray-50">
    <!-- Form Title -->
    <h2 class="text-2xl font-bold text-black mb-4">Book a Trip</h2>
    
    <!-- Booking Form -->
    <form method="POST" action="{{ route('trips.store') }}" class="max-w-2xl mx-auto bg-white rounded-md shadow-sm p-6">
        @csrf
        
        <!-- Hidden Driver ID Field -->
        @if(request()->has('driver_id'))
            <input type="hidden" name="driver_id" value="{{ request('driver_id') }}">
        @endif
        
        <!-- Pickup Location -->
        <div class="mb-4">
            <label for="pickup_location" class="block text-sm font-medium text-gray-700 mb-1">
                Pickup Location
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <input type="text" id="pickup_location" name="pickup_location" required
                       class="w-full pl-10 px-4 py-2 border border-gray-300 rounded-md focus:ring-1 focus:ring-black focus:border-black transition duration-200"
                       placeholder="Enter pickup location">
            </div>
            @error('pickup_location')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <!-- Destination -->
        <div class="mb-4">
            <label for="destination" class="block text-sm font-medium text-gray-700 mb-1">
                Destination
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <input type="text" id="destination" name="destination" required
                       class="w-full pl-10 px-4 py-2 border border-gray-300 rounded-md focus:ring-1 focus:ring-black focus:border-black transition duration-200"
                       placeholder="Enter destination">
            </div>
            @error('destination')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <!-- Departure Time -->
        <div class="mb-4">
            <label for="departure_time" class="block text-sm font-medium text-gray-700 mb-1">
                Departure Time
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <input type="datetime-local" id="departure_time" name="departure_time" required
                       class="w-full pl-10 px-4 py-2 border border-gray-300 rounded-md focus:ring-1 focus:ring-black focus:border-black transition duration-200">
            </div>
            @error('departure_time')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <!-- Price -->
        <div class="mb-6">
            <label for="price" class="block text-sm font-medium text-gray-700 mb-1">
                Price
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <span class="text-gray-500">MAD</span>
                </div>
                <input type="number" step="0.01" id="price" name="price" required
                       class="w-full pl-16 px-4 py-2 border border-gray-300 rounded-md focus:ring-1 focus:ring-black focus:border-black transition duration-200"
                       placeholder="Enter price">
            </div>
            @error('price')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <!-- Submit Button -->
        <div class="flex justify-end">
            <button type="submit"
                    class="bg-black text-white px-6 py-3 rounded-md hover:bg-gray-800 transition duration-200">
                Book Trip
            </button>
        </div>
    </form>
</div>
@endsection