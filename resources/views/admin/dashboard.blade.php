@extends('layouts.app')
@section('title', 'Administración | Ecosysgame')
@section('content')
<div class="site-page admin-page">
@include('partials.site-nav')
<header class="inner-hero admin-hero"><p class="eyebrow">Área restringida</p><h1>Panel de administración</h1><p>Resumen operativo de cuentas, sesiones y contenido de Ecosysgame.</p></header>
<section class="admin-content">
<div class="admin-stats"><article><span>Cuentas</span><strong>{{ $userCount }}</strong><small>usuarios registrados</small></article><article><span>Administradores</span><strong>{{ $adminCount }}</strong><small>con acceso elevado</small></article><article><span>Sesiones</span><strong>{{ $sessionCount }}</strong><small>registros de sesión</small></article><article><span>Bitácora</span><strong>{{ $speciesCount }}</strong><small>especies publicadas</small></article></div>
<div class="admin-grid"><article class="admin-panel users-panel"><div class="panel-heading"><div><p class="eyebrow">Usuarios</p><h2>Cuentas registradas</h2></div><span class="privacy-note">Las contraseñas nunca se muestran</span></div><div class="table-wrap"><table><thead><tr><th>Nombre</th><th>Correo</th><th>Rol</th><th>Registro</th></tr></thead><tbody>
@forelse($users as $user)<tr><td><strong>{{ $user->name }}</strong></td><td>{{ $user->email }}</td><td><span class="role-pill {{ $user->is_admin ? 'role-admin' : '' }}">{{ $user->is_admin ? 'Administrador' : 'Jugador' }}</span></td><td>{{ $user->created_at->format('d/m/Y H:i') }}</td></tr>@empty<tr><td colspan="4">Aún no hay cuentas registradas.</td></tr>@endforelse
</tbody></table></div><div class="pagination-wrap">{{ $users->links() }}</div></article>
<aside class="admin-side"><article class="admin-panel"><p class="eyebrow">Contenido</p><h2>Especies por grupo</h2><ul class="group-counts">@foreach($speciesByGroup as $item)<li><span>{{ $item->group }}</span><strong>{{ $item->total }}</strong></li>@endforeach</ul><a href="{{ route('species.index') }}">Revisar bitácora pública →</a></article><article class="admin-panel"><p class="eyebrow">Seguridad</p><h2>Controles activos</h2><ul class="check-list"><li>Contraseñas hasheadas</li><li>Sesiones regeneradas</li><li>Protección CSRF</li><li>Límite de 5 intentos</li><li>Middleware de administrador</li></ul></article></aside></div>
</section></div>
@endsection
