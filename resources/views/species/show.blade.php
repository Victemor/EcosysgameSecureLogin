@extends('layouts.app')

@section('title', $species->common_name.' | Bitácora Ecosysgame')

@section('content')
<div class="site-page">
    @include('partials.site-nav')

    <article class="species-detail">
        <a class="back-link" href="{{ route('species.index') }}">← Volver a la bitácora</a>
        <div class="species-detail-header">
            <span class="detail-symbol">{{ mb_substr($species->common_name, 0, 1) }}</span>
            <div><span class="group-pill">{{ $species->group }}</span><h1>{{ $species->common_name }}</h1><p class="scientific-name">{{ $species->scientific_name }}</p></div>
        </div>

        <div class="detail-grid">
            <section class="detail-panel"><h2>Clasificación</h2><dl class="detail-list"><div><dt>Familia</dt><dd>{{ $species->family ?: 'En revisión' }}</dd></div><div><dt>Estado de conservación</dt><dd>{{ $species->conservation_status ?: 'En revisión' }}</dd></div>@if($species->corrected_scientific_name)<div><dt>Nombre en revisión</dt><dd><em>{{ $species->corrected_scientific_name }}</em></dd></div>@endif</dl></section>
            <section class="detail-panel"><h2>Hábitat registrado</h2><dl class="detail-list"><div><dt>Ecosistema</dt><dd>{{ $species->ecosystem ?: 'Información pendiente' }}</dd></div><div><dt>Rango altitudinal</dt><dd>{{ $species->altitudinal_range ?: 'Información pendiente' }}</dd></div></dl></section>
        </div>

        <section class="source-panel"><h2>Fuentes</h2><p>Ficha incorporada desde el levantamiento de información de fauna de Ecosysgame.</p>@if($species->source)<a href="{{ $species->source }}" target="_blank" rel="noopener noreferrer">Consultar fuente de información ↗</a>@endif @if($species->reference)<a href="{{ $species->reference }}" target="_blank" rel="noopener noreferrer">Consultar referencia de conservación ↗</a>@endif</section>
        <div class="review-note"><strong>Nota:</strong> la taxonomía, distribución y estado de conservación están sujetos a revisión con el equipo académico antes de su publicación definitiva.</div>
    </article>
</div>
@endsection
