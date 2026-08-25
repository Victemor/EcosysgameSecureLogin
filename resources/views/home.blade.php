@extends('layouts.app')

@section('title', 'Ecosysgame | Explora, aprende y protege')

@section('content')
<div class="site-page">
    @include('partials.site-nav')

    <header class="hero-section">
        <div class="hero-copy">
            <p class="eyebrow">Videojuego educativo · Provincia de Ubaté</p>
            <h1>Explora la biodiversidad que habita nuestro territorio.</h1>
            <p>Ecosysgame es una experiencia 2D de educación ambiental sobre la fauna y flora de la cuenca alta del río Ubaté.</p>
            <div class="hero-actions">
                <a class="button button-primary" href="{{ route('species.index') }}">Explorar la bitácora</a>
                <a class="button button-secondary" href="{{ auth()->check() ? route('dashboard') : route('register') }}">
                    {{ auth()->check() ? 'Centro de descarga' : 'Crear perfil' }}
                </a>
            </div>
        </div>
        <div class="pixel-landscape" aria-label="Representación del ecosistema altoandino">
            <div class="pixel-sun"></div>
            <div class="pixel-mountain mountain-back"></div>
            <div class="pixel-mountain mountain-front"></div>
            <div class="pixel-river"></div>
            <div class="pixel-tree tree-one"></div>
            <div class="pixel-tree tree-two"></div>
        </div>
    </header>

    <section class="project-stats" aria-label="Datos del proyecto">
        <article><strong>{{ $speciesCount }}</strong><span>especies en la bitácora inicial</span></article>
        <article><strong>2D</strong><span>experiencia educativa en pixel art</span></article>
        <article><strong>ICAM</strong><span>institución educativa vinculada</span></article>
        <article><strong>Offline</strong><span>propuesta para equipos de bajos recursos</span></article>
    </section>

    <section class="content-section split-section" id="proyecto">
        <div>
            <p class="eyebrow">El proyecto</p>
            <h2>Conocimiento ambiental convertido en exploración.</h2>
        </div>
        <div class="prose">
            <p>La provincia de Ubaté alberga ecosistemas de páramo y bosque altoandino que sirven como refugio para numerosas especies. Ecosysgame busca acercar este patrimonio biológico a estudiantes de primaria mediante una experiencia lúdica y contextualizada.</p>
            <p>El videojuego se encuentra en desarrollo. Este portal reúne información pública del proyecto, una bitácora de fauna y un acceso seguro al futuro centro de descargas.</p>
        </div>
    </section>

    <section class="content-section">
        <div class="section-heading">
            <div><p class="eyebrow">Especies destacadas</p><h2>Habitantes del territorio</h2></div>
            <a href="{{ route('species.index') }}">Ver las {{ $speciesCount }} especies →</a>
        </div>
        <div class="featured-grid">
            @forelse ($featuredSpecies as $item)
                <a class="featured-species" href="{{ route('species.show', $item) }}">
                    <span class="species-symbol">{{ mb_substr($item->common_name, 0, 1) }}</span>
                    <div><strong>{{ $item->common_name }}</strong><em>{{ $item->scientific_name }}</em></div>
                    <span class="status-pill">{{ $item->conservation_status }}</span>
                </a>
            @empty
                <p>La bitácora está lista para cargar su inventario inicial.</p>
            @endforelse
        </div>
    </section>

    <section class="download-callout">
        <div><p class="eyebrow">Próximamente</p><h2>Una aventura que también podrá acompañarte sin Internet.</h2></div>
        <a class="button button-light" href="{{ auth()->check() ? route('dashboard') : route('login') }}">Consultar disponibilidad</a>
    </section>

    <footer class="site-footer">Ecosysgame · Universidad de Cundinamarca · Proyecto educativo en desarrollo</footer>
</div>
@endsection
