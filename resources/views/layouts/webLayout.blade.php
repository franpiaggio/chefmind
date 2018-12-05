<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}"> 
    <!-- Externos -->
    <link rel="stylesheet" href=" {{ asset('lib/bootstrap/css/bootstrap.min.css') }} ">
    <link rel="stylesheet" href="  {{ asset('lib/font-awesome/font-awesome.min.css') }} ">
    <link href="{{ asset('lib/select2/select2.min.css') }} " rel="stylesheet" />
    <link href="{{ asset('lib/quill/quill.snow.css') }} " rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('lib/font-awesome/font-awesome.min.css') }} ">    
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <!-- Estilos -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Scripts -->
    <script src="{{ asset('lib/jquery/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('lib/bootstrap/js/bootstrap.bundle.min.js') }} "></script>
    <script src="{{ asset('lib/select2/select2.min.js')}} "></script>
    <script src="{{ asset('lib/select2/es.js')}}"></script>
    <script src="{{ asset('lib/quill/quill.min.js')}}"></script>
    <title>@yield('title', 'Chefmind - Recetas online')</title>
</head>
<body>
    @include('layouts.navbar')
    @yield('content')
    @yield('footer')
</body>
</html>