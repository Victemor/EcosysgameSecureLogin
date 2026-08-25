@extends('layouts.app')

@section('title', 'Crear cuenta | Ecosysgame')

@section('content')
<section class="auth-layout">
    <aside class="auth-intro" aria-label="Información de seguridad">
        <a href="{{ route('home') }}"><span class="brand-mark">EG</span></a>
        <p class="eyebrow">Ecosysgame</p>
        <h1>Únete a una aventura por la biodiversidad de Ubaté.</h1>
        <p>Crea tu perfil para acceder a la futura descarga. Tu contraseña se transforma en un hash seguro.</p>
        <ul class="security-points">
            <li>Mínimo 8 caracteres</li>
            <li>Mayúsculas, minúsculas y números</li>
            <li>Al menos un símbolo</li>
        </ul>
    </aside>

    <div class="auth-panel">
        <div class="auth-card">
            <div class="card-heading">
                <p class="eyebrow">Nuevo acceso</p>
                <h2>Crear cuenta</h2>
                <p>Completa tus datos para acceder al centro de descargas.</p>
            </div>

            @if ($errors->any())
                <div class="alert alert-error" role="alert">
                    <strong>Revisa la información ingresada.</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register.store') }}" class="auth-form">
                @csrf

                <div class="form-group">
                    <label for="name">Nombre completo</label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}"
                           autocomplete="name" maxlength="100" required autofocus>
                </div>

                <div class="form-group">
                    <label for="email">Correo electrónico</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}"
                           autocomplete="username" required>
                </div>

                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <div class="password-field">
                        <input id="password" name="password" type="password"
                               autocomplete="new-password" required>
                        <button class="password-toggle" type="button" data-password-toggle="password"
                                aria-label="Mostrar contraseña">Mostrar</button>
                    </div>
                    <small>Usa 8 o más caracteres, mayúscula, minúscula, número y símbolo.</small>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirmar contraseña</label>
                    <div class="password-field">
                        <input id="password_confirmation" name="password_confirmation" type="password"
                               autocomplete="new-password" required>
                        <button class="password-toggle" type="button" data-password-toggle="password_confirmation"
                                aria-label="Mostrar confirmación de contraseña">Mostrar</button>
                    </div>
                </div>

                <button class="button button-primary" type="submit">Registrar cuenta</button>
            </form>

            <p class="form-footer">¿Ya tienes una cuenta? <a href="{{ route('login') }}">Iniciar sesión</a><br><a class="back-home" href="{{ route('home') }}">Volver al proyecto</a></p>
        </div>
    </div>
</section>
@endsection
