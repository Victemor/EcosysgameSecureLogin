@extends('layouts.app')

@section('title', 'Centro de descarga | Ecosysgame')

@section('content')
<div class="site-page">
    @include('partials.site-nav')
    <div class="dashboard-content">
        @if (session('status'))
            <div class="alert alert-success" role="status">{{ session('status') }}</div>
        @endif

        <div class="welcome-card download-hero">
            <div>
                <p class="eyebrow">Área privada · Sesión verificada</p>
                <h1>Hola, {{ auth()->user()->name }}</h1>
                <p>Este será tu punto de acceso a Ecosysgame y a las novedades de cada versión.</p>
            </div>
            <div class="verified-badge" aria-label="Sesión verificada">
                <span>✓</span>
                Acceso seguro
            </div>
        </div>

        <section class="download-layout">
            <article class="release-card">
                <div class="release-cover"><span>EG</span><strong>River Explorer</strong><small>Edición educativa</small></div>
                <div class="release-info">
                    <div class="release-heading"><div><p class="eyebrow">Próxima versión</p><h2>Ecosysgame: River Explorer</h2></div><span class="development-pill">En desarrollo</span></div>
                    <p>Recorre ecosistemas de la provincia de Ubaté, aprende sobre sus especies y completa una bitácora ambiental mientras juegas.</p>
                    <button class="button button-disabled" type="button" disabled>Descarga disponible próximamente</button>
                    <small>El formato final (web o ejecutable para Windows) será definido con el tutor del proyecto.</small>
                </div>
            </article>
            <aside class="account-card"><p class="eyebrow">Tu cuenta</p><h2>{{ auth()->user()->name }}</h2><p>{{ auth()->user()->email }}</p><dl><div><dt>Acceso</dt><dd>{{ auth()->user()->is_admin ? 'Administrador' : 'Jugador' }}</dd></div><div><dt>Miembro desde</dt><dd>{{ auth()->user()->created_at->format('d/m/Y') }}</dd></div></dl>@if(auth()->user()->is_admin)<a class="button button-secondary" href="{{ route('admin.dashboard') }}">Abrir administración</a>@endif</aside>
        </section>

        <div class="security-grid download-benefits">
            <article class="security-card">
                <span class="card-icon">#</span>
                <h2>Preparado para funcionar offline</h2>
                <p>La propuesta contempla una versión que pueda utilizarse sin conexión permanente a Internet.</p>
            </article>
            <article class="security-card">
                <span class="card-icon">↻</span>
                <h2>Bitácora ambiental</h2>
                <p>Mientras llega la descarga, puedes consultar libremente el inventario inicial de especies.</p><a href="{{ route('species.index') }}">Explorar bitácora →</a>
            </article>
            <article class="security-card">
                <span class="card-icon">5</span>
                <h2>Acceso protegido</h2>
                <p>Tu sesión se regenera al ingresar y el formulario está protegido contra solicitudes no autorizadas.</p>
            </article>
        </div>
    </div>
</div>
@endsection
