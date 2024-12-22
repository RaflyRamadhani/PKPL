<x-guest-layout>
    <head>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <div class="container">
        <h1 class="text-center">Login</h1>
        <form method="POST" action="{{ route('login') }}">
            @csrf <!-- Protect form with CSRF token -->
            
            <div class="form-group">
                <label for="email">Email</label>
                <x-text-input id="email" type="email" name="email" class="form-control" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="error" />
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <x-text-input id="password" type="password" name="password" class="form-control" required />
                <x-input-error :messages="$errors->get('password')" class="error" />
            </div>

            <div class="remember-me">
                <label for="remember_me">
                    <input id="remember_me" type="checkbox" name="remember">
                    <span>{{ __('Remember me') }}</span>
                </label>
            </div>

            <button type="submit" class="btn btn-primary">Login</button>

            <div class="mt-3">
                <a class="forgot-password" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            </div>
        </form>

        <div class="register-link mt-3">
            <p>Don't have an account? <a href="{{ route('register') }}">{{ __('Register') }}</a></p>
        </div>
    </div>
</x-guest-layout>
