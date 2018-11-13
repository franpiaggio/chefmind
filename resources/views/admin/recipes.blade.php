@extends('layouts.webLayout')
@section('title', 'Categorías')
@section('content')
    <div class="container">
        <h1>Todas las recetas</h1>
        <form action="/admin/buscar" method="GET">
            <input type="text" name="search" class="form-control">
            <input type="submit">
        </form>
        <table class="table table-hover">
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
                        <a href="/recetas/{{$recipe->id}}">Ver receta</a>
                        <a href="/admin/recetas/{{$recipe->id}}/borrar">Borrar</a>
                    </td>
                </tr>
            @endforeach   
        </tbody>
        </table>
        {{$recipes->links()}}
    </div>
@endsection 