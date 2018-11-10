@extends('layouts.webLayout')
@section('title', 'Todas las recetas')
@section('content')
    <div class="container">
        <h1>Editar perfil</h1>
        <form method="POST" action="/recetas" enctype="multipart/form-data" id="enviar">
            <label for="name">Nombre:</label><br>
        <input type="text" name="name" class="form-control" value="{{Auth::user()->name}}">
            <label for="email"> Mail: </label>
            <input class="form-control" type="email" name="email" value="{{Auth::user()->email}}"><br>
            <label for="email"> Contraseña: </label> <br>
            <input type="password" name="password" class="form-control" value="{{Auth::user()->password}}"><br>
            <input type="submit">
        </form>
    </div>
@endsection