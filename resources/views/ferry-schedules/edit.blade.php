<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Schedule') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-semibold mb-6">Edit Ferry Schedule</h3>

                    <form method="POST" action="{{ route('ferry-schedules.update', $ferrySchedule) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="ferry_name" :value="__('Ferry Name')" class="text-blue-800 font-medium" />
                            <x-text-input id="ferry_name" class="block mt-1 w-full border-blue-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm" type="text" name="ferry_name" :value="old('ferry_name', $ferrySchedule->ferry_name)" required />
                            <x-input-error :messages="$errors->get('ferry_name')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="departure_time" :value="__('Departure Time')" class="text-blue-800 font-medium" />
                            <x-text-input id="departure_time" class="block mt-1 w-full border-blue-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm" type="datetime-local" name="departure_time" :value="old('departure_time', $ferrySchedule->departure_time->format('Y-m-d\TH:i'))" required />
                            <x-input-error :messages="$errors->get('departure_time')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="arrival_time" :value="__('Arrival Time')" class="text-blue-800 font-medium" />
                            <x-text-input id="arrival_time" class="block mt-1 w-full border-blue-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm" type="datetime-local" name="arrival_time" :value="old('arrival_time', $ferrySchedule->arrival_time->format('Y-m-d\TH:i'))" required />
                            <x-input-error :messages="$errors->get('arrival_time')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="capacity" :value="__('Capacity')" class="text-blue-800 font-medium" />
                            <x-text-input id="capacity" class="block mt-1 w-full border-blue-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm" type="number" name="capacity" :value="old('capacity', $ferrySchedule->capacity)" required />
                            <x-input-error :messages="$errors->get('capacity')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="price_per_ticket" :value="__('Price Per Ticket ($)')" class="text-blue-800 font-medium" />
                            <x-text-input id="price_per_ticket" class="block mt-1 w-full border-blue-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm" type="number" step="0.01" name="price_per_ticket" :value="old('price_per_ticket', $ferrySchedule->price_per_ticket)" required />
                            <x-input-error :messages="$errors->get('price_per_ticket')" class="mt-2" />
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $ferrySchedule->is_active) ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                            <x-input-label for="is_active" :value="__('Is Active')" class="ml-2 text-blue-800 font-medium" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button class="bg-blue-600 hover:bg-blue-700 focus:ring-blue-500">
                                {{ __('Update Schedule') }}
                            </x-primary-button>

                            <a href="{{ route('ferry-schedules.index') }}" class="text-blue-600 hover:text-blue-900">
                                {{ __('Cancel') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>