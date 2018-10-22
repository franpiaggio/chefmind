@extends('layouts.webLayout')
@section('title', 'Todas las recetas')
@section('content')
    <h1>{{$recipe->title}}</h1>
    <p> {{ $recipe->body }} </p>
    @unless ( $recipe->categories->isEmpty() )
        <p>Categorías</p>
        <ul>
            @foreach($recipe->categories as $category)
                <li>{{$category->name}}</li>
            @endforeach
        </ul>
    @endunless
    @if(Auth::check())
        @if(Auth::user()->id === $recipe->user_id)
            <a href="{{ url('recetas/'.$recipe->id.'/editar') }}">Editar</a>
        @endif
    @endif
@endsection 