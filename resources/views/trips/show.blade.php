@extends('layout')

@section('content')
<div class="container mx-auto px-4 py-6 bg-gray-50">
    <!-- Page Title -->
    <h2 class="text-2xl font-bold text-black mb-6">
        Trip Details
    </h2>

    <!-- Trip Card -->
    <div class="max-w-4xl mx-auto bg-white rounded-md shadow-sm overflow-hidden">
        <!-- Card Header -->
        <div class="bg-black p-4">
            <h3 class="text-xl font-medium text-white flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                </svg>
                {{ $trip->pickup_location }} to {{ $trip->destination }}
            </h3>
        </div>

        <!-- Card Body -->
        <div class="p-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Left Column -->
                <div>
                    <p class="text-gray-800 mb-3 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="font-medium mr-2">Departure:</span>
                        <span class="text-gray-600">{{ $trip->departure_time->format('M d, Y H:i') }}</span>
                    </p>
                    <p class="text-gray-800 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="font-medium mr-2">Price:</span>
                        <span class="font-medium">{{ number_format($trip->price, 2) }} MAD</span>
                    </p>
                </div>

                <!-- Right Column -->
                <div>
                    <p class="text-gray-800 mb-3 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="font-medium mr-2">Status:</span>
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
                    </p>
                    <p class="text-gray-800 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span class="font-medium mr-2">Passenger:</span>
                        <span class="text-gray-600">{{ $trip->passenger->name }}</span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Card Footer -->
        @if(auth()->user()->id === $trip->passenger_id)
            <div class="bg-gray-100 p-4 border-t border-gray-200">
                <div class="flex justify-end space-x-3">
                    <!-- Payment Status Logic -->
                    @if(!$payment || $payment->status === 'pending')
                        <!-- Complete Payment Button -->
                        <a href="{{ route('payment.form', ['trip_id' => $trip->id, 'price' => $trip->price]) }}" class="inline-flex items-center px-4 py-2 bg-black text-white rounded-md hover:bg-gray-800 transition duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                            </svg>
                            Complete Payment
                        </a>
                    @elseif($payment->status === 'canceled')
                        <!-- Canceled Payment Badge -->
                        <span class="text-gray-600 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Payment Canceled
                        </span>
                    @elseif($payment->status === 'passed')
                        <!-- Paid Badge -->
                        <span class="text-gray-600 flex items-center mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Paid
                        </span>
                    @endif

                    <!-- Cancel Button -->
                    @if($trip->status === 'pending')
                        <form action="{{ route('trips.destroy', $trip) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition duration-200" onclick="return confirm('Are you sure you want to cancel this trip?')">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Cancel Trip
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @endif
    </div>

    <!-- Review Section -->
    <div class="max-w-4xl mx-auto mt-8">
        <!-- Review Form -->
        <div class="bg-white rounded-md shadow-sm p-4 mb-6">
            <h3 class="text-xl font-medium text-black mb-4">Leave a Review</h3>
            <form action="{{ route('reviews.store', $trip) }}" method="POST">
                @csrf
                <!-- Star Rating -->
                <div class="mb-4">
                    <label for="rating" class="block text-gray-700 font-medium mb-2">Your Rating:</label>
                    <div class="flex space-x-2" id="rating">
                        @for ($i = 1; $i <= 5; $i++)
                            <span class="text-2xl text-gray-300 cursor-pointer hover:text-yellow-400" data-rating="{{ $i }}">★</span>
                        @endfor
                    </div>
                    <input type="hidden" name="rating" id="selected-rating" required>
                </div>

                <!-- Comment -->
                <div class="mb-4">
                    <label for="comment" class="block text-gray-700 font-medium mb-2">Your Comment:</label>
                    <textarea name="comment" id="comment" class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-1 focus:ring-black focus:border-black" rows="3" placeholder="Share your experience..."></textarea>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full px-4 py-2 bg-black text-white font-medium rounded-md hover:bg-gray-800 transition duration-200">
                    Submit Review
                </button>
            </form>
        </div>

        <!-- Reviews List -->
        <div class="bg-white rounded-md shadow-sm p-4 mb-6">
            <h3 class="text-xl font-medium text-black mb-4">Reviews</h3>
            @foreach ($trip->reviews as $review)
                <div class="bg-gray-50 rounded-md p-4 mb-3">
                    <div class="flex items-center space-x-3 mb-2">
                        <div class="w-8 h-8 rounded-full bg-black flex items-center justify-center text-white text-sm font-medium">
                            {{ substr($review->user->name, 0, 1) }}
                        </div>
                        <div>
                            <p class="text-gray-800 font-medium">{{ $review->user->name }}</p>
                            <small class="text-gray-500">{{ $review->created_at->format('M d, Y H:i') }}</small>
                        </div>
                    </div>

                    <!-- Star Rating -->
                    <p class="text-gray-700 mt-2">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $review->rating)
                                <span class="text-yellow-400 text-lg">★</span>
                            @else
                                <span class="text-gray-300 text-lg">★</span>
                            @endif
                        @endfor
                    </p>

                    <!-- Comment -->
                    @if ($review->comment)
                        <p class="text-gray-700 mt-2">{{ $review->comment }}</p>
                    @endif

                    <!-- Delete Button -->
                    @if(auth()->user()->id === $review->user_id || auth()->user()->role === 'admin')
                        <form action="{{ route('reviews.destroy', $review) }}" method="POST" class="flex justify-end">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-gray-400 hover:text-gray-600 focus:outline-none" onclick="return confirm('Are you sure you want to delete this review?')">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </form>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const stars = document.querySelectorAll('#rating span');
        const selectedRating = document.getElementById('selected-rating');

        stars.forEach(star => {
            star.addEventListener('click', function () {
                const rating = this.getAttribute('data-rating');
                selectedRating.value = rating;

                // Highlight selected stars
                stars.forEach((s, index) => {
                    if (index < rating) {
                        s.classList.remove('text-gray-300');
                        s.classList.add('text-yellow-400');
                    } else {
                        s.classList.remove('text-yellow-400');
                        s.classList.add('text-gray-300');
                    }
                });
            });
        });
    });
</script>
@endsection