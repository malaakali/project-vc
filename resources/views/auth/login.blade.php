<x-guest-layout>
    <div class="bg-gray-800 p-8 rounded-lg shadow-lg border border-gray-700">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-white">Welcome to Pompy Island Resort</h1>
            <p class="text-gray-300 mt-2">Sign in to manage your bookings and reservations</p>
        </div>
        
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

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
                            Login Failed
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

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" class="text-gray-200 font-medium" />
                <x-text-input id="email" class="block mt-1 w-full bg-gray-700 border-gray-600 text-white focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" class="text-gray-200 font-medium" />

                <x-text-input id="password" class="block mt-1 w-full bg-gray-700 border-gray-600 text-white focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded bg-gray-700 border-gray-600 text-blue-600 shadow-sm focus:ring-blue-500 focus:ring-offset-gray-800" name="remember">
                    <span class="ms-2 text-sm text-gray-300">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-6">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-blue-400 hover:text-blue-300 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-primary-button class="ms-3 bg-blue-600 hover:bg-blue-700 focus:ring-blue-500">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </form>
        
        <div class="mt-6 text-center">
            <p class="text-gray-300">
                Don't have an account? 
                <a href="{{ route('register') }}" class="text-blue-400 hover:text-blue-300 font-medium underline">Register now</a>
            </p>
        </div>
    </div>
</x-guest-layout>