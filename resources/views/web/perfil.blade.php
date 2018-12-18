@extends('layouts.webLayout')
@section('title', 'Todas las recetas')
@section('content')
<main class="main-container container-fluid">  
    <div class="row">
        <header class="col-md-12 profile-topbar">
            <div class="container">
                @if( $user->image == 'profile.png')
                {{-- TODO: Super hardcodeado esto, cambiarlo --}}
                <img src="/uploads/default/{{$user->image}}" class="img-responsive rounded-circle profile-topbar__image" alt="Foto de perfil de {{ $user->name }}">
                @else
                <img src="/uploads/perfiles/{{$user->image}}" class="img-responsive rounded-circle profile-topbar__image" alt="Foto de perfil de {{ $user->name }}">
                @endif
                <div class="d-flex align-items-center">
                    <h1 class="profile-topbar__title">
                        {{ $user->name }}
                    </h1>
                    @if($user->isFollowedBy(Auth::user()))
                        <button data-id={{$user->id}} class="btn btn-green btn-sm ml-auto js-follow"><i class="fas fa-user-minus"></i> Dejar de seguir</button>
                    @else
                        <button data-id={{$user->id}} class="btn btn-green btn-sm ml-auto js-follow"><i class="fas fa-user-plus"></i> Seguir</button>
                    @endif
                </div>
                <div class="profile-topbar__social">
                    @if( $user->facebook )
                        <a href="{{$user->facebook}}"><i class="fab fa-facebook"></i></a>
                    @endif
                    @if( $user->instagram )
                        <a href="{{$user->instagram}}" class="ml-2"><i class="fab fa-instagram"></i></a>
                    @endif
                    @if( $user->twitter )
                        <a href="{{$user->twitter}}" class="ml-2"><i class="fab fa-twitter"></i></a>
                    @endif
                </div>
            </div>
        </header>
        <div class="col-md-12 mt-2">
            <div class="container profile-description">
                @if($user->description)
                    <h2>Sobre mí</h2>
                    <p>{{ $user->description }}</p>
                @endif
                <ul class="nav nav-tabs mt-5">
                    <li class="nav-item">
                        <a class="nav-link active" href="/miperfil"><i class="fas fa-book"></i> Recetas creadas </a>
                    </li>
                </ul>
                <div class="row mt-3">
                    <div class="col-md-12 mb-3">
                        <form action="/perfil/{{$user->id}}" method="GET">
                            <div class="input-group">
                                @if(Request::query('categoria'))
                                    <input type="hidden" name="categoria" value="{{Request::query('categoria')}}">
                                @endif
                                <input type="text" class="form-control" placeholder="Buscá tu receta" name="buscar">
                                <div class="input-group-append">
                                    <input type="submit" class="btn btn-outline-secondary" value="Buscar"/>
                                </div>
                            </div>
                        </form>
                    </div>
                    @foreach($recipes as $recipe)
                        <div class="col-md-12 mb-3 recipe-list">
                            <div class="card">
                                <div class="row ">
                                    <div class="col-md-4">
                                        <img src="/uploads/featured/{{$recipe->featured_image}}" class="w-100">
                                    </div>
                                    <div class="col-md-8 px-3">
                                        <div class="card-block px-3 py-3">
                                            <h3 class="card-title">{{$recipe->title}}</h3>
                                            <p class="card-text">{{$recipe->textpreview}}</p>
                                            <p class="text-muted mt-3">
                                                Creada por <a href="/perfil/{{$recipe->user->id}}">{{$recipe->user->name}}</a>
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
                                                    <a href="{{ url('/recetas', $recipe->id) }}" class="btn btn-primary">Ver más</a>
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
    <script src="{{ asset('js/follow.js') }}"></script>
@endsection
@endsection 