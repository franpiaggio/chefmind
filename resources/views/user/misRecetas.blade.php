@extends('layouts.webLayout')
@section('title', 'Todas las recetas')
@section('content')
    <h1>Mis Recetas</h1>
    <div class="row">
            @foreach($recipes as $recipe)
                <div class="col-md-4 my-3">
                    <div class="card" style="width: 18rem;">
                        <!-- <img class="card-img-top" src="..." alt="Card image cap"> -->
                        <div class="card-body">
                        <h5 class="card-title">{{ $recipe->title }}</h5>
                        <p class="card-text">{{ $recipe->body }}</p>
                        <a href="{{ url('/recetas', $recipe->id) }}" class="btn btn-primary">Ver receta</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
@endsection 