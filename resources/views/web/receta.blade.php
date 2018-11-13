@extends('layouts.webLayout')
@section('title', 'Todas las recetas')
@section('content')
    <div class="container">
    <h1>{{$recipe->title}}</h1>
    @unless( !$recipe->featured_image )
        <img style="max-height: 200px;" src="/uploads/featured/{{$recipe->featured_image}}" alt="{{$recipe->title}}">
    @endunless
    <p id="body"> {{ $recipe->body }} </p>
    <p>Tiempo estimado:  {{ $recipe->time ? $recipe->time : 'No especificado' }} </p>
    <p>Dificultad:  {{ $recipe->difficulty ? $recipe->difficulty : 'No especificado' }} </p>
    <p>Cantidad:  {{ $recipe->quantity ? $recipe->quantity : 'No especificado' }}  {{$recipe->quantity && $recipe->quantity == 1 ? 'persona' : 'personas'}} </p>
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
    <hr>
    <div class="card">
        <div class="card-block py-3 px-3">
            <form method="POST" action="/recetas/{{$recipe->id}}/comment">
                @csrf
                <div class="form-group">
                    <label for="body">Comentario</label>
                    <textarea name="body" cols="5" rows="10" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
    <hr>
    @if($recipe->comments())
        @foreach( $recipe->comments()->get() as $comment )
            <p> Comentario de <a href="#">{{$comment->user->name}}</a>
            <p> {{$comment->body}} </p>
            @if(Auth::check())
                @if(Auth::user()->id === $recipe->user_id)
                    <a href="{{ url('comment/'.$comment->id.'/delete') }}">Borrar comentario</a>
                @endif
            @endif
            <hr>
        @endforeach
    @endif
    @section('footer')
        <script>
            // Lo que viene escapado lo inserto como html
            $("#body").html( $("#body").text() );
        </script>
    @endsection
    </div>
@endsection 