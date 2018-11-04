@extends('layouts.webLayout')
@section('title', 'Todas las recetas')
@section('content')
    <h1>{{$recipe->title}}</h1>
    @unless( !$recipe->featured_image )
        <img style="max-height: 200px;" src="/uploads/featured/{{$recipe->featured_image}}" alt="{{$recipe->title}}">
    @endunless
    <p> {{ $recipe->body }} </p>
    {{-- Categorias (si es que tiene) --}}
    @unless ( $recipe->categories->isEmpty() )
        <p>Categorías</p>
        <ul>
            @foreach($recipe->categories as $category)
                <li>{{$category->name}}</li>
            @endforeach
        </ul>
    @endunless
    {{-- Ingredientes --}}
    @unless ( $recipe->ingredients->isEmpty() )
        <p>Ingredientes</p>
        <ul>
            @foreach($recipe->ingredients as $ingredient)
                <li>{{$ingredient->name}}</li>
            @endforeach
        </ul>
    @endunless
    @if(Auth::check())
        @if(Auth::user()->id === $recipe->user_id)
            <a href="{{ url('recetas/'.$recipe->id.'/editar') }}">Editar</a>
        @endif
    @endif
@endsection 