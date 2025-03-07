@extends('layout')

@section('content')
<div class="bg-gray-100 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col space-y-8">
            <!-- Reservations Section -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-black">Your Reservations</h2>
                    <span class="bg-black text-white text-xs px-3 py-1 rounded-full">{{ count($reservations) }} trips</span>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Passenger
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Pickup Location
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Destination
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Departure Time
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($reservations as $trip)
                            <tr class="hover:bg-gray-50 transition duration-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="h-8 w-8 bg-gray-200 rounded-full flex items-center justify-center text-gray-700 mr-3">
                                            {{ substr($trip->passenger->name, 0, 1) }}
                                        </div>
                                        <span class="text-sm text-gray-900">{{ $trip->passenger->name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $trip->pickup_location }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $trip->destination }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $trip->departure_time->format('M d, Y H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full {{
                                        [
                                            'pending' => 'bg-gray-200 text-gray-800',
                                            'accepted' => 'bg-black text-white',
                                            'canceled' => 'bg-gray-800 text-white',
                                            'completed' => 'bg-gray-900 text-white'
                                        ][$trip->status]
                                    }}">
                                        {{ ucfirst($trip->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    @if($trip->status === 'pending')
                                        <div class="flex space-x-2">
                                            <!-- Accept Button -->
                                            <form action="{{ route('trips.update-status', $trip) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="accepted">
                                                <button type="submit" class="bg-black text-white px-3 py-1 rounded-md hover:bg-gray-800 transition duration-200">
                                                    Accept
                                                </button>
                                            </form>
                                
                                            <!-- Reject Button -->
                                            <form action="{{ route('trips.update-status', $trip) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="canceled">
                                                <button type="submit" class="bg-white border border-gray-300 text-gray-700 px-3 py-1 rounded-md hover:bg-gray-100 transition duration-200">
                                                    Reject
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        <a href="{{ route('trips.show', $trip) }}" class="text-black hover:underline transition duration-200">
                                            View Details
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Availability Section -->
            <div>
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-black">Your Availability</h2>
                    <a href="{{ route('availability.create') }}" class="bg-black text-white px-4 py-2 rounded-md hover:bg-gray-800 transition duration-200 inline-flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        Add Availability
                    </a>
                </div>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach($availabilities as $availability)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform duration-200 hover:shadow-lg hover:translate-y-[-2px]">
                        <div class="bg-black text-white p-2 text-sm font-medium">
                            {{ $availability->location }}
                        </div>
                        <div class="p-4">
                            <div class="flex items-center mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                </svg>
                                <p class="text-sm text-gray-700">
                                    <span class="font-medium">From:</span> {{ $availability->start_time->format('M d H:i') }}
                                </p>
                            </div>
                            <div class="flex items-center mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                </svg>
                                <p class="text-sm text-gray-700">
                                    <span class="font-medium">To:</span> {{ $availability->end_time->format('M d H:i') }}
                                </p>
                            </div>
                            <a href="{{ route('availability.edit', $availability) }}" class="w-full block text-center border border-black text-black px-4 py-2 rounded-md hover:bg-black hover:text-white transition duration-200">
                                Edit
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection