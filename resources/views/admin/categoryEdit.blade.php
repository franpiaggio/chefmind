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
                    <h2 class="mb-3">Categoria: {{$cat->name}}</h2>
                    <a href="/admin/categorias" class="btn btn-primary ml-auto my-3">Volver</a>
                </div>
                {!! Form::model($cat, ['method' => 'PATCH','url' => '/admin/categoria/' . $cat->id, 'enctype' => 'multipart/form-data']) !!}
                    <label for="name">Nombre</label>
                    <input type="text" name="name" class="form-control" value="{{$cat->name}}">
                    <label for="img">Imágen</label>
                    <input class="form-control" name="img" type="file">
                    <img src="/uploads/categorias/{{$cat->img}}" alt="" style="max-width: 500px"> <br>
                    <input type="submit">
                {!! Form::close() !!}
                <div>
                    @if($errors->any())
                        <pre> {{var_dump($errors)}} </pre>
                    @endif
                </div>
            </div>
        </section>	        
    </div>
</main>
@include('layouts.footer')
@endsection