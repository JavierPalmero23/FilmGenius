<x-guest-layout>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card p-4 shadow-lg" style="background-color: #1d021f;">
                    <h3 class="text-center mb-4" style="color: #bd0cc9;">Regístrate en FilmGenius</h3>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Name -->
                        <div class="mb-4">
                            <label for="name" class="form-label" style="color: #bd0cc9;">Nombre</label>
                            <input id="name" class="form-control" style="background-color: #2c052f; color: #FFFFFF;" type="text" name="name" :value="old('name')" required autofocus autocomplete="name">
                            @if ($errors->has('name'))
                                <small class="text-danger">{{ $errors->first('name') }}</small>
                            @endif
                        </div>

                        <!-- Email Address -->
                        <div class="mb-4">
                            <label for="email" class="form-label" style="color: #bd0cc9;">Correo Electrónico</label>
                            <input id="email" class="form-control" style="background-color: #2c052f; color: #FFFFFF;" type="email" name="email" :value="old('email')" required autocomplete="username">
                            @if ($errors->has('email'))
                                <small class="text-danger">{{ $errors->first('email') }}</small>
                            @endif
                        </div>

                        <!-- Password -->
                        <div class="mb-4">
                            <label for="password" class="form-label" style="color: #bd0cc9;">Contraseña</label>
                            <input id="password" class="form-control" style="background-color: #2c052f; color: #FFFFFF;" type="password" name="password" required autocomplete="new-password">
                            @if ($errors->has('password'))
                                <small class="text-danger">{{ $errors->first('password') }}</small>
                            @endif
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label" style="color: #bd0cc9;">Confirmar Contraseña</label>
                            <input id="password_confirmation" class="form-control" style="background-color: #2c052f; color: #FFFFFF;" type="password" name="password_confirmation" required autocomplete="new-password">
                            @if ($errors->has('password_confirmation'))
                                <small class="text-danger">{{ $errors->first('password_confirmation') }}</small>
                            @endif
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-light px-5" style="background-color: #6d0774; color: #FFFFFF;">Registrarse</button>
                        </div>
                    </form>

                    <div class="mt-4 text-center">
                        <a href="{{ route('login') }}" class="text-sm" style="color: #bd0cc9;">¿Ya tienes una cuenta? Inicia sesión</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
