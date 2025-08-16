<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Event') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-semibold mb-6">Edit Event</h3>

                    <form method="POST" action="{{ route('events.update', $event) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="name" :value="__('Event Name')" class="text-blue-800 font-medium" />
                            <x-text-input id="name" class="block mt-1 w-full border-blue-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm" type="text" name="name" :value="old('name', $event->name)" required />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('Description')" class="text-blue-800 font-medium" />
                            <textarea id="description" name="description" rows="4" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-blue-500 dark:focus:border-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 rounded-md shadow-sm" required>{{ old('description', $event->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="date" :value="__('Event Date')" class="text-blue-800 font-medium" />
                            <x-text-input id="date" class="block mt-1 w-full border-blue-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm" type="date" name="date" :value="old('date', $event->date->format('Y-m-d'))" required />
                            <x-input-error :messages="$errors->get('date')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="location" :value="__('Location')" class="text-blue-800 font-medium" />
                            <x-text-input id="location" class="block mt-1 w-full border-blue-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm" type="text" name="location" :value="old('location', $event->location)" required />
                            <x-input-error :messages="$errors->get('location')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="price" :value="__('Price ($)')" class="text-blue-800 font-medium" />
                            <x-text-input id="price" class="block mt-1 w-full border-blue-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm" type="number" step="0.01" name="price" :value="old('price', $event->price)" required />
                            <x-input-error :messages="$errors->get('price')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button class="bg-blue-600 hover:bg-blue-700 focus:ring-blue-500">
                                {{ __('Update Event') }}
                            </x-primary-button>

                            <a href="{{ route('events.index') }}" class="text-blue-600 hover:text-blue-900">
                                {{ __('Cancel') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>