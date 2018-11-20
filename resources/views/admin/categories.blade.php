@extends('layouts.webLayout')
@section('title', 'Categorías')
@section('content')
    <div class="container">
        <h1>Categorías</h1>
        <a href="/admin/categorias/nueva" class="btn btn-primary">Nueva categoría</a>
        <table class="table table-hover">
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
                        <a href="/categoria/{{$category->id}}">Ver recetas</a>
                        <a href="/admin/categoria/{{$category->id}}/editar">Editar</a>
                        <a href="/admin/categoria/{{$category->id}}/activar">
                            @if($category->active) 
                                Desactivar
                            @else 
                                Activar
                            @endif
                        </a> 
                        <a href="/admin/categoria/{{$category->id}}/borrar">Borrar</a>
                    </td>
                </tr>  
            @endforeach   
        </tbody>
        </table>
        {{$categories->links()}}
    </div>
@endsection 