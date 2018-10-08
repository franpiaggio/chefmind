@extends('layouts.webLayout')
@section('title', 'Todas las recetas')
@section('content')
    <h1>{{$recipe->title}}</h1>
    <p> {{ $recipe->body }} </p>
    
@endsection 