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
                        <a class="nav-link" href="/miperfil/mis-favoritos"><i class="far fa-star"></i> Favoritas </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link active" href="/miperfil/seguidos"><i class="fas fa-user"></i> Usuarios seguidos</a>
                    </li>
                </ul>
                <div class="row my-5">
                    @if(!count($followings))
                        <div class="col-md-12">
                            <div class="alert alert-warning mt-3 mb-5" role="alert">
                                No sigues a ningún usuario.
                            </div> <!-- Todo: Cambiar esto --> <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                        </div>
                    @else
                        @foreach($followings as $followed)
                            <div class="col-md-6 followed">
                                <div class="card mb-5">
                                    <div class="my-3 profile-container">
                                        <img class="card-img-top profile-follow" src="/uploads/default/profile.png" alt="Profile">
                                    </div>
                                    <div class="card-body text-center">
                                        <h5 class="card-title">{{$followed->name}}</h5>
                                        @if($followed->description)
                                            <p class="card-text">{{$followed->description}}</p>
                                        @else
                                            <p class="card-text">Sin descripción.</p>
                                        @endif
                                        <div class="d-flex">
                                        <a href="/perfil/{{$followed->id}}">Ver perfil</a>
                                            @if($followed->isFollowedBy(Auth::user()))
                                                <button data-id={{$followed->id}} class="btn btn-green btn-sm ml-auto js-follow"> <i class="fas fa-user-minus"></i>  Dejar de seguir</button>
                                            @else
                                                <button data-id={{$followed->id}} class="btn btn-green btn-sm ml-auto js-follow"> <i class="fas fa-user-plus"></i>  Seguir</button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
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