@extends('layouts.app')

@section('title', 'Demasiados intentos | SecureApp')

@section('content')
<section class="status-page">
    <div class="status-card">
        <span class="status-code">429</span>
        <p class="eyebrow">Acceso temporalmente limitado</p>
        <h1>Demasiados intentos de inicio de sesión</h1>
        <p>Espera un minuto antes de intentarlo nuevamente. Este control ayuda a proteger las cuentas contra ataques de fuerza bruta.</p>
        <a class="button button-primary" href="{{ route('login') }}">Volver al login</a>
    </div>
</section>
@endsection
