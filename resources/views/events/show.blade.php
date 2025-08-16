<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Event Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-2xl font-semibold">{{ $event->name }}</h3>
                        <a href="{{ route('events.index') }}" class="text-blue-600 hover:text-blue-900">
                            Back to Events
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="md:col-span-2">
                            <div class="prose max-w-none dark:prose-invert">
                                <p class="text-gray-700 dark:text-gray-300">
                                    {{ $event->description }}
                                </p>
                            </div>
                        </div>
                        
                        <div class="bg-blue-50 dark:bg-blue-900/20 p-6 rounded-lg">
                            <h4 class="text-lg font-medium text-blue-800 dark:text-blue-200 mb-4">Event Details</h4>
                            
                            <div class="space-y-4">
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Date & Time</p>
                                    <p class="font-medium">{{ $event->date->format('F d, Y') }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Location</p>
                                    <p class="font-medium">{{ $event->location }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Price</p>
                                    <p class="font-medium text-xl text-green-600">${{ number_format($event->price, 2) }}</p>
                                </div>
                            </div>
                            
                            <div class="mt-6">
                                <a href="{{ route('event-tickets.create', ['event_id' => $event->id]) }}" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-center block">
                                    Book Tickets
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    @if(auth()->user()->is_admin)
                        <div class="mt-8 flex space-x-4">
                            <a href="{{ route('events.edit', $event) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Edit Event
                            </a>
                            
                            <form action="{{ route('events.destroy', $event) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure you want to delete this event?')">
                                    Delete Event
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>