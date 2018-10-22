@extends('layouts.webLayout')
@section('title', 'Todas las recetas')
@section('content')
    <h1>Crear una receta</h1>
    <form method="POST" action="/recetas">
        @csrf
        <label for="title">Nombre</label><br>
        <input type="text" name="title"><br>
        <label for="body">Descripción</label><br>
        <textarea name="body" cols="30" rows="10"></textarea><br>
        <input type="submit">
    </form>
    <!-- Errores del server -->
    <div>
        @if($errors->any())
            <pre> {{var_dump($errors)}} </pre>
        @endif
    </div>
@endsection 