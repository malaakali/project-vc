<x-guest-layout>
    <div class="bg-gradient-to-br from-blue-50 to-cyan-100 dark:from-gray-800 dark:to-gray-700 p-8 rounded-lg shadow-lg border dark:border-gray-600">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-blue-900 dark:text-white">Forgot Password</h1>
            <p class="text-blue-700 dark:text-gray-300 mt-2">No problem. Just let us know your email address and we'll send you a password reset link.</p>
        </div>
        
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" class="text-blue-800 dark:text-gray-200 font-medium" />
                <x-text-input id="email" class="block mt-1 w-full border-blue-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm" type="email" name="email" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-6">
                <x-primary-button class="bg-blue-600 hover:bg-blue-700 focus:ring-blue-500">
                    {{ __('Email Password Reset Link') }}
                </x-primary-button>
            </div>
        </form>
        
        <div class="mt-6 text-center">
            <a href="{{ route('login') }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 font-medium underline">Back to Login</a>
        </div>
    </div>
</x-guest-layout>