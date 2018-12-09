@extends('layouts.webLayout')
@section('title', 'Categorías')
@section('content')
<main class="main-container container-fluid mb-5">  
    <div class="row">
        <header class="col-md-12 admin-topbar admin-topbar">
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
                        <a class="nav-link" href="/admin/recetas">Recetas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/admin/categorias">Categorías</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/ingredientes">Ingredientes</a>
                    </li>
                </ul>
            </div>
        </div>
        <section class="col-md-12 mt-3">
            <div class="container">
                <div class="d-flex align-items-center">
                    <h2 class="mb-3 mt-3">Categorías disponibles</h2>
                    <button class="btn btn-primary ml-auto my-3 new-category">Nueva categoría </button>
                </div>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Estado</th>
                        <th>Autor</th>
                        <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($categories as $category)
                        <tr  @if(!$category->active) class="table-danger" @endif>
                            <td>{{$category->id}}</td>
                            <td>{{$category->name}}</td>
                            <td>
                            @if($category->active)
                             <span class="badge badge-pill badge-success">activa</span>
                             @else 
                             <span class="badge badge-pill badge-danger">inactiva</span>
                             @endif
                             </td>
                            <td> 
                                @if($category->user) 
                                    <a href="usuario/{{$category->user->id}}">{{$category->user->name}}</a>
                                @else 
                                    -
                                @endif 
                            </td>
                            <td>
                                <a href="/categorias?categoria={{$category->name}}" class="mx-1 btn btn-primary">Ver recetas</a>
                                <a href="/admin/categoria/{{$category->id}}/editar" class="mx-1 btn btn-outline-primary">Editar</a>
                                <a href="/admin/categoria/{{$category->id}}/activar" class="mx-1 btn btn-warning">
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
        <div class="modal fade" id="newCategory" role="dialog" aria-labelledby="new" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="new">Nueva categoría</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="reasignForm" method="POST" action="/admin/categorias/nueva">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name" class="col-form-label">Nombre:</label>
                            <input type="text" class="form-control" id="old-name-reasign" name="name">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <input type="submit" class="btn btn-primary" value="Guardar cambio" >
                    </div>
                </form>
                </div>
            </div>
        </div>         
    </div>
</main>
@include('layouts.footer')
<script>
    $(function(){
        $('.new-category').click(function(){
            $('#newCategory').modal();
        });
    });
</script>
@endsection 