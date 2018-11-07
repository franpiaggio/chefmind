@extends('layouts.webLayout')
@section('title', 'Categorias')
@section('content')

<h1>Categoria: {{$category->name}}</h1><br>
@if($category->img)
    <img src="/uploads/categorias/{{$category->img}}" alt="{{$category->name}}" style="max-width: 300px"><br>
@endif

<h2>Recetas:</h2>
<div class="row">
        @foreach($recipes as $recipe)
            <div class="col-md-4 my-3">
                <div class="card" style="width: 18rem;">
                    @unless( !$recipe->featured_image )
                        <img class="card-img-top" src="/uploads/featured/{{$recipe->featured_image}}" alt="{{$recipe->title}}">
                    @endunless
                    <div class="card-body">
                        <h5 class="card-title">{{ $recipe->title }}</h5>
                        <p class="card-text">{{ $recipe->textpreview }}</p>
                        <a href="{{ url('/recetas', $recipe->id) }}" class="btn btn-primary">Ver receta</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection 