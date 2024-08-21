<x-guest-layout>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card p-4 shadow-lg" style="background-color: #1d021f;">
                    <h3 class="text-center mb-4" style="color: #bd0cc9;">Iniciar Sesión</h3>

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email Address -->
                        <div class="mb-3">
                            <x-input-label for="email" :value="__('Email')" style="color: #bd0cc9;" />
                            <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" style="color: #f00;" />
                        </div>

                        <!-- Password -->
                        <div class="mb-4">
                            <x-input-label for="password" :value="__('Password')" style="color: #bd0cc9;" />
                            <x-text-input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" style="color: #f00;" />
                        </div>

                        <!-- Remember Me -->
                        <div class="form-check mb-4">
                            <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                            <label for="remember_me" class="form-check-label" style="color: #bd0cc9;">{{ __('Remember me') }}</label>
                        </div>

                        <!-- Buttons -->
                        <div class="text-center">
                            <x-primary-button class="btn btn-light px-4" style="background-color: #6d0774; color: #FFFFFF;">
                                {{ __('Log in') }}
                            </x-primary-button>
                        </div>

                        <div class="text-center mt-3">
                            @if (Route::has('password.request'))
                            <a class="text-sm" href="{{ route('password.request') }}" style="color: #bd0cc9;">
                                {{ __('Forgot your password?') }}
                            </a>
                            @endif
                        </div>

                        <div class="text-center mt-3">
                            <a href="{{ route('register') }}" class="btn btn-light px-4" style="background-color: #6d0774; color: #FFFFFF;">Registrarse</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
