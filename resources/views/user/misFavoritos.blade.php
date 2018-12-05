@extends('layouts.webLayout')
@section('title', 'Todas las recetas')
@section('content')
<main class="main-container container-fluid">  
    <div class="row">
        <header class="col-md-12 profile-topbar top-banner">
            <div class="container">
                <img src="/uploads/perfiles/{{Auth::user()->image}}" class="img-responsive rounded-circle profile-topbar__image" alt="Foto de perfil de {{ Auth::user()->name }}">
                <div class="my-profile-cont d-flex align-items-center">
                    <h1 class="profile-topbar__title">
                        {{ Auth::user()->name }}
                    </h1>
                    <a href="/miperfil/editar" class="btn btn-green btn-sm ml-3">Editar perfil</a>
                </div>
                <div class="profile-topbar__social">
                    @if( Auth::user()->facebook )
                    <a href="{{Auth::user()->facebook}}"><i class="fab fa-facebook"></i></a>
                    @endif
                    @if( Auth::user()->instagram )
                    <a href="{{Auth::user()->instagram}}" class="ml-2"><i class="fab fa-instagram"></i></a>
                    @endif
                    @if( Auth::user()->twitter )
                    <a href="{{Auth::user()->twitter}}" class="ml-2"><i class="fab fa-twitter"></i></a>
                    @endif
                </div>
            </div>
        </header>
        <div class="col-md-12 mt-2">
            <div class="container profile-description">
                @if(Auth::user()->description)
                    <h2>Sobre mí</h2>
                    <p>{{ Auth::user()->description }}</p>
                @endif
                <ul class="nav nav-tabs mt-5">
                    <li class="nav-item">
                        <a class="nav-link" href="/miperfil"><i class="fas fa-book"></i> Recetas creadas </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/miperfil/mis-favoritos"><i class="far fa-star"></i> Favoritas </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="far fa-user"></i> Usuarios seguidos</a>
                    </li>
                </ul>
                <div class="row mt-3">
                    @foreach($recipes as $recipe)
                        <div class="col-md-12 col-6 mb-3 recipe-list">
                            <div class="card">
                                <div class="row ">
                                    <div class="col-md-4 img-cont">
                                        <img src="/uploads/featured/{{$recipe->featured_image}}" class="w-100">
                                    </div>
                                    <div class="col-md-8 px-3">
                                        <div class="card-block px-3 py-3">
                                            <h3 class="card-title">{{$recipe->title}}</h3>
                                            <p class="card-text">{{$recipe->textpreview}}</p>
                                            <p class="text-muted mt-3">
                                                Creada por <a href="#">{{$recipe->user->name}}</a>
                                            </p>
                                            <div class="d-flex">
                                                <div class="icons d-flex" id="recetaLike{{$recipe->id}}" >
                                                    <div data-id="{{ $recipe->id }}" class="like-receta d-flex {{auth()->user() ? 'js-like' : ''}}">
                                                        <div class="icon-count mr-1">
                                                            {{ $recipe->likers()->get()->count() }}	
                                                        </div>
                                                        <div class="like-icons">
                                                            @if( auth()->user() && auth()->user()->hasLiked($recipe)) 
                                                                <i class="fas fa-thumbs-up"></i>
                                                            @else
                                                                <i class="far fa-thumbs-up"></i>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <p class="js-fav ml-3" data-id="{{ $recipe->id }}">
                                                        @if(auth()->user())
                                                            @if(auth()->user()->hasFavorited($recipe))
                                                                <i class="fas fa-heart"></i>
                                                            @else
                                                                <i class="far fa-heart"></i>
                                                            @endif
                                                        @endif
                                                    </p>
                                                </div>
                                                <div class="ml-auto">
                                                    <a href="{{ url('/recetas', $recipe->id) }}" class="card-link"><i class="fas fa-plus"></i> <span class="sr-only">Ver Receta</span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{$recipes->links()}}
            </div>
        </div>   
    </div>
</main>
@include('layouts.footer')
@section('footer')
    <script src="{{ asset('js/recetas.js') }}"></script>
@endsection
<!------------------------------->
@endsection 