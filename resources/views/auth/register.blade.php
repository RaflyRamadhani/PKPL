<x-guest-layout>
    <head>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>

    <div class="container">
        <h1 class="text-center">Register</h1>
        
        <form method="POST" action="{{ route('register') }}">
            @csrf <!-- Protect form with CSRF token -->

            <!-- Name -->
            <div class="form-group">
                <label for="name">{{ __('Name') }}</label>
                <x-text-input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="error" />
            </div>

            <!-- Email Address -->
            <div class="form-group">
                <label for="email">{{ __('Email') }}</label>
                <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="error" />
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">{{ __('Password') }}</label>
                <x-text-input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="error" />
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <label for="password_confirmation">{{ __('Confirm Password') }}</label>
                <x-text-input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="error" />
            </div>

            <button type="submit" class="btn">Register</button>
        </form>

        <!-- Link to Login Page -->
        <div class="register-link mt-3">
            <p>Already have an account? <a href="{{ route('login') }}">{{ __('Login here') }}</a></p>
        </div>
    </div>
</x-guest-layout>
