<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
{{--                    <h3 class="text-2xl font-semibold mb-6">Welcome to Your Pompy Island Dashboard</h3>--}}
{{--                    <p class="mb-6">Manage your ferry bookings, accommodation reservations, and island activities all in one place.</p>--}}

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <a href="{{ route('ferry.index') }}" class="bg-blue-50 dark:bg-blue-900/50 p-6 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-800 transition">
                            <div class="flex items-center">
                                <svg class="h-8 w-8 text-blue-600 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                                <h4 class="text-lg font-medium">Ferry Tickets</h4>
                            </div>
                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">View and manage your ferry bookings to Pompy Island</p>
                        </a>

                        <a href="{{ route('bookings.index') }}" class="bg-green-50 dark:bg-green-900/50 p-6 rounded-lg hover:bg-green-100 dark:hover:bg-green-800 transition">
                            <div class="flex items-center">
                                <svg class="h-8 w-8 text-green-600 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <h4 class="text-lg font-medium">My Bookings</h4>
                            </div>
                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">Manage all your reservations and bookings</p>
                        </a>

                        <a href="{{ route('rooms.index') }}" class="bg-purple-50 dark:bg-purple-900/50 p-6 rounded-lg hover:bg-purple-100 dark:hover:bg-purple-800 transition">
                            <div class="flex items-center">
                                <svg class="h-8 w-8 text-purple-600 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                                <h4 class="text-lg font-medium">Accommodations</h4>
                            </div>
                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">View and manage your room reservations</p>
                        </a>
                    </div>

                    <div class="mt-8">
                        <h4 class="text-xl font-medium mb-4">Quick Actions</h4>
                        <div class="flex flex-wrap gap-4">
                            <a href="{{ route('ferry.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">Book Ferry</a>
                            <a href="{{ route('rooms.index') }}" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition">Book Room</a>
                            <a href="{{ route('events.index') }}" class="px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700 transition">View Events</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
