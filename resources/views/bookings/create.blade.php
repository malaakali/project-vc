<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Book Room') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if(auth()->user())
                <!-- Header Section -->
                <div class="relative bg-gradient-to-r from-orange-600 to-red-600 rounded-2xl shadow-xl p-8 mb-8 overflow-hidden">
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
                        <div class="flex items-center">
                            <div class="bg-white/20 rounded-full p-4 mr-6">
                                <svg class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            <div>
                                <h1 class="text-3xl font-bold text-white">Book Your Stay</h1>
                                <p class="text-orange-100 mt-2">Reserve accommodation on Pompy Island</p>
                            </div>
                        </div>
                        <a href="{{ route('rooms.index') }}" class="bg-white hover:bg-gray-100 text-orange-700 font-semibold py-3 px-6 rounded-xl transition-colors shadow-lg hover:shadow-xl">
                            <div class="flex items-center">
                                <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Browse Rooms
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Form Card -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden">
                    <div class="p-8">
                        <form method="POST" action="{{ route('bookings.store') }}" class="space-y-8">
                            @csrf

                            @if(request('room_id'))
                                <input type="hidden" name="room_id" value="{{ request('room_id') }}" />
                            @endif

                            <!-- Room Selection -->
                            @if(!request('room_id'))
                            <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-6">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-6 flex items-center">
                                    <div class="bg-orange-100 dark:bg-orange-900 rounded-lg p-2 mr-3">
                                        <svg class="h-5 w-5 text-orange-600 dark:text-orange-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                    </div>
                                    Room Selection
                                </h3>

                                <div>
                                    <label for="room_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Choose Room</label>
                                    <select name="room_id" id="room_id" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 dark:bg-gray-800 dark:text-gray-100 transition-colors" required>
                                        <option value="">Select a room</option>
                                        <!-- Room options would be populated from the controller -->
                                    </select>
                                    <x-input-error :messages="$errors->get('room_id')" class="mt-2" />
                                </div>
                            </div>
                            @endif

                            <!-- Stay Dates -->
                            <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-6">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-6 flex items-center">
                                    <div class="bg-blue-100 dark:bg-blue-900 rounded-lg p-2 mr-3">
                                        <svg class="h-5 w-5 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    Stay Dates
                                </h3>

                                <div class="grid gap-6 md:grid-cols-2">
                                    <div>
                                        <label for="check_in_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Check-in Date</label>
                                        <input type="date" id="check_in_date" name="check_in_date" value="{{ old('check_in_date') }}" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 dark:bg-gray-800 dark:text-gray-100 transition-colors" required />
                                        <x-input-error :messages="$errors->get('check_in_date')" class="mt-2" />
                                    </div>

                                    <div>
                                        <label for="check_out_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Check-out Date</label>
                                        <input type="date" id="check_out_date" name="check_out_date" value="{{ old('check_out_date') }}" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 dark:bg-gray-800 dark:text-gray-100 transition-colors" required />
                                        <x-input-error :messages="$errors->get('check_out_date')" class="mt-2" />
                                    </div>
                                </div>
                            </div>

                            <!-- Guest Selector -->
                            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 mb-8">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Number of Guests</h4>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Select how many beds you need</p>
                                    </div>
                                    <div class="flex items-center bg-gray-50 dark:bg-gray-700 rounded-lg p-1">
                                        <button type="button" onclick="decreaseQuantity()" class="w-10 h-10 rounded-md bg-white dark:bg-gray-600 border border-gray-300 dark:border-gray-500 flex items-center justify-center hover:bg-gray-50 dark:hover:bg-gray-500 transition-colors">
                                            <svg class="h-4 w-4 text-gray-600 dark:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                            </svg>
                                        </button>
                                        <input type="number" name="number_of_guests" id="guests" min="1" max="10" value="1" class="w-16 h-10 text-center border-0 bg-transparent text-lg font-semibold text-gray-900 dark:text-gray-100 focus:ring-0" readonly>
                                        <button type="button" onclick="increaseQuantity()" class="w-10 h-10 rounded-md bg-white dark:bg-gray-600 border border-gray-300 dark:border-gray-500 flex items-center justify-center hover:bg-gray-50 dark:hover:bg-gray-500 transition-colors">
                                            <svg class="h-4 w-4 text-gray-600 dark:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>


                            <!-- Action Buttons -->
                            <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200 dark:border-gray-600">
                                <button type="submit" class="flex-1 sm:flex-none bg-orange-600 hover:bg-orange-700 text-white font-semibold py-4 px-8 rounded-xl transition-colors focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 shadow-lg hover:shadow-xl">
                                    <div class="flex items-center justify-center">
                                        <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        Book Room
                                    </div>
                                </button>
                                <a href="{{ route('rooms.index') }}" class="flex-1 sm:flex-none bg-gray-100 dark:bg-gray-600 hover:bg-gray-200 dark:hover:bg-gray-500 text-gray-900 dark:text-gray-100 font-semibold py-4 px-8 rounded-xl transition-colors text-center shadow-lg hover:shadow-xl">
                                    <div class="flex items-center justify-center">
                                        <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                        </svg>
                                        Cancel
                                    </div>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            @else
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden">
                    <div class="p-8 text-center">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">Access Denied</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-6">You must be logged in to book rooms.</p>
                        <a href="{{ route('login') }}" class="bg-orange-600 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded">
                            Login
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        function increaseQuantity() {
            const input = document.getElementById('guests');
            const currentValue = parseInt(input.value);
            if (currentValue < 10) {
                input.value = currentValue + 1;
            }
        }

        function decreaseQuantity() {
            const input = document.getElementById('guests');
            const currentValue = parseInt(input.value);
            if (currentValue > 1) {
                input.value = currentValue - 1;
                updateTotals();
            }
        }
    </script>
</x-app-layout>
