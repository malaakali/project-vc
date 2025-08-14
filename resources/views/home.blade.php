<x-app-layout>
<div class="relative min-h-screen bg-gradient-to-b from-blue-50 to-blue-100 overflow-hidden">
    <!-- Waves Background -->
    <div class="absolute inset-0 z-0">
        <svg class="absolute bottom-0 w-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#0ea5e9" fill-opacity="0.3" d="M0,192L48,197.3C96,203,192,213,288,229.3C384,245,480,267,576,250.7C672,235,768,181,864,181.3C960,181,1056,235,1152,234.7C1248,235,1344,181,1392,154.7L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
            <path fill="#0ea5e9" fill-opacity="0.5" d="M0,224L48,218.7C96,213,192,203,288,197.3C384,192,480,192,576,208C672,224,768,256,864,250.7C960,245,1056,203,1152,181.3C1248,160,1344,160,1392,160L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
            <path fill="#0ea5e9" fill-opacity="0.7" d="M0,160L48,176C96,192,192,224,288,240C384,256,480,256,576,240C672,224,768,192,864,197.3C960,203,1056,245,1152,250.7C1248,256,1344,224,1392,208L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
    </div>

    <!-- Main Content -->
    <div class="relative z-10 container mx-auto px-4 py-12">
        <!-- Header Section -->
        <div class="text-center py-16 md:py-24">
            <h1 class="text-5xl md:text-7xl font-bold text-blue-900 mb-6 animate-fade-in">
                Welcome to <span class="text-blue-600">Pompy Island</span>
            </h1>
            <p class="text-xl md:text-2xl text-blue-800 max-w-3xl mx-auto mb-10">
                Your gateway to paradise - Book your ferry tickets to Pompy Island Resort
            </p>
            
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <x-bladewind::button 
                    size="big" 
                    class="bg-blue-600 hover:bg-blue-700"
                    onclick="window.location='{{ route('ferry.index') }}'"
                >
                    Book Ferry Tickets
                </x-bladewind::button>
                <x-bladewind::button 
                    size="big" 
                    type="secondary"
                    class="border-blue-600 text-blue-600 hover:bg-blue-50"
                    onclick="window.location='{{ route('ferry-schedules.index') }}'"
                >
                    View Schedules
                </x-bladewind::button>
            </div>
        </div>

        <!-- Features Section -->
        <div class="py-16">
            <h2 class="text-3xl md:text-4xl font-bold text-center text-blue-900 mb-16">
                Why Travel with Pompy Ferries?
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <x-bladewind::card class="animate-fade-in p-6">
                    <x-slot name="header">
                        <div class="flex justify-center mb-4">
                            <div class="bg-blue-100 p-4 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-center text-blue-900">Fast & Reliable</h3>
                    </x-slot>
                    <p class="text-gray-600 text-center">
                        Our modern fleet ensures quick and comfortable journeys to Pompy Island.
                    </p>
                </x-bladewind::card>

                <!-- Feature 2 -->
                <x-bladewind::card class="animate-fade-in p-6">
                    <x-slot name="header">
                        <div class="flex justify-center mb-4">
                            <div class="bg-blue-100 p-4 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-center text-blue-900">Scenic Routes</h3>
                    </x-slot>
                    <p class="text-gray-600 text-center">
                        Enjoy breathtaking views of the ocean during your journey to paradise.
                    </p>
                </x-bladewind::card>

                <!-- Feature 3 -->
                <x-bladewind::card class="animate-fade-in p-6">
                    <x-slot name="header">
                        <div class="flex justify-center mb-4">
                            <div class="bg-blue-100 p-4 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-center text-blue-900">Flexible Scheduling</h3>
                    </x-slot>
                    <p class="text-gray-600 text-center">
                        Multiple departure times daily to fit your travel plans perfectly.
                    </p>
                </x-bladewind::card>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="py-16 text-center">
            <div class="max-w-3xl mx-auto">
                <h2 class="text-3xl md:text-4xl font-bold text-blue-900 mb-6">
                    Ready for Your Island Getaway?
                </h2>
                <p class="text-xl text-blue-800 mb-10">
                    Book your ferry tickets now and start your vacation at Pompy Island Resort.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <x-bladewind::button 
                        size="big" 
                        class="bg-blue-600 hover:bg-blue-700"
                        onclick="window.location='{{ route('ferry.create') }}'"
                    >
                        Book Now
                    </x-bladewind::button>
                    <x-bladewind::button 
                        size="big" 
                        type="secondary"
                        class="border-blue-600 text-blue-600 hover:bg-blue-50"
                        onclick="window.location='{{ route('events.index') }}'"
                    >
                        Island Events
                    </x-bladewind::button>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom Styles -->
    <style>
        @keyframes fade-in {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fade-in 1s ease-out;
        }
    </style>
</div>
</x-app-layout>