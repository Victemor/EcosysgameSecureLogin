<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Ecosysgame: videojuego educativo sobre la biodiversidad de la provincia de Ubaté">
    <title>@yield('title', 'Ecosysgame')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <main class="page-shell">
        @yield('content')
    </main>
</body>
</html>
