@extends('layouts.webLayout')
@section('title', 'Categorías')
@section('content')
<main class="main-container container-fluid">  
    <div class="row">
        <header class="col-md-12 admin-topbar top-banner">
            <div class="container">
                <h2>Administrador</h2>
            </div>
        </header>
        <div class="col-md-12 mt-5">
            <div class="container">
                <ul class="nav nav-tabs">
                  <li class="nav-item">
                    <a class="nav-link" href="/admin/usuarios">Usuarios</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" href="/admin/recetas">Todas las recetas</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/admin/categorias">Categorías</a>
                  </li>
                </ul>
            </div>
        </div>
        <section class="col-md-12 mt-3">
            <div class="container">
                <h2 class="mb-3">Todas las recetas</h2>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Autor</th>
                        <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($recipes as $recipe)
                    <tr>
                        <td>{{$recipe->id}}</td>
                        <td>{{$recipe->title}}</td>
                        <td>{{$recipe->user->name}}</td>
                        <td>
                            <a href="/admin/recetas/{{$recipe->id}}/borrar" class="btn btn-danger">Borrar</a>
                            <a href="/recetas/{{$recipe->id}}" class="btn btn-primary mx-3">Ver receta</a>
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                {{$recipes->links()}}
            </div>
        </section>	        
    </div>
</main>
@include('layouts.footer')
@endsection