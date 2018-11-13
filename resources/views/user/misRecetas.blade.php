@extends('layouts.webLayout')
@section('title', 'Todas las recetas')
@section('content')
<div class="container">
    <h1>Mis Recetas</h1>
    <div class="row">
        @if($errors->any())
            <h4>{{$errors->first()}}</h4>
        @endif
        @include('web.listadoRecetas', ['recipes' => $recipes])
    </div>
    {{$recipes->links()}}
</div>
@endsection 