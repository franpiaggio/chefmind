@extends('layouts.webLayout')
@section('title', 'Chefmind - Categorías')
@section('content')
<main class="main-container">
    <section class="search-filter">
        <form class="container text-center">
            <h1>Todas las recetas</h1>
        </form>
    </section>
    <section class="container mt-5">
        <div class="row mt-5 equal">
            <div class="col-md-3">
                <div class="js-filters">
                    <h2>Filtros</h2>
                    <form action="/categorias" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Buscá tu receta" name="buscar">
                            <div class="input-group-append">
                                <input type="submit" class="btn btn-outline-secondary" value="Buscar" />
                            </div>
                        </div>
                    </form>
                    <h2 class="my-3">Categorías</h2>
                    <ul class="list-group categories">
                        <li class="list-group-item active">
                            <a class="d-flex justify-content-between align-items-center" href="#">
                                Todas
                            </a>
                        </li>
                        @foreach($categories as $category)
                            <li class="list-group-item ">
                                <a class="d-flex justify-content-between align-items-center" href="#">
                                    {{$category->name}}
                                    <span class="badge badge-primary badge-pill">{{$category->recipes->count()}}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-9 mt-5">
                @if( Request::query('buscar') )
                    <h3>Resultado de búsqueda: {{Request::query('buscar')}}</h3>
                @endif
                <div class="row my-3">
                    <div class="col-md-6 mb-3">
                        <div class="card">
                            <img class="card-img-top" src=" https://picsum.photos/200/100/?random" alt="Card image cap">
                            <div class="card-body">
                                <h3 class="card-title">Receta 1</h3>
                                <p class="card-text">Descripción corta de receta</p>
                                <a href="#" class="card-link">Ver Receta</a>
                            </div>
                            <div class="card-footer d-flex">
                                <small class="text-muted">Creada por <a href="#">Autor</a></small>
                                <div class="icons ml-auto">
                                    <a href="#">
                                    12	
                                    <i class="fas fa-thumbs-up"></i>
                                </a>
                                    <a href="#" class="ml-3">
                                    <i class="fas fa-heart"></i>
                                </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card">
                            <img class="card-img-top" src=" https://picsum.photos/200/100/?random" alt="Card image cap">
                            <div class="card-body">
                                <h3 class="card-title">Receta 1</h3>
                                <p class="card-text">Descripción corta de receta</p>
                                <a href="#" class="card-link">Ver Receta</a>
                            </div>
                            <div class="card-footer d-flex">
                                <small class="text-muted">Creada por <a href="#">Autor</a></small>
                                <div class="icons ml-auto">
                                    <a href="#">
                                    12	
                                    <i class="fas fa-thumbs-up"></i>
                                </a>
                                    <a href="#" class="ml-3">
                                    <i class="fas fa-heart"></i>
                                </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <nav class="col-md-12 list-pagination my-3">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Siguiente</span>
                        </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </section>
</main>
<div class="container-fluid">
    <div class="container mt-5">
        @if(Auth::check())
            @if(Auth::user()->hasRole('user'))
                <h1>Recomendá una categoría</h1>
                <p>Esto solo se ve si estás logeado</p>
                <form method="POST" action="/categoria" enctype="multipart/form-data">
                    @csrf
                    <label for="name">Nombre</label>
                    <input type="text" name="name" class="form-control" value="{{old('name')}}">
                    <label for="img">Imágen</label>
                    <input class="form-control" name="img" type="file">
                    <input type="submit">
                </form>
                <div>
                    @if($errors->any())
                        <pre> {{var_dump($errors)}} </pre>
                    @endif
                </div>
            @endif
        @endif
        <div class="row">
            @foreach($categories as $category)
                <div class="col-md-4 mb-3">
                    <!-- Card -->
                    <div class="card card-cascade wider reverse">
                        <!-- Card image -->
                        <div class="view view-cascade overlay">
                            @if($category->img)
                                <img class="card-img-top" src="/uploads/categorias/{{$category->img}}" alt="{{$category->name}}">
                            @endif
                            <a href="/categoria/{{$category->id}}">
                                <div class="mask rgba-white-slight"></div>
                            </a>
                        </div>

                        <!-- Card content -->
                        <div class="card-body card-body-cascade text-center">
                    
                            <!-- Title -->
                            <h4 class="card-title"><strong>{{$category->name}}</strong></h4>
                            <!-- Subtitle -->
                            <a href="/categoria/{{$category->id}}" class="font-weight-bold indigo-text py-2">Ver recetas</a>                    
                    </div>
                    
                    </div>
                    <!-- Card -->
                </div>
            @endforeach
        </div>
        {{$categories->links()}}
    </div>
</div>
@endsection 