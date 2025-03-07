@extends('layout')

@section('content')
    <div class="container mx-auto px-4 py-6 bg-gray-50">
        <!-- Your Trips Section -->
        <h2 class="text-2xl font-bold text-black mb-4">Your Trips</h2>
        <div class="bg-white rounded-md shadow-sm mb-8">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">
                                Pickup
                            </th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">
                                Destination
                            </th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">
                                Departure
                            </th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">
                                Status
                            </th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">
                                Price
                            </th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($trips as $trip)
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <!-- Pickup Location -->
                            <td class="px-4 py-3 text-sm text-gray-900">
                                {{ $trip->pickup_location }}
                            </td>
                
                            <!-- Destination -->
                            <td class="px-4 py-3 text-sm text-gray-900">
                                {{ $trip->destination }}
                            </td>
                
                            <!-- Departure Time -->
                            <td class="px-4 py-3 text-sm text-gray-900">
                                {{ $trip->departure_time->format('M d, Y H:i') }}
                            </td>
                
                            <!-- Status -->
                            <td class="px-4 py-3 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-medium rounded-full {{
                                    [
                                        'pending' => 'bg-gray-200 text-gray-800',
                                        'accepted' => 'bg-green-100 text-green-800',
                                        'canceled' => 'bg-red-100 text-red-800',
                                        'completed' => 'bg-black text-white'
                                    ][$trip->status]
                                }}">
                                    {{ ucfirst($trip->status) }}
                                </span>
                            </td>
                
                            <!-- Price -->
                            <td class="px-4 py-3 text-sm font-medium text-gray-900">
                                {{ number_format($trip->price, 2) }} MAD
                            </td>
                
                            <!-- Actions -->
                            <td class="px-4 py-3 text-sm">
                                <a href="{{ route('trips.show', $trip) }}" class="text-black font-medium hover:text-gray-700 transition duration-200">
                                    View Details
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="px-4 py-3 border-t border-gray-200">
                {{ $trips->links() }}
            </div>
        </div>

        <!-- Available Drivers Section -->
        <h2 class="text-2xl font-bold text-black mb-4">Available Drivers</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($availableDrivers as $driver)
            <div class="bg-white rounded-md shadow-sm hover:shadow-md transition-shadow duration-200">
                <div class="p-4">
                    <!-- Driver Profile -->
                    <div class="flex items-center space-x-3 mb-3">
                        <img src="{{ asset('storage/' . $driver->profile_photo) }}" alt="{{ $driver->name }}" class="w-12 h-12 rounded-full object-cover border border-gray-200">
                        <div>
                            <h5 class="text-base font-medium text-black">{{ $driver->name }}</h5>
                            <p class="text-sm text-gray-500">{{ $driver->phone }}</p>
                        </div>
                    </div>
                    
                    <!-- Availability -->
                    <div class="my-3 bg-gray-50 p-3 rounded-md">
                        <p class="text-sm font-medium text-black mb-2">
                            Available Times:
                        </p>
                        @foreach($driver->availabilities as $availability)
                        <div class="text-sm text-gray-600 mb-2">
                            <div class="flex items-center mb-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>{{ $availability->start_time->format('M d, Y H:i') }} - {{ $availability->end_time->format('H:i') }}</span>
                            </div>
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span>{{ $availability->location }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    <!-- Book Button -->
                    <div class="mt-4">
                        <a href="{{ route('trips.create', ['driver_id' => $driver->id]) }}" class="w-full block text-center bg-black text-white px-4 py-2 rounded-md hover:bg-gray-800 transition duration-200">
                            Book Now
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection