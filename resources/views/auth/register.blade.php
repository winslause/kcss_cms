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
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4 relative">
            <x-input-label for="password" :value="__('Password')" />

            <div class="relative">
                <x-text-input id="password" class="block mt-1 w-full pr-10"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
                
                <!-- Eye icon to toggle password visibility -->
                <span toggle="#password" class="fa fa-eye field-icon absolute right-3 top-1/2 transform -translate-y-1/2 cursor-pointer"></span>
            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4 relative">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <div class="relative">
                <x-text-input id="password_confirmation" class="block mt-1 w-full pr-10"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />
                
                <!-- Eye icon to toggle password confirmation visibility -->
                <span toggle="#password_confirmation" class="fa fa-eye field-icon absolute right-3 top-1/2 transform -translate-y-1/2 cursor-pointer"></span>
            </div>

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>

    <!-- Toggle password visibility script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const togglePasswords = document.querySelectorAll('.field-icon');
            
            togglePasswords.forEach(toggle => {
                toggle.addEventListener('click', function () {
                    const passwordInput = document.querySelector(toggle.getAttribute('toggle'));
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                    
                    // Toggle the eye icon
                    this.classList.toggle('fa-eye');
                    this.classList.toggle('fa-eye-slash');
                });
            });
        });
    </script>
</x-guest-layout>