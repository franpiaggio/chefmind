@extends('layouts.webLayout')
@section('title', 'Chefmind - Categorías')
@section('content')
<main class="main-container">
    <section class="search-filter top-banner">
        <div class="container text-center">
            @if( !Request::query('categoria') )
                <h1>Todas las recetas</h1>
            @else
                <h1>{{Request::query('categoria')}}</h1>
            @endif
        </div>
    </section>
    <section class="container my-5 no-mt">
        <div class="row mt-5 equal no-mt">
            <div class="col-md-12 col-xl-3">
                <div class="js-filters">
                    <h2 class="my-4">Buscar</h2>
                    <form action="/categorias" method="GET">
                        <div class="input-group">
                            @if(Request::query('categoria'))
                            <input type="hidden" name="categoria" value="{{Request::query('categoria')}}">
                            @endif
                            <input type="text" class="form-control" placeholder="Buscá tu receta" name="buscar">
                            <div class="input-group-append">
                                <input type="submit" class="btn btn-outline-green" value="Buscar"/>
                            </div>
                        </div>
                    </form>
                    <h2 class="my-4">Categorías</h2>
                    <ul class="list-group categories">
                        <li class="list-group-item {{Request::query('categoria') == '' ? 'active' : ''}}">
                            <a class="d-flex justify-content-between align-items-center" href="?categoria">
                            <span class="filter-cat-name">Todas</span>
                            </a>
                        </li>
                        @foreach($categories as $category)
                            <li class="list-group-item {{Request::query('categoria') == $category->name ? 'active' : ''}}">
                                <a class="d-flex justify-content-between align-items-center" href="?categoria={{$category->name}}">
                                    <span class="filter-cat-name">{{$category->name}}</span>
                                    <span class="badge badge-orange badge-pill">{{$category->recipes->count()}}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                @if(Auth::check())
                    <div class="custom-file mt-4">
                        <p class="mb-1">¿Querés agregar una nueva categoría?</p>
                        <p>Hacé clic <span class="add-cat color-orange">acá</span></p>                        
                        <form class="add-cat-form" method="POST" action="/categoria" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="name" placeholder="Nombre categoría" class="form-control" value="{{old('name')}}">
                            </div>
                            <input type="submit" value="Guardar categoría" class="btn btn-orange">
                            <a class="btn btn-link cancel-add-cat">Cancelar</a> 
                            @if($errors->any())
                                <p class="small mt-3 text-success">{{$errors->first()}}</p>
                            @endif
                        </form>
                    </div>
                @endif
            </div>
            <div class="col-md-12 col-xl-9 mt-5">
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
                        <div class="col-md-12 col-12 mb-3 recipe-list">
                            <div class="card">
                                <div class="row ">
                                    <div class="col-md-5 col-xl-4  img-cont">
                                        <a href="{{ url('/recetas', $recipe->id) }}">
                                            <img src="/uploads/featured/{{$recipe->featured_image}}" class="w-100">
                                        </a>
                                    </div>
                                    <div class="col-md-7 col-xl-8 px-3">
                                        <div class="card-block px-3 py-3">
                                            <div class="d-flex title-rate-cont">
                                                <h4 class="card-title"><a href="{{ url('/recetas', $recipe->id) }}">{{$recipe->title}}</a></h4>
                                                <div class="recipe-rate stars ml-auto mt-2 rate-{{(int)$recipe->averageRating}}">
                                                    <span data-rate="1" class="js-rate fa fa-star"></span>
                                                    <span data-rate="2" class="js-rate fa fa-star"></span>
                                                    <span data-rate="3" class="js-rate fa fa-star"></span>
                                                    <span data-rate="4" class="js-rate fa fa-star"></span>
                                                    <span data-rate="5" class="js-rate fa fa-star"></span>
                                                </div>
                                            </div>
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
                                                <a href="{{ url('/recetas', $recipe->id) }}" class="card-link"><i class="fas fa-plus"></i> <span class="sr-only">Ver Receta</span></a>
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