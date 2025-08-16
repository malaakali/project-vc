<x-guest-layout>
    <div class="bg-gray-800 p-8 rounded-lg shadow-lg border border-gray-700">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-white">Join Pompy Island Resort</h1>
            <p class="text-gray-300 mt-2">Create an account to book your ferry tickets and accommodations</p>
        </div>
        
        <!-- Validation Errors Summary -->
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-900/50 border border-red-700 rounded-md">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-300">
                            Registration Failed
                        </h3>
                        <div class="mt-2 text-sm text-red-200">
                            <ul class="list-disc pl-5 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" class="text-gray-200 font-medium" />
                <x-text-input id="name" class="block mt-1 w-full bg-gray-700 border-gray-600 text-white focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" class="text-gray-200 font-medium" />
                <x-text-input id="email" class="block mt-1 w-full bg-gray-700 border-gray-600 text-white focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" class="text-gray-200 font-medium" />

                <x-text-input id="password" class="block mt-1 w-full bg-gray-700 border-gray-600 text-white focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-200 font-medium" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full bg-gray-700 border-gray-600 text-white focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-6">
                <a class="underline text-sm text-blue-400 hover:text-blue-300 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 focus:ring-offset-gray-800" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="ms-4 bg-blue-600 hover:bg-blue-700 focus:ring-blue-500">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
        
        <div class="mt-6 text-center">
            <p class="text-gray-300">
                By registering, you agree to our 
                <a href="#" class="text-blue-400 hover:text-blue-300 font-medium underline">Terms of Service</a> and 
                <a href="#" class="text-blue-400 hover:text-blue-300 font-medium underline">Privacy Policy</a>
            </p>
        </div>
    </div>
</x-guest-layout>