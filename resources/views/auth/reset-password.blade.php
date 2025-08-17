<x-guest-layout>
    <div class="bg-gradient-to-br from-blue-50 to-cyan-100 dark:from-gray-800 dark:to-gray-700 p-8 rounded-lg shadow-lg border dark:border-gray-600">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-blue-900 dark:text-white">Reset Password</h1>
            <p class="text-blue-700 dark:text-gray-300 mt-2">Enter your new password below to reset your account password.</p>
        </div>
        
        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" class="text-blue-800 dark:text-gray-200 font-medium" />
                <x-text-input id="email" class="block mt-1 w-full border-blue-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" class="text-blue-800 dark:text-gray-200 font-medium" />
                <x-text-input id="password" class="block mt-1 w-full border-blue-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-blue-800 dark:text-gray-200 font-medium" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full border-blue-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm"
                                    type="password"
                                    name="password_confirmation" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-6">
                <x-primary-button class="bg-blue-600 hover:bg-blue-700 focus:ring-blue-500">
                    {{ __('Reset Password') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>