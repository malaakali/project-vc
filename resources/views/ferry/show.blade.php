<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Ferry Ticket Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-2xl font-semibold">Ferry Ticket #{{ $ferryTicket->id }}</h3>
                        <a href="{{ route('ferry.index') }}" class="text-blue-600 hover:text-blue-900">
                            Back to Tickets
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-blue-50 dark:bg-blue-900/20 p-6 rounded-lg">
                            <h4 class="text-lg font-medium text-blue-800 dark:text-blue-200 mb-4">Ticket Information</h4>

                            <div class="space-y-3">
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Ticket ID</p>
                                    <p class="font-medium">#{{ $ferryTicket->id }}</p>
                                </div>

                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Booking Date</p>
                                    <p class="font-medium">{{ $ferryTicket->created_at->format('M d, Y') }}</p>
                                </div>

                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Status</p>
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        {{ ucfirst($ferryTicket->status) }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="bg-blue-50 dark:bg-blue-900/20 p-6 rounded-lg">
                            <h4 class="text-lg font-medium text-blue-800 dark:text-blue-200 mb-4">Journey Details</h4>

                            <div class="space-y-3">
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Ferry</p>
                                    <p class="font-medium">{{ $ferryTicket->schedule->ferry_name }}</p>
                                </div>

                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Departure</p>
                                    <p class="font-medium">{{ $ferryTicket->schedule->departure_time->format('M d, Y g:i A') }}</p>
                                </div>

                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Arrival</p>
                                    <p class="font-medium">{{ $ferryTicket->schedule->arrival_time->format('M d, Y g:i A') }}</p>
                                </div>

                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Passengers</p>
                                    <p class="font-medium">{{ $ferryTicket->number_of_passengers }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(auth()->user() && (auth()->user()->id === $ferryTicket->user_id || auth()->user()->is_admin))
                        <div class="mt-8 flex space-x-4">
                            <a href="{{ route('ferry.edit', $ferryTicket) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Edit Ticket
                            </a>

                            <form action="{{ route('ferry.destroy', $ferryTicket) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure you want to cancel this ticket?')">
                                    Cancel Ticket
                                </button>
                            </form>
                        </div>
                    @elseif(auth()->user())
                        <div class="mt-8 text-center text-gray-500 dark:text-gray-400">
                            You don't have permission to manage this ticket
                        </div>
                    @else
                        <div class="mt-8 text-center text-gray-500 dark:text-gray-400">
                            Login to manage your ticket
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
