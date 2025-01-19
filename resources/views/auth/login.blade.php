<x-guest-layout style="background-image: url('https://mrwallpaper.com/images/hd/1080p-hd-cottage-by-the-lake-ozfn18uzcfe0h7oq.jpg'); background-size: cover; background-position: center;">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        .field-icon {
            color: white; /* Make the icon white */
            z-index: 10; /* Place the icon above the input */
        }
    </style>

    <!-- Your custom logo -->
    <div class="text-center mb-6">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d7/Emblem_of_the_Republic_of_Kosovo.svg/1200px-Emblem_of_the_Republic_of_Kosovo.svg.png" alt="Kosovo Emblem" class="h-16 mx-auto">
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4 relative">
            <x-input-label for="password" :value="__('Password')" />
            
            <!-- Password input with eye icon -->
            <div class="relative">
                <x-text-input id="password" class="block mt-1 w-full pr-10" type="password" name="password" required autocomplete="current-password" />
                
                <!-- Eye icon to toggle password visibility inside the input -->
                <span toggle="#password" class="fa fa-eye field-icon absolute right-3 top-1/2 transform -translate-y-1/2 cursor-pointer"></span>
            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-4">
            <!-- "Don't have an account? Register" link -->
            <div>
                <a href="{{ route('register') }}" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">
                    {{ __("Don't have an account? Register") }}
                </a>
            </div>

            <!-- Login Button -->
            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>

    <!-- Toggle password visibility script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const togglePassword = document.querySelector('.field-icon');
            const passwordInput = document.querySelector('#password');

            togglePassword.addEventListener('click', function () {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                
                // Toggle the eye icon
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
        });
    </script>
    
</x-guest-layout>