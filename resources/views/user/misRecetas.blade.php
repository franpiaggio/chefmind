@extends('layouts.webLayout')
@section('title', 'Todas las recetas')
@section('content')
    <h1>Mis Recetas</h1>
    <div class="row">
            @if($errors->any())
                <h4>{{$errors->first()}}</h4>
            @endif
            @foreach($recipes as $recipe)
                <div class="col-md-4 my-3">
                    <div class="card" style="width: 18rem;">
                        @unless( !$recipe->featured_image )
                            <img class="card-img-top" src="/uploads/featured/{{$recipe->featured_image}}" alt="{{$recipe->title}}">
                        @endunless
                        <div class="card-body">
                            <h5 class="card-title">{{ $recipe->title }}</h5>
                            <p class="card-text">{{ $recipe->body }}</p>
                            <a href="{{ url('/recetas', $recipe->id) }}" class="btn btn-primary d-inline">Ver receta</a>
                            {{ Form::open(['url' => 'recetas/'.$recipe->id, 'method' => 'delete', 'class' => 'd-inline']) }}
                                <input type="submit" class="btn btn-danger" value="borrar" />
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
@endsection 