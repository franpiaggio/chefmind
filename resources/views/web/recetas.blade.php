@extends('layouts.webLayout')
@section('title', 'Todas las recetas')
@section('content')
    <h1>Recetas</h1>
    @foreach($recipes as $recipe)
        <div>
            <h2>{{ $recipe->title }}</h2>
            <p>{{ $recipe->body }}</p>
            <a href="{{ url('/recetas', $recipe->id) }}">Ver receta</a>
        </div>
    @endforeach
@endsection 