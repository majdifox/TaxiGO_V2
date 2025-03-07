@extends('layout')

@section('content')
<div class="container mx-auto px-4 py-10 max-w-lg">
    <!-- Payment Title -->
    <h2 class="text-2xl font-bold text-black mb-6">Complete your payment</h2>

    <!-- Display Payment Errors -->
    @if ($errors->any())
    <div class="mb-6">
        <div class="bg-gray-100 border-l-4 border-black text-gray-900 px-4 py-3 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    <!-- Payment Card -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <!-- Payment Details -->
        <div class="mb-6">
            <h3 class="text-lg font-medium text-black mb-3">Trip details</h3>
            <div class="flex justify-between items-center py-3 border-b border-gray-200">
                <span class="text-gray-600">Trip ID</span>
                <span class="font-medium">{{ $trip_id }}</span>
            </div>
            <div class="flex justify-between items-center py-3">
                <span class="text-gray-600">Total</span>
                <span class="text-xl font-bold">${{ number_format($price, 2) }}</span>
            </div>
        </div>

        <!-- Payment Form -->
        <form action="{{ route('payment.process') }}" method="POST" id="payment-form">
            @csrf
            <input type="hidden" name="trip_id" value="{{ $trip_id }}">
            <input type="hidden" name="price" value="{{ $price }}">

            <!-- Card Details -->
            <div class="mb-6">
                <label for="card-element" class="block text-sm font-medium text-gray-700 mb-2">
                    Payment method
                </label>
                <div id="card-element" class="w-full px-4 py-3 border border-gray-300 rounded focus:ring-2 focus:ring-black focus:border-black transition duration-200">
                    <!-- A Stripe Element will be inserted here. -->
                </div>
                <div id="card-errors" role="alert" class="text-sm text-red-600 mt-2"></div>
            </div>

            <!-- Pay Now Button -->
            <button type="submit" id="submit-button" class="w-full bg-black text-white py-3 rounded font-medium hover:bg-gray-800 transition duration-200">
                <span id="button-text">Pay Now</span>
                <span id="button-spinner" class="ml-2 hidden">
                    <svg class="animate-spin h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </span>
            </button>
        </form>
    </div>
    
    <!-- Security Notice -->
    <div class="text-center text-gray-500 text-sm">
        <p>All transactions are secure and encrypted.</p>
    </div>
</div>

<!-- Stripe.js -->
<script src="https://js.stripe.com/v3/"></script>
<script>
    var stripe = Stripe('{{ config('services.stripe.key') }}');
    var elements = stripe.elements();

    // Customize Stripe Elements
    var style = {
        base: {
            color: '#333',
            fontFamily: '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#aab7c4'
            }
        },
        invalid: {
            color: '#dc2626',
            iconColor: '#dc2626'
        }
    };

    var card = elements.create('card', { style: style });
    card.mount('#card-element');

    // Handle real-time validation errors
    card.on('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    // Handle form submission
    var form = document.getElementById('payment-form');
    var submitButton = document.getElementById('submit-button');
    var buttonSpinner = document.getElementById('button-spinner');
    var buttonText = document.getElementById('button-text');

    form.addEventListener('submit', function(event) {
        event.preventDefault();

        // Disable the submit button to prevent multiple submissions
        submitButton.disabled = true;
        buttonText.classList.add('hidden');
        buttonSpinner.classList.remove('hidden');

        stripe.createToken(card).then(function(result) {
            if (result.error) {
                // Show errors to the customer
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;

                // Re-enable the submit button
                submitButton.disabled = false;
                buttonText.classList.remove('hidden');
                buttonSpinner.classList.add('hidden');
            } else {
                // Send the token to your server
                stripeTokenHandler(result.token);
            }
        });
    });

    function stripeTokenHandler(token) {
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);
        form.submit();
    }
</script>
@endsection