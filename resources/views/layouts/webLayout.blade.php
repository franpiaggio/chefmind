<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Chefmind - Recetas online')</title>
</head>
<body>
    <ul>
        <li>
            <a href="/">Home</a>
        </li>
        <li>
            <a href="/recetas">Recetas</a>
        </li>
        <li>
            <a href="/contacto">Contacto</a>
        </li>
    </ul>
    @yield('content')
</body>
</html>