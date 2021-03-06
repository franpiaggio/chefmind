@extends('layouts.webLayout')
@section('title', 'Chefmind - Buscá tu receta')
@section('content')
<main class="main-container">
    <div class="container-fluid errors d-flex">
        <div class="container d-flex flex-column align-items-center justify-content-center">
            <i class="fas fa-exclamation-circle mb-3"></i>
            <h1 class="error-number">401</h1>
            <p class="">No tienes permisos para acceder a esta ruta.</p>
            <a href="/" class="btn btn-outline-danger">Volver al home</a>
        </div>
    </div>
@include('layouts.footer')
</main>
@endsection 