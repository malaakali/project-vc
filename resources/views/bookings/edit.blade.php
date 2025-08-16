<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Booking') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(auth()->user() && (auth()->user()->id === $booking->user_id || auth()->user()->is_admin))
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-2xl font-semibold mb-6">Edit Your Booking</h3>

                        <form method="POST" action="{{ route('bookings.update', $booking) }}" class="space-y-6">
                            @csrf
                            @method('PUT')

                            <div>
                                <x-input-label for="date" :value="__('Travel Date')" class="text-blue-800 font-medium" />
                                <x-text-input id="date" class="block mt-1 w-full border-blue-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm" type="date" name="date" :value="old('date', $booking->date->format('Y-m-d'))" required />
                                <x-input-error :messages="$errors->get('date')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="passengers" :value="__('Number of Passengers')" class="text-blue-800 font-medium" />
                                <select name="passengers" id="passengers" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-blue-500 dark:focus:border-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 rounded-md shadow-sm" required>
                                    @for($i = 1; $i <= 10; $i++)
                                        <option value="{{ $i }}" {{ old('passengers', $booking->passengers) == $i ? 'selected' : '' }}>{{ $i }} {{ $i == 1 ? 'Passenger' : 'Passengers' }}</option>
                                    @endfor
                                </select>
                                <x-input-error :messages="$errors->get('passengers')" class="mt-2" />
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button class="bg-blue-600 hover:bg-blue-700 focus:ring-blue-500">
                                    {{ __('Update Booking') }}
                                </x-primary-button>

                                <a href="{{ route('bookings.index') }}" class="text-blue-600 hover:text-blue-900">
                                    {{ __('Cancel') }}
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            @else
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100 text-center">
                        <h3 class="text-2xl font-semibold mb-6">Access Denied</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-6">You must be logged in to edit bookings.</p>
                        <a href="{{ route('login') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Login
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>