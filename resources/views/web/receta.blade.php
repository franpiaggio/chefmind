@extends('layouts.webLayout')
@section('title', 'Todas las recetas')
@section('content')
    <h1>{{$recipe->title}}</h1>
    <p> {{ $recipe->body }} </p>
    @if(Auth::check())
        @if(Auth::user()->id === $recipe->user_id)
            <a href="{{ url('recetas/'.$recipe->id.'/editar') }}">Editar</a>
        @endif
    @endif
@endsection 