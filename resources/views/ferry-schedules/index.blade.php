<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Ferry Schedules') }}
        </h2>
    </x-slot>

{{--    <div class="py-12">--}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
{{--            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">--}}
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-6">
{{--                        <h3 class="text-2xl font-semibold">Ferry Schedules</h3>--}}
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('ferry-schedules.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Add New Schedule
                            </a>
                        @endif
                    </div>

                    @if(session('status') === 'schedule-created')
                        <div class="mb-4 text-sm text-green-600 dark:text-green-400">
                            {{ __('Schedule created successfully!') }}
                        </div>
                    @elseif(session('status') === 'schedule-updated')
                        <div class="mb-4 text-sm text-green-600 dark:text-green-400">
                            {{ __('Schedule updated successfully!') }}
                        </div>
                    @elseif(session('status') === 'schedule-deleted')
                        <div class="mb-4 text-sm text-green-600 dark:text-green-400">
                            {{ __('Schedule deleted successfully!') }}
                        </div>
                    @endif

                    @if($groupedSchedules->isEmpty())
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <h3 class="mt-2 text-lg font-medium text-gray-900 dark:text-gray-100">No schedules available</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                There are no ferry schedules available at this time.
                            </p>
                        </div>
                    @else
                        <div class="space-y-8">
                            @foreach($groupedSchedules as $date => $schedules)
                                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden border border-gray-200 dark:border-gray-700">
                                    <!-- Date Header with Train Line Style -->
                                    <div class="relative bg-gradient-to-r from-blue-600 to-blue-700 px-8 py-6 overflow-hidden">
                                        <!-- Wave Background -->
                                        <div class="absolute inset-0 opacity-20">
                                            <svg class="absolute bottom-0 left-0 w-full h-full" viewBox="0 0 1200 120" preserveAspectRatio="none">
                                                <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" fill="rgba(255,255,255,0.1)"></path>
                                            </svg>
                                            <svg class="absolute bottom-0 left-0 w-full h-full" viewBox="0 0 1200 120" preserveAspectRatio="none">
                                                <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" fill="rgba(255,255,255,0.05)"></path>
                                            </svg>
                                        </div>

                                        <div class="relative z-10 flex items-center">
                                            <div class="bg-white/20 rounded-full p-3 mr-4">
                                                <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <h3 class="text-2xl font-bold text-white">
                                                    {{ \Carbon\Carbon::parse($date)->format('l, F j, Y') }}
                                                </h3>
                                                <p class="text-blue-100">
                                                    {{ count($schedules) }} ferry {{ count($schedules) === 1 ? 'departure' : 'departures' }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Train Line Timeline -->
                                    <div class="p-8">
                                        <div class="relative">
                                            <!-- Main Timeline Line -->
                                            <div class="absolute left-8 top-0 bottom-0 w-1 bg-gradient-to-b from-blue-500 to-blue-600 rounded-full"></div>

                                            <div class="space-y-6">
                                                @foreach($schedules as $index => $schedule)
                                                    <div class="relative flex items-center group">
                                                        <!-- Station Dot -->
                                                        <div class="relative z-10 flex-shrink-0">
                                                            <div class="w-6 h-6 bg-blue-600 border-4 border-white dark:border-gray-800 rounded-full shadow-lg group-hover:bg-blue-700 transition-colors"></div>
                                                        </div>

                                                        <!-- Ferry Schedule Card -->
                                                        <div class="ml-8 flex-1 bg-gray-50 dark:bg-gray-700 rounded-xl p-6 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors">
                                                            <div class="flex items-center justify-between">
                                                                <!-- Left Side: Ferry Info -->
                                                                <div class="flex items-center space-x-6">
                                                                    <!-- Ferry Icon -->
                                                                    <div class="bg-blue-100 dark:bg-blue-900 p-3 rounded-lg">
                                                                        <svg class="h-6 w-6 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                                                        </svg>
                                                                    </div>

                                                                    <!-- Schedule Details -->
                                                                    <div>
                                                                        <h4 class="text-lg font-bold text-gray-900 dark:text-gray-100">
                                                                            {{ $schedule->ferry_name }}
                                                                        </h4>
                                                                        <div class="flex items-center mt-1">
                                                                            <span class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                                                                                {{ $schedule->departure_time->format('g:i A') }}
                                                                            </span>
                                                                            <svg class="h-4 w-4 mx-3 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                                                            </svg>
                                                                            <span class="text-lg text-gray-600 dark:text-gray-400">
                                                                                {{ $schedule->arrival_time->format('g:i A') }}
                                                                            </span>
                                                                        </div>
                                                                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                                                            Duration: {{ $schedule->departure_time->diffInHours($schedule->arrival_time) }}h {{ $schedule->departure_time->diff($schedule->arrival_time)->i }}m
                                                                        </p>
                                                                    </div>
                                                                </div>

                                                                <!-- Center: Capacity & Type -->
                                                                <div class="text-center">
                                                                    <div class="flex items-center space-x-4">
                                                                        <div class="text-center">
                                                                            <p class="text-sm text-gray-500 dark:text-gray-400">Capacity</p>
                                                                            <p class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $schedule->capacity }}</p>
                                                                        </div>
                                                                        <div class="text-center">
                                                                            @if($schedule->is_recurring && !$schedule->parent_schedule_id)
                                                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                                                                    🔄 Recurring
                                                                                </span>
                                                                            @elseif($schedule->parent_schedule_id)
                                                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                                                                    🤖 Auto-generated
                                                                                </span>
                                                                            @else
                                                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200">
                                                                                    📅 One-time
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!-- Right Side: Price & Actions -->
                                                                <div class="text-right">
                                                                    <div class="mb-4">
                                                                        <p class="text-3xl font-bold text-blue-600 dark:text-blue-400">
                                                                            ${{ number_format($schedule->price_per_ticket, 2) }}
                                                                        </p>
                                                                        <p class="text-sm text-gray-500 dark:text-gray-400">per person</p>
                                                                    </div>

                                                                    <div class="flex flex-col space-y-2">
                                                                        @if(auth()->user()->is_admin)
                                                                            @if(!$schedule->parent_schedule_id)
                                                                                <a href="{{ route('ferry-schedules.edit', $schedule) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition-colors">
                                                                                    <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                                                    </svg>
                                                                                    Edit
                                                                                </a>
                                                                            @endif
                                                                            <form action="{{ route('ferry-schedules.destroy', $schedule) }}" method="POST" class="inline">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition-colors" onclick="return confirm('Are you sure you want to delete this schedule?')">
                                                                                    <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                                                    </svg>
                                                                                    Delete
                                                                                </button>
                                                                            </form>
                                                                        @elseif(auth()->user())
                                                                            <a href="{{ route('ferry.create', ['schedule_id' => $schedule->id]) }}" class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-colors shadow-lg hover:shadow-xl">
                                                                                <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                                </svg>
                                                                                Book Now
                                                                            </a>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
{{--        </div>--}}
{{--    </div>--}}
</x-app-layout>
