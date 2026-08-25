@extends('layouts.app')

@section('title', 'Iniciar sesión | Ecosysgame')

@section('content')
<section class="auth-layout">
    <aside class="auth-intro" aria-label="Información de seguridad">
        <a href="{{ route('home') }}"><span class="brand-mark">EG</span></a>
        <p class="eyebrow">Ecosysgame</p>
        <h1>Continúa tu exploración del territorio.</h1>
        <p>Ingresa al centro de descargas y sigue el desarrollo de River Explorer.</p>
        <ul class="security-points">
            <li>Credenciales protegidas</li>
            <li>Sesión regenerada</li>
            <li>Centro de descargas privado</li>
        </ul>
    </aside>

    <div class="auth-panel">
        <div class="auth-card">
            <div class="card-heading">
                <p class="eyebrow">Bienvenido de nuevo</p>
                <h2>Iniciar sesión</h2>
                <p>Ingresa con las credenciales de tu cuenta.</p>
            </div>

            @if (session('status'))
                <div class="alert alert-success" role="status">{{ session('status') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-error" role="alert">
                    <strong>No fue posible iniciar sesión.</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login.store') }}" class="auth-form">
                @csrf

                <div class="form-group">
                    <label for="email">Correo electrónico</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}"
                           autocomplete="username" required autofocus>
                </div>

                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <div class="password-field">
                        <input id="password" name="password" type="password"
                               autocomplete="current-password" required>
                        <button class="password-toggle" type="button" data-password-toggle="password"
                                aria-label="Mostrar contraseña">Mostrar</button>
                    </div>
                </div>

                <label class="check-row">
                    <input type="checkbox" name="remember" value="1">
                    <span>Recordarme</span>
                </label>

                <button class="button button-primary" type="submit">Ingresar de forma segura</button>
            </form>

            <p class="form-footer">¿Aún no tienes cuenta? <a href="{{ route('register') }}">Crear cuenta</a><br><a class="back-home" href="{{ route('home') }}">Volver al proyecto</a></p>
        </div>
    </div>
</section>
@endsection
