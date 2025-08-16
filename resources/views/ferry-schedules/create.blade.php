<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Ferry Schedule') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="relative bg-gradient-to-r from-blue-600 to-blue-700 rounded-2xl shadow-xl p-8 mb-8 overflow-hidden">
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-3xl font-bold text-white">Create Ferry Schedule</h1>
                            <p class="text-blue-100 mt-2">Add a new ferry departure to Pompy Island</p>
                        </div>
                    </div>
                    <a href="{{ route('ferry-schedules.index') }}" class="bg-white hover:bg-gray-100 text-blue-700 font-semibold py-3 px-6 rounded-xl transition-colors shadow-lg hover:shadow-xl">
                        <div class="flex items-center">
                            <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Back to Schedules
                        </div>
                    </a>
                </div>
            </div>

            <!-- Form Card -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden">
                <div class="p-8">
                    <form method="POST" action="{{ route('ferry-schedules.store') }}" class="space-y-8">
                        @csrf

                        <!-- Basic Ferry Information -->
                        <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-6 flex items-center">
                                <div class="bg-blue-100 dark:bg-blue-900 rounded-lg p-2 mr-3">
                                    <svg class="h-5 w-5 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                                Ferry Information
                            </h3>
                            
                            <div class="grid gap-6 md:grid-cols-2">
                                <div>
                                    <label for="ferry_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Ferry Name</label>
                                    <select name="ferry_name" id="ferry_name" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:text-gray-100 transition-colors" required>
                                        <option value="">Select a ferry</option>
                                        <option value="Pompy Express" {{ old('ferry_name') == 'Pompy Express' ? 'selected' : '' }}>Pompy Express</option>
                                        <option value="Island Hopper" {{ old('ferry_name') == 'Island Hopper' ? 'selected' : '' }}>Island Hopper</option>
                                        <option value="Ocean Breeze" {{ old('ferry_name') == 'Ocean Breeze' ? 'selected' : '' }}>Ocean Breeze</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('ferry_name')" class="mt-2" />
                                </div>

                                <div>
                                    <label for="capacity" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Passenger Capacity</label>
                                    <input type="number" id="capacity" name="capacity" value="{{ old('capacity') }}" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:text-gray-100 transition-colors" placeholder="e.g., 150" required />
                                    <x-input-error :messages="$errors->get('capacity')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <!-- Schedule Details -->
                        <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-6 flex items-center">
                                <div class="bg-green-100 dark:bg-green-900 rounded-lg p-2 mr-3">
                                    <svg class="h-5 w-5 text-green-600 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                Schedule & Timing
                            </h3>
                            
                            <div class="grid gap-6 md:grid-cols-2">
                                <div>
                                    <label for="departure_time" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Departure Time</label>
                                    <input type="datetime-local" id="departure_time" name="departure_time" value="{{ old('departure_time') }}" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:text-gray-100 transition-colors" required />
                                    <x-input-error :messages="$errors->get('departure_time')" class="mt-2" />
                                </div>

                                <div>
                                    <label for="arrival_time" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Arrival Time</label>
                                    <input type="datetime-local" id="arrival_time" name="arrival_time" value="{{ old('arrival_time') }}" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:text-gray-100 transition-colors" required />
                                    <x-input-error :messages="$errors->get('arrival_time')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <!-- Pricing -->
                        <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-6 flex items-center">
                                <div class="bg-yellow-100 dark:bg-yellow-900 rounded-lg p-2 mr-3">
                                    <svg class="h-5 w-5 text-yellow-600 dark:text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                                    </svg>
                                </div>
                                Pricing
                            </h3>
                            
                            <div>
                                <label for="price_per_ticket" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Price per Ticket</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 text-lg font-medium">$</span>
                                    </div>
                                    <input type="number" step="0.01" id="price_per_ticket" name="price_per_ticket" value="{{ old('price_per_ticket') }}" class="w-full pl-8 pr-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:text-gray-100 transition-colors" placeholder="25.00" required />
                                </div>
                                <x-input-error :messages="$errors->get('price_per_ticket')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Recurring Schedule Options -->
                        <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-6 flex items-center">
                                <div class="bg-purple-100 dark:bg-purple-900 rounded-lg p-2 mr-3">
                                    <svg class="h-5 w-5 text-purple-600 dark:text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                    </svg>
                                </div>
                                Recurring Schedule (Optional)
                            </h3>

                            <div class="space-y-6">
                                <div class="flex items-center p-4 bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-600">
                                    <input id="is_recurring" name="is_recurring" type="checkbox" value="1" class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" onchange="toggleRecurringOptions()">
                                    <div class="ml-4">
                                        <label for="is_recurring" class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                            Create recurring schedule
                                        </label>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Automatically generate future schedules based on this pattern</p>
                                    </div>
                                </div>

                                <div id="recurring-options" class="space-y-6 hidden">
                                    <div class="grid gap-6 md:grid-cols-2">
                                        <div>
                                            <label for="recurrence_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Recurrence Type</label>
                                            <select name="recurrence_type" id="recurrence_type" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:text-gray-100 transition-colors" onchange="toggleDaysOfWeek()">
                                                <option value="">Select recurrence type</option>
                                                <option value="daily">Daily</option>
                                                <option value="weekly">Weekly</option>
                                                <option value="monthly">Monthly</option>
                                            </select>
                                            <x-input-error :messages="$errors->get('recurrence_type')" class="mt-2" />
                                        </div>

                                        <div>
                                            <label for="recurrence_interval" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Repeat Every</label>
                                            <input type="number" id="recurrence_interval" name="recurrence_interval" value="{{ old('recurrence_interval', 1) }}" min="1" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:text-gray-100 transition-colors" />
                                            <p class="mt-1 text-xs text-gray-500">e.g., 1 = every day/week/month, 2 = every 2 days/weeks/months</p>
                                            <x-input-error :messages="$errors->get('recurrence_interval')" class="mt-2" />
                                        </div>
                                    </div>

                                    <div id="days-of-week" class="hidden">
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Days of Week</label>
                                        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-7 gap-3">
                                            @php
                                                $days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                                            @endphp
                                            @foreach($days as $index => $day)
                                                <label class="flex items-center p-3 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors cursor-pointer">
                                                    <input type="checkbox" name="days_of_week[]" value="{{ $index }}" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                                    <span class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">{{ $day }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div>
                                        <label for="recurrence_end_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">End Date (Optional)</label>
                                        <input type="date" id="recurrence_end_date" name="recurrence_end_date" value="{{ old('recurrence_end_date') }}" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:text-gray-100 transition-colors" />
                                        <p class="mt-1 text-sm text-gray-500">Leave empty to repeat for one year</p>
                                        <x-input-error :messages="$errors->get('recurrence_end_date')" class="mt-2" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script>
                            function toggleRecurringOptions() {
                                const checkbox = document.getElementById('is_recurring');
                                const options = document.getElementById('recurring-options');
                                if (checkbox.checked) {
                                    options.classList.remove('hidden');
                                } else {
                                    options.classList.add('hidden');
                                }
                            }

                            function toggleDaysOfWeek() {
                                const select = document.getElementById('recurrence_type');
                                const daysOfWeek = document.getElementById('days-of-week');
                                if (select.value === 'weekly') {
                                    daysOfWeek.classList.remove('hidden');
                                } else {
                                    daysOfWeek.classList.add('hidden');
                                }
                            }
                        </script>

                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200 dark:border-gray-600">
                            <button type="submit" class="flex-1 sm:flex-none bg-blue-600 hover:bg-blue-700 text-white font-semibold py-4 px-8 rounded-xl transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 shadow-lg hover:shadow-xl">
                                <div class="flex items-center justify-center">
                                    <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                    Create Schedule
                                </div>
                            </button>
                            <a href="{{ route('ferry-schedules.index') }}" class="flex-1 sm:flex-none bg-gray-100 dark:bg-gray-600 hover:bg-gray-200 dark:hover:bg-gray-500 text-gray-900 dark:text-gray-100 font-semibold py-4 px-8 rounded-xl transition-colors text-center shadow-lg hover:shadow-xl">
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
        </div>
    </div>
</x-app-layout>
