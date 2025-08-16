<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Schedule Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-2xl font-semibold">Ferry Schedule Details</h3>
                        <a href="{{ route('ferry-schedules.index') }}" class="text-blue-600 hover:text-blue-900">
                            Back to Schedules
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-blue-50 dark:bg-blue-900/20 p-6 rounded-lg">
                            <h4 class="text-lg font-medium text-blue-800 dark:text-blue-200 mb-4">Ferry Information</h4>
                            
                            <div class="space-y-3">
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Ferry Name</p>
                                    <p class="font-medium">{{ $ferrySchedule->ferry_name }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Capacity</p>
                                    <p class="font-medium">{{ $ferrySchedule->capacity }} passengers</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-blue-50 dark:bg-blue-900/20 p-6 rounded-lg">
                            <h4 class="text-lg font-medium text-blue-800 dark:text-blue-200 mb-4">Schedule Details</h4>
                            
                            <div class="space-y-3">
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Departure</p>
                                    <p class="font-medium">{{ $ferrySchedule->departure_time->format('M d, Y g:i A') }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Arrival</p>
                                    <p class="font-medium">{{ $ferrySchedule->arrival_time->format('M d, Y g:i A') }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Duration</p>
                                    <p class="font-medium">{{ $ferrySchedule->departure_time->diffInHours($ferrySchedule->arrival_time) }}h {{ $ferrySchedule->departure_time->diff($ferrySchedule->arrival_time)->i }}m</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Price</p>
                                    <p class="font-medium text-xl text-green-600">${{ number_format($ferrySchedule->price_per_ticket, 2) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    @if(!auth()->user()->is_admin)
                        <div class="mt-6">
                            <a href="{{ route('ferry.create', ['schedule_id' => $ferrySchedule->id]) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Book This Ferry
                            </a>
                        </div>
                    @else
                        <div class="mt-8 flex space-x-4">
                            <a href="{{ route('ferry-schedules.edit', $ferrySchedule) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Edit Schedule
                            </a>
                            
                            <form action="{{ route('ferry-schedules.destroy', $ferrySchedule) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure you want to delete this schedule?')">
                                    Delete Schedule
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>