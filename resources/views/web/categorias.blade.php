@extends('layouts.webLayout')
@section('title', 'Chefmind - Categorías')
@section('content')
<main class="main-container">
    <section class="search-filter">
        <div class="container text-center">
            @if( !Request::query('categoria') )
                <h1>Todas las recetas</h1>
            @else
                <h1>{{Request::query('categoria')}}</h1>
            @endif
        </div>
    </section>
    <section class="container mt-5">
        <div class="row mt-5 equal">
            <div class="col-md-3">
                <div class="js-filters">
                    <h2>Buscar</h2>
                    <form action="/categorias" method="GET">
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
                    <h2 class="my-3">Categorías</h2>
                    <ul class="list-group categories">
                        <li class="list-group-item {{Request::query('categoria') == '' ? 'active' : ''}}">
                            <a class="d-flex justify-content-between align-items-center" href="?categoria">
                                Todas
                            </a>
                        </li>
                        @foreach($categories as $category)
                            <li class="list-group-item {{Request::query('categoria') == $category->name ? 'active' : ''}}">
                                <a class="d-flex justify-content-between align-items-center" href="?categoria={{$category->name}}">
                                    {{$category->name}}
                                    <span class="badge badge-primary badge-pill">{{$category->recipes->count()}}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                @if(Auth::check())
                    <div class="custom-file mt-3">
                        <p class="mb-1">¡Recomendanos nuevas!</p>
                        <form method="POST" action="/categoria" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="name" placeholder="Nueva categoría" class="form-control" value="{{old('name')}}">
                            </div>
                            <div class="form-group position-relative">
                                <input name="img" type="file" class="custom-file-input js-preload-input">
                                <label class="custom-file-label" for="customFile">Subir imagen</label>
                            </div>
                            <input type="submit" value="Enviar" class="btn btn-primary">
                            @if($errors->any())
                                <p class="small mt-3 text-success">{{$errors->first()}}</p>
                            @endif
                        </form>
                    </div>
                @endif
            </div>
            <div class="col-md-9 mt-5">
                @if( Request::query('buscar') )
                    <h3>Resultado de búsqueda: {{Request::query('buscar')}}</h3>
                @endif
                <div class="row my-3">
                    @if(!$recipes->count())
                        <div class="alert alert-warning ml-3" role="alert">
                            No se encontraron recetas bajo esa búsqueda.
                        </div>
                    @endif
                    @foreach($recipes as $recipe)
                        <div class="col-md-12 mb-3 recipe-list">
                            <div class="card">
                                <div class="row ">
                                    <div class="col-md-4">
                                        <img src="/uploads/featured/{{$recipe->featured_image}}" class="w-100">
                                    </div>
                                    <div class="col-md-8 px-3">
                                        <div class="card-block px-3 py-3">
                                            <h4 class="card-title">{{$recipe->title}}</h4>
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
                                                <a href="{{ url('/recetas', $recipe->id) }}" class="btn btn-primary ml-auto">Ver más</a>
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
    </section>
</main>
@include('layouts.footer')
@section('footer')
    <script src="{{ asset('js/busquedas.js') }}"></script>
    <script src="{{ asset('js/recetas.js') }}"></script>
@endsection
@endsection 