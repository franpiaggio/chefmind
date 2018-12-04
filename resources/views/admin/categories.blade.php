@extends('layouts.webLayout')
@section('title', 'Categorías')
@section('content')
<main class="main-container container-fluid">  
    <div class="row">
        <header class="col-md-12 admin-topbar">
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
                    <a class="nav-link" href="/admin/recetas">Todas las recetas</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" href="/admin/categorias">Categorías</a>
                  </li>
                </ul>
            </div>
        </div>
        <section class="col-md-12 mt-3">
            <div class="container">
                <div class="d-flex">
                    <h2 class="mb-3">Categorías disponibles</h2>
                    <a href="/admin/categorias/nueva" class="btn btn-primary ml-auto my-3">Nueva categoría</a>
                </div>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Estado</th>
                        <th>Autor</th>
                        <th>Foto</th>
                        <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($categories as $category)
                        <tr  @if(!$category->active) class="table-danger" @endif>
                            <td>{{$category->id}}</td>
                            <td>{{$category->name}}</td>
                            <td>{{ $category->active  ? 'activa' : 'inactiva'}}</td>
                            <td> 
                                @if($category->user) 
                                    <a href="usuario/{{$category->user->id}}">{{$category->user->name}}</a>
                                @else 
                                    -
                                @endif 
                            </td>
                            <td>@if($category->img)<a href="/uploads/categorias/{{$category->img}}">Ver foto</a>@endif</td>
                            <td>
                                <a href="/categorias?categoria={{$category->name}}" class="mx-1 btn btn-primary">Ver recetas</a>
                                <a href="/admin/categoria/{{$category->id}}/editar" class="mx-1 btn btn-outline-primary">Editar</a>
                                <a href="/admin/categoria/{{$category->id}}/activar" class="mx-1 btn btn-outline-warning">
                                    @if($category->active) 
                                        Desactivar
                                    @else 
                                        Activar
                                    @endif
                                </a> 
                                <a href="/admin/categoria/{{$category->id}}/borrar" class="mx-1 btn btn-danger">Borrar</a>
                            </td>
                        </tr>  
                    @endforeach  
                  </tbody>
                </table>
                {{$categories->links()}}
            </div>
        </section>	        
    </div>
</main>
@include('layouts.footer')
@endsection 