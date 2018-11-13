@extends('layouts.webLayout')
@section('title', 'Todas las recetas')
@section('content')
    <div class="container">
    <h1>Recetas</h1>
    <div class="row">
        @include('web.listadoRecetas', ['recipes' => $recipes])
    </div>
    {{$recipes->links()}}
    </div>
@endsection 