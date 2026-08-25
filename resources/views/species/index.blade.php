@extends('layouts.app')

@section('title', 'Bitácora de especies | Ecosysgame')

@section('content')
<div class="site-page">
    @include('partials.site-nav')

    <header class="inner-hero">
        <p class="eyebrow">Fauna de la cuenca alta del río Ubaté</p>
        <h1>Bitácora de especies</h1>
        <p>Consulta el inventario inicial del proyecto. La información se encuentra en proceso de validación científica y ampliación.</p>
    </header>

    <section class="catalog-section">
        <form class="catalog-filters" method="GET" action="{{ route('species.index') }}">
            <label><span>Buscar</span><input type="search" name="search" value="{{ request('search') }}" placeholder="Nombre, especie o familia"></label>
            <label><span>Grupo</span><select name="group"><option value="">Todos</option>@foreach($groups as $group)<option value="{{ $group }}" @selected(request('group') === $group)>{{ $group }}</option>@endforeach</select></label>
            <label><span>Conservación</span><select name="status"><option value="">Todos</option>@foreach($statuses as $status)<option value="{{ $status }}" @selected(request('status') === $status)>{{ $status }}</option>@endforeach</select></label>
            <button class="button button-primary" type="submit">Filtrar</button>
            @if(request()->hasAny(['search', 'group', 'status']))<a class="clear-filter" href="{{ route('species.index') }}">Limpiar</a>@endif
        </form>

        <div class="catalog-meta"><strong>{{ $species->total() }}</strong> resultados</div>

        <div class="species-grid">
            @forelse ($species as $item)
                <article class="species-card">
                    <div class="species-card-top">
                        <span class="species-symbol">{{ mb_substr($item->common_name, 0, 1) }}</span>
                        <span class="group-pill">{{ $item->group }}</span>
                    </div>
                    <h2>{{ $item->common_name }}</h2>
                    <p class="scientific-name">{{ $item->scientific_name }}</p>
                    <dl>
                        <div><dt>Familia</dt><dd>{{ $item->family ?: 'En revisión' }}</dd></div>
                        <div><dt>Estado</dt><dd>{{ $item->conservation_status ?: 'En revisión' }}</dd></div>
                    </dl>
                    <a href="{{ route('species.show', $item) }}">Consultar ficha →</a>
                </article>
            @empty
                <div class="empty-state"><h2>No encontramos especies</h2><p>Prueba con otros términos o elimina los filtros.</p></div>
            @endforelse
        </div>

        <div class="pagination-wrap">{{ $species->links() }}</div>
    </section>
</div>
@endsection
