@extends('layouts.webLayout')
@section('title', 'Todas las recetas')
@section('content')
    <div class="container">
    <h1>Recetas</h1>
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
    {{$recipes->links()}}
    </div>
@endsection 