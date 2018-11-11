@extends('layouts.webLayout')
@section('title', 'Todas las recetas')
@section('content')
    <div class="container">
        <h1>Editar perfil</h1>
        {!! Form::open(['method' => 'PATCH', 'url' => '/miperfil/editar', 'enctype' => 'multipart/form-data']) !!}

            <label for="name">Nombre:</label><br>
            <input type="text" name="name" class="form-control" value="{{Auth::user()->name}}">

            <label for="email"> Descripción: </label>
            <textarea class="form-control" name="description" id="" cols="30" rows="2">{{Auth::user()->description}}</textarea>

            <img src="/uploads/perfiles/{{Auth::user()->image}}" alt="Foto de perfil del usuario"> <br>
            <input type="file" name="image"> <br>

            <label for="email"> Mail: </label>
            <input class="form-control" type="text" name="email" value="{{Auth::user()->email}}"><br>

            <label for="email"> Facebook: </label>
            <input class="form-control" type="text" name="email" value="{{Auth::user()->facebook}}"><br>

            <label for="email"> Twitter: </label>
            <input class="form-control" type="text" name="email" value="{{Auth::user()->twitter}}"><br>

            <label for="email"> Instagram: </label>
            <input class="form-control" type="text" name="email" value="{{Auth::user()->instagram}}"><br>

            <label for="password"> Contraseña: </label> <br>
            <input type="password" name="password" class="form-control" value="{{Auth::user()->password}}"><br>
            <input type="submit">
        {!! Form::close() !!}
    </div>
@endsection