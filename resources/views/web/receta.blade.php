@extends('layouts.webLayout')
@section('title', 'Todas las recetas')
@section('content')
<main class="main-container">
    <div class="receta container mt-5">
        <div class="row">
            <div class="data col-md-6 pl-3">
                <div class="recipe-cat-cont d-flex flex-row flex-wrap">
                    @if(!$recipe->categories->isEmpty())
                            @foreach($recipe->categories as $category)
                                <a href="/categorias?categoria={{$category->name}}" class="btn mb-3 mr-2 badge badge-outline-orange">{{$category->name}}</a>
                            @endforeach
                    @endif
                </div>
                <div class="d-flex align-items-center">                 
                    <h1 class="mt-0">{{$recipe->title}}</h1>
                </div>
                <div class="user-container d-flex mt-2 mb-4 align-items-center">
                    Por <a href="/perfil/{{$recipe->user->id}}" class="ml-1">{{$recipe->user->name}}</a>                  
                    @if(Auth::check())
                        @if(Auth::user()->id == intval($recipe->user_id))
                            <a href="{{ url('recetas/'.$recipe->id.'/editar') }}" class="btn mr-auto edit-recipe"><i class="fas fa-edit mr-2"></i>Editar</a>
                        @endif
                    @endif
                </div>
                @if(Auth::check())
                    <div class="stars logged ml-1 mt-2 rate-{{(int)$recipe->userSumRating}}" data-id="{{$recipe->id}}">
                        <span data-rate="1" class="js-rate fa fa-star"></span>
                        <span data-rate="2" class="js-rate fa fa-star"></span>
                        <span data-rate="3" class="js-rate fa fa-star"></span>
                        <span data-rate="4" class="js-rate fa fa-star"></span>
                        <span data-rate="5" class="js-rate fa fa-star"></span>
                    </div>
                    <small class="rate-av">Calificación promedio: <span class="average">{{number_format($recipe->averageRating, 2)}}</span><span> con {{count($recipe->ratings)}}  {{count($recipe->ratings) == 1 ? 'valoración' : 'valoraciones'}}</span></small>
                @else
                    <div class="stars ml-1 mt-2 rate-{{(int)$recipe->averageRating}}">
                        <span data-rate="1" class="js-rate fa fa-star"></span>
                        <span data-rate="2" class="js-rate fa fa-star"></span>
                        <span data-rate="3" class="js-rate fa fa-star"></span>
                        <span data-rate="4" class="js-rate fa fa-star"></span>
                        <span data-rate="5" class="js-rate fa fa-star"></span>
                    </div>
                @endif
               <div class="row align-items-center justify-content-start py-3 ml-1 caracteristicas">
                <div class="d-flex align-items-center justify-content-start difficulty mr-2">
                    @if($recipe->difficulty)
                        <div class="d-flex mr-2">
                            @if($recipe->difficulty == 'Fácil')
                                <i class="far fa-dot-circle mr-1"></i>
                                <i class="far fa-circle mr-1"></i>
                                <i class="far fa-circle mr-1"></i>
                            @elseif($recipe->difficulty == 'Media')
                                <i class="far fa-dot-circle mr-1"></i>
                                <i class="far fa-dot-circle mr-1"></i>
                                <i class="far fa-circle mr-1"></i>
                            @else
                                <i class="far fa-dot-circle mr-1"></i>
                                <i class="far fa-dot-circle mr-1"></i>
                                <i class="far fa-dot-circle mr-1"></i>
                            @endif
                        </div>
                        <p class="dificultad m-0">Dificultad {{$recipe->difficulty}}</p>
                    @else
                        <p class="dificultad m-0">Dificultad no determinada</p>
                    @endif
                </div>
                <span class="separator-pipe">|</span>
                <div class="d-flex align-items-center justify-content-start ml-2 mr-2">
                    <i class="far fa-clock mr-2"></i>
                    <span class="time-quant">
                    @if($recipe->time)
                        {{$recipe->time}}
                    @else
                        No determinado
                    @endif
                    </span>
                </div>
                   <span class="separator-pipe">|</span>
                <div class="d-flex align-items-center justify-content-start ml-2">
                    <i class="far fa-user mr-2"></i>
                    <span class="diners-quant">{{$recipe->quantity}} comensales</span>
                </div>
            </div>
                <div class="descripcion-corta-container mt-3">
                    <p class="descripcion-corta">
                        {{$recipe->textpreview}}
                    </p>
                </div>                
            </div>    
                
            <div class="col-md-6 recipe-img d-flex flex-column align-items-start">
                <img src="/uploads/featured/{{$recipe->featured_image}}" alt="{{$recipe->title}}" class="img-fluid rounded img-receta">
                <div class="buttons d-flex fav-cont">
                    @if(Auth::check())
                        <div class="js-fav p-2 favoritos" data-id="{{$recipe->id}}">
                            @if( auth()->user() && auth()->user()->hasFavorited($recipe)) 
                                <i class="fas fa-heart"></i> En mis favoritos
                            @else
                                <i class="far fa-heart mr-1"></i> Agregar a favoritos
                            @endif 
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-md-12 ingredientes-receta my-5">
                <h2 class="h3 mb-4">Ingredientes</h2>
                <div class="ingredientes d-flex flex-wrap">
                    @if(!$recipe->ingredients->isEmpty())
                        @foreach($recipe->ingredients as $ingredient)
                        <span class="badge bg-green color-white py-3 px-3 mr-2 my-1 "><i class="fas fa-utensils mr-2"></i> {{$ingredient->name}} <span>{{$ingredient->pivot->quantity}}</span> </span>
                        @endforeach 
                    @endif
                </div>
            </div>    
            </div>
            </div>
                <div class="container contenido-receta mt-5">
                    <div class="row">
                        <div class="@if( $recipe->images->isEmpty() ) col-md-12 @else col-md-6 @endif">
                            <h3 class="mb-4">Descripción</h3>
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
                            @if($comment->user)
                            <div class="row mt-3">
                                @if($k%2==0)
                                    <div class="profile-comment col-md-2 mb-3">
                                        <img src="/uploads/perfiles/{{$comment->user->image}}" alt="" class="img-fluid rounded img-thumbnail">
                                    </div>
                                    <div class="col-md-7 mb-3">
                                        <div class="card">
                                            <div class="card-header">
                                            <a href="/perfil/{{$comment->user->id}}">{{$comment->user->name}}</a>
                                            </div>
                                            <div class="card-body">
                                                <div class="d-flex flex-wrap">
                                                    <p class="card-text">{{$comment->body}}</p>
                                                    @if(Auth::check())
                                                        @if(Auth::user()->id === $recipe->user_id || Auth::user()->id == $comment->user->id)
                                                        <a href="{{ url('comment/'.$comment->id.'/delete') }}" class="btn btn-outline-warning ml-auto"><i class="far fa-trash-alt mr-1"></i> Borrar</a>
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-md-7 offset-md-2 mb-3">
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
                            @endif
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