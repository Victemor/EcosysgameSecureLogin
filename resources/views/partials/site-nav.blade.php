<nav class="site-nav" aria-label="Navegación principal">
    <a class="brand" href="{{ route('home') }}">
        <span class="brand-mark brand-mark-small">E</span>
        <span>Ecosysgame</span>
    </a>

    <div class="nav-links">
        <a href="{{ route('home') }}">Inicio</a>
        <a href="{{ route('species.index') }}">Bitácora</a>

        @auth
            <a href="{{ route('dashboard') }}">Descargar</a>
            @if (auth()->user()->is_admin)
                <a href="{{ route('admin.dashboard') }}">Administración</a>
            @endif
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="nav-button" type="submit">Salir</button>
            </form>
        @else
            <a href="{{ route('login') }}">Iniciar sesión</a>
            <a class="nav-cta" href="{{ route('register') }}">Crear cuenta</a>
        @endauth
    </div>
</nav>
