<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Book Ferry Ticket') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if(auth()->user())
                @if(!$selectedSchedule)
                    <!-- Schedule Selection -->
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg mb-6">
                        <div class="p-6">
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">Select Your Ferry</h3>
                            <div class="grid gap-4">
                                @foreach($schedules as $schedule)
                                    <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 hover:border-blue-500 dark:hover:border-blue-400 transition-colors cursor-pointer" onclick="selectSchedule({{ $schedule->id }})">
                                        <div class="flex justify-between items-center">
                                            <div>
                                                <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $schedule->ferry_name }}</h4>
                                                <p class="text-gray-600 dark:text-gray-400">{{ $schedule->departure_time->format('l, F j, Y') }}</p>
                                                <p class="text-sm text-gray-500 dark:text-gray-500">{{ $schedule->departure_time->format('g:i A') }} - {{ $schedule->arrival_time->format('g:i A') }}</p>
                                            </div>
                                            <div class="text-right">
                                                <p class="text-2xl font-bold text-blue-600 dark:text-blue-400">${{ number_format($schedule->price_per_ticket, 2) }}</p>
                                                <p class="text-sm text-gray-500 dark:text-gray-500">per person</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Booking Confirmation Modal Style -->
                    <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-2xl overflow-hidden">
                        <!-- Header -->
                        <div class="relative bg-gradient-to-r from-blue-600 to-blue-700 px-8 py-6 overflow-hidden">
                            <!-- Wave Background -->
                            <div class="absolute inset-0 opacity-15">
                                <svg class="absolute bottom-0 left-0 w-full h-full" viewBox="0 0 1200 120" preserveAspectRatio="none">
                                    <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" fill="rgba(255,255,255,0.1)"></path>
                                </svg>
                                <svg class="absolute bottom-0 left-0 w-full h-full" viewBox="0 0 1200 120" preserveAspectRatio="none">
                                    <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" fill="rgba(255,255,255,0.05)"></path>
                                </svg>
                            </div>

                            <div class="relative z-10 flex items-center justify-between">
                                <h2 class="text-2xl font-bold text-white">Confirm Your Booking</h2>
                                <a href="{{ route('ferry-schedules.index') }}" class="text-blue-100 hover:text-white transition-colors">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </a>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-8">
                            <!-- Ferry Details Card -->
                            <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-6 mb-8">
                                <div class="flex items-start justify-between">
                                    <div class="flex items-center">
                                        <div class="bg-blue-100 dark:bg-blue-900 p-3 rounded-lg mr-4">
                                            <svg class="h-8 w-8 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">{{ $selectedSchedule->ferry_name }}</h3>
                                            <p class="text-gray-600 dark:text-gray-400">{{ $selectedSchedule->departure_time->format('l, F j, Y') }}</p>
                                            <div class="flex items-center mt-2">
                                                <span class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $selectedSchedule->departure_time->format('g:i A') }}</span>
                                                <svg class="h-4 w-4 mx-3 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                                </svg>
                                                <span class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $selectedSchedule->arrival_time->format('g:i A') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-3xl font-bold text-blue-600 dark:text-blue-400">${{ number_format($selectedSchedule->price_per_ticket, 2) }}</p>
                                        <p class="text-sm text-gray-500 dark:text-gray-500">per person</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Booking Form -->
                            <form method="POST" action="{{ route('ferry.store') }}" id="booking-form">
                                @csrf
                                <input type="hidden" name="schedule_id" value="{{ $selectedSchedule->id }}">
                                <input type="hidden" name="departure_date" value="{{ $selectedSchedule->departure_time->format('Y-m-d') }}">

                                <!-- Booking Selection -->
                                <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 mb-8">
                                    <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Select Your Hotel Booking</h4>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">You must have an active hotel booking to purchase a ferry ticket.</p>
                                    
                                    @if($bookings->isEmpty())
                                        <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-4">
                                            <div class="flex items-center">
                                                <svg class="h-5 w-5 text-yellow-600 dark:text-yellow-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                                </svg>
                                                <span class="text-yellow-800 dark:text-yellow-200 font-medium">You don't have any active hotel bookings.</span>
                                            </div>
                                            <p class="mt-2 text-sm text-yellow-700 dark:text-yellow-300">
                                                Please <a href="{{ route('rooms.index') }}" class="underline font-medium">book a room</a> first before purchasing a ferry ticket.
                                            </p>
                                        </div>
                                    @else
                                        <div class="grid gap-4">
                                            @foreach($bookings as $booking)
                                                <label class="flex items-center p-4 border border-gray-200 dark:border-gray-600 rounded-lg hover:border-blue-500 dark:hover:border-blue-400 transition-colors cursor-pointer">
                                                    <input type="radio" name="booking_id" value="{{ $booking->id }}" class="h-4 w-4 text-blue-600 focus:ring-blue-500" required>
                                                    <div class="ml-4">
                                                        <h5 class="font-medium text-gray-900 dark:text-gray-100">{{ $booking->room->room_type ?? 'Room Booking' }}</h5>
                                                        <p class="text-sm text-gray-500 dark:text-gray-400">
                                                            {{ $booking->check_in_date->format('M d, Y') }} - {{ $booking->check_out_date->format('M d, Y') }}
                                                        </p>
                                                        <p class="text-xs text-gray-400 dark:text-gray-500">
                                                            Confirmation: {{ $booking->confirmation_code }}
                                                        </p>
                                                    </div>
                                                </label>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>

                                <!-- Passenger Selector -->
                                <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 mb-8">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Number of Passengers</h4>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Select how many tickets you need</p>
                                        </div>
                                        <div class="flex items-center bg-gray-50 dark:bg-gray-700 rounded-lg p-1">
                                            <button type="button" onclick="decreaseQuantity()" class="w-10 h-10 rounded-md bg-white dark:bg-gray-600 border border-gray-300 dark:border-gray-500 flex items-center justify-center hover:bg-gray-50 dark:hover:bg-gray-500 transition-colors">
                                                <svg class="h-4 w-4 text-gray-600 dark:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                                </svg>
                                            </button>
                                            <input type="number" name="number_of_passengers" id="passengers" min="1" max="10" value="1" class="w-16 h-10 text-center border-0 bg-transparent text-lg font-semibold text-gray-900 dark:text-gray-100 focus:ring-0" readonly>
                                            <button type="button" onclick="increaseQuantity()" class="w-10 h-10 rounded-md bg-white dark:bg-gray-600 border border-gray-300 dark:border-gray-500 flex items-center justify-center hover:bg-gray-50 dark:hover:bg-gray-500 transition-colors">
                                                <svg class="h-4 w-4 text-gray-600 dark:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Order Summary -->
                                <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-6 mb-8">
                                    <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Order Summary</h4>
                                    <div class="space-y-3">
                                        <div class="flex justify-between items-center">
                                            <span class="text-gray-600 dark:text-gray-400">Ferry Ticket × <span id="ticket-count">1</span></span>
                                            <span class="text-gray-900 dark:text-gray-100 font-medium">$<span id="subtotal">{{ number_format($selectedSchedule->price_per_ticket, 2) }}</span></span>
                                        </div>
                                        <div class="border-t border-gray-200 dark:border-gray-600 pt-3">
                                            <div class="flex justify-between items-center">
                                                <span class="text-lg font-semibold text-gray-900 dark:text-gray-100">Total</span>
                                                <span class="text-2xl font-bold text-blue-600 dark:text-blue-400">$<span id="total">{{ number_format($selectedSchedule->price_per_ticket, 2) }}</span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex flex-col sm:flex-row gap-4">
                                    <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-4 px-6 rounded-xl transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2" {{ $bookings->isEmpty() ? 'disabled' : '' }}>
                                        <div class="flex items-center justify-center">
                                            <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                            Confirm Booking
                                        </div>
                                    </button>
                                    <a href="{{ route('ferry-schedules.index') }}" class="flex-1 bg-gray-100 dark:bg-gray-600 hover:bg-gray-200 dark:hover:bg-gray-500 text-gray-900 dark:text-gray-100 font-semibold py-4 px-6 rounded-xl transition-colors text-center">
                                        Back to Schedules
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif
            @else
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100 text-center">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">Access Denied</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-6">You must be logged in to book ferry tickets.</p>
                        <a href="{{ route('login') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Login
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        const pricePerTicket = {{ $selectedSchedule ? $selectedSchedule->price_per_ticket : 0 }};

        function selectSchedule(scheduleId) {
            window.location.href = `{{ route('ferry.create') }}?schedule_id=${scheduleId}`;
        }

        function increaseQuantity() {
            const input = document.getElementById('passengers');
            const currentValue = parseInt(input.value);
            if (currentValue < 10) {
                input.value = currentValue + 1;
                updateTotals();
            }
        }

        function decreaseQuantity() {
            const input = document.getElementById('passengers');
            const currentValue = parseInt(input.value);
            if (currentValue > 1) {
                input.value = currentValue - 1;
                updateTotals();
            }
        }

        function updateTotals() {
            const passengers = parseInt(document.getElementById('passengers').value);
            const subtotal = pricePerTicket * passengers;
            
            document.getElementById('ticket-count').textContent = passengers;
            document.getElementById('subtotal').textContent = subtotal.toFixed(2);
            document.getElementById('total').textContent = subtotal.toFixed(2);
        }
    </script>
</x-app-layout>
