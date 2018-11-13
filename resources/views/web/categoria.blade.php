@extends('layouts.webLayout')
@section('title', 'Categorias')
@section('content')
<div class="container">
    <h1>Categoria: {{$category->name}}</h1><br>
    @if($category->img)
        <img src="/uploads/categorias/{{$category->img}}" alt="{{$category->name}}" style="max-width: 300px"><br>
    @endif
    <h2>Recetas:</h2>
    <div class="row">
        @include('web.listadoRecetas', ['recipes' => $recipes])    
    </div>
</div>
@endsection 