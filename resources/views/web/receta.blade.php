@extends('layouts.webLayout')
@section('title', 'Todas las recetas')
@section('content')
<main class="main-container">
    <div class="receta container mt-5">
        <div class="row">
            <div class="data col-md-6">
                <div class="d-flex align-items-center">                 
                    <h1>{{$recipe->title}}</h1>
                    @if(Auth::check())
                        @if(Auth::user()->id === $recipe->user_id)
                            <a href="{{ url('recetas/'.$recipe->id.'/editar') }}" class="btn btn-outline-primary ml-auto">Editar</a>
                        @endif
                    @endif
                </div>
                @if(Auth::check())
                    <div class="recipe-rate stars logged ml-1 mt-2 rate-{{(int)$recipe->userSumRating}}" data-id="{{$recipe->id}}">
                        <span data-rate="1" class="js-rate fa fa-star"></span>
                        <span data-rate="2" class="js-rate fa fa-star"></span>
                        <span data-rate="3" class="js-rate fa fa-star"></span>
                        <span data-rate="4" class="js-rate fa fa-star"></span>
                        <span data-rate="5" class="js-rate fa fa-star"></span>
                    </div>
                    <small>Calificación promedio: <span class="average">{{number_format($recipe->averageRating, 2)}}</span></small>
                @else
                    <div class="recipe-rate stars ml-1 mt-2 rate-{{(int)$recipe->averageRating}}">
                        <span data-rate="1" class="js-rate fa fa-star"></span>
                        <span data-rate="2" class="js-rate fa fa-star"></span>
                        <span data-rate="3" class="js-rate fa fa-star"></span>
                        <span data-rate="4" class="js-rate fa fa-star"></span>
                        <span data-rate="5" class="js-rate fa fa-star"></span>
                    </div>
                @endif
                <div class="user-container d-flex mt-3">
                    <div class="icon-user-container mr-3">
                        <i class="far fa-user"></i>
                    </div>
                    Creada por <a href="/perfil/{{$recipe->user->id}}" class="ml-1">{{$recipe->user->name}}</a>
                </div>
                <div class="descripcion-corta-container mt-3">
                    <p class="descripcion-corta">
                        {{$recipe->textpreview}}
                    </p>
                </div>
                <div class="buttons d-flex">
                    @if(Auth::check())
                        <div class="badge badge-success js-fav p-2" data-id="{{$recipe->id}}">
                            @if( auth()->user() && auth()->user()->hasFavorited($recipe)) 
                                <i class="fas fa-heart"></i> En mis favoritos
                            @else
                                <i class="far fa-heart"></i> Agregar a favoritos
                            @endif 
                        </div>
                    @endif
                </div>
                @if(!$recipe->categories->isEmpty())
                    <div class="categorias d-flex flex-wrap my-3">
                        <h3 class="w-100 mb-3">Categorías</h3>
                        @foreach($recipe->categories as $category)
                            <a href="/categorias?categoria={{$category->name}}" class="btn btn-outline-primary mr-3">{{$category->name}}</a>
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="col-md-6">
                <img src="/uploads/featured/{{$recipe->featured_image}}" alt="{{$recipe->title}}" class="img-fluid rounded">
            </div>
        </div>
    </div>
    <div class="container-fluid caracteristicas">
        <div class="container py-3 mt-5">
            <div class="row align-items-center py-3">
                <div class="col-md-4 d-flex align-items-center justify-content-center">
                    @if($recipe->difficulty)
                        <div class="d-flex mr-3">
                            @if($recipe->difficulty == 'Fácil')
                                <i class="far fa-dot-circle"></i>
                                <i class="far fa-circle"></i>
                                <i class="far fa-circle"></i>
                            @elseif($recipe->difficulty == 'Media')
                                <i class="far fa-dot-circle"></i>
                                <i class="far fa-dot-circle"></i>
                                <i class="far fa-circle"></i>
                            @else
                                <i class="far fa-dot-circle"></i>
                                <i class="far fa-dot-circle"></i>
                                <i class="far fa-dot-circle"></i>
                            @endif
                        </div>
                        <p class="dificultad m-0">Dificultad {{$recipe->difficulty}}</p>
                    @else
                        <p class="dificultad m-0">Dificultad no determinada</p>
                    @endif
                </div>
                <div class="col-md-4 d-flex align-items-center justify-content-center">
                    <i class="far fa-clock mr-3"></i>
                    @if($recipe->time)
                        {{$recipe->time}}
                    @else
                        No determinado
                    @endif
                </div>
                <div class="col-md-4 d-flex align-items-center justify-content-center">
                    <i class="far fa-user mr-3"></i>
                    3 comensales
                </div>
            </div>
        </div>
    </div>
    <div class="container ingredientes-receta mt-5">
        <h2>Ingredientes</h2>
        <div class="ingredientes d-flex flex-wrap">
            @if(!$recipe->ingredients->isEmpty())
                @foreach($recipe->ingredients as $ingredient)
                    <span class="badge badge-secondary py-3 px-3 mr-3 my-3"><i class="fas fa-utensils mr-2"></i> {{$ingredient->name}}</span>
                @endforeach
            @endif
        </div>
    </div>
    <div class="container contenido-receta mt-5">
        <div class="row">
            <div class="@if( $recipe->images->isEmpty() ) col-md-12 @else col-md-6 @endif">
                <h3>Descripción</h3>
                <div id="body" class="mt-3">{{$recipe->body}}</div>
            </div>
            @if( !$recipe->images->isEmpty() )
                <div class="col-md-6">
                    <div id="album" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner receta-carrousel">
                            @foreach( $recipe->images()->get() as $image )
                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                    <img class="d-block w-100 img-fluid rounded" src="/uploads/imagenes/{{$image->name}}" alt="Imagen de la receta">
                                </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#album" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#album" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="container mt-5 mb-5">
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#comentarios" role="tab" aria-controls="comentarios" aria-selected="true">Comentarios</a>
            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#comentar" role="tab" aria-controls="comentar" aria-selected="false">Dejar tu comentario</a>
            </div>
            <div class="tabs tab-content">
                <div class="comentarios tab-pane fade show active" id="comentarios" role="tabpanel">
                    @if(!$recipe->comments->isEmpty())
                        @foreach( $recipe->comments()->get() as $k => $comment )
                            <div class="row mt-3">
                                @if($k%2==0)
                                    <div class="profile-comment col-md-2 mb-3">
                                        <img src="/uploads/perfiles/{{$comment->user->image}}" alt="" class="img-fluid rounded img-thumbnail">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="card">
                                            <div class="card-header">
                                            <a href="/perfil/{{$comment->user->id}}">{{$comment->user->name}}</a>
                                            </div>
                                            <div class="card-body">
                                                <div class="d-flex flex-wrap">
                                                    <p class="card-text">{{$comment->body}}</p>
                                                    @if(Auth::check())
                                                        @if(Auth::user()->id === $recipe->user_id)
                                                            <a href="{{ url('comment/'.$comment->id.'/delete') }}" class="btn btn-outline-warning ml-auto">Borrar comentario</a>
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-md-6 offset-md-3 mb-3">
                                        <div class="card">
                                            <div class="card-header">
                                            <a href="/perfil/{{$comment->user->id}}">{{$comment->user->name}}</a>
                                            </div>
                                            <div class="card-body">
                                                <div class="d-flex flex-wrap">
                                                    <p class="card-text">{{$comment->body}}</p>
                                                    @if(Auth::check())
                                                        @if(Auth::user()->id == $recipe->user_id || Auth::user()->id == $comment->user->id)
                                                            <a href="{{ url('comment/'.$comment->id.'/delete') }}" class="btn btn-outline-warning ml-auto"><i class="far fa-trash-alt mr-1"></i> Borrar</a>
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="profile-comment col-md-2 mb-3">
                                        <img src="/uploads/perfiles/{{$comment->user->image}}" alt="" class="img-fluid rounded img-thumbnail">
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    @else
                        <h4 class="my-5">No hay comentarios registrados</h4>
                    @endif
                </div>
                <div class="comentar tab-pane fade show mt-3" id="comentar" role="tabpanel">
                    @if(Auth::check())
                        <form method="POST" action="/recetas/{{$recipe->id}}/comment">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h4>Deja tu comentario</h4>
                                        <textarea name="body" cols="5" rows="10" class="form-control" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary" value="Comentar">
                                    </div>
                                </div>
                            </div>
                        </form>
                    @else
                        <h4 class="my-3">¡<a href="/register">Registrate</a> para comentar!</h4>
                    @endif
                </div>
            </div>
        </div>
</main>
@include('layouts.footer')
@section('footer')
    <script src="{{ asset('js/receta.js') }}">
    </script>
@endsection
@endsection 