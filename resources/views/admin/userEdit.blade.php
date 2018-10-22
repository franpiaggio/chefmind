@extends('layouts.webLayout')
@section('title', 'Admin')
@section('content')
    <h1>Edición de usuario: {{$user->name}}</h1>
    {!! Form::model($user, ['method' => 'PATCH','url' => '/admin/usuarios/' . $user->id]) !!}
        <label for="name">Nombre:</label><br>
        <input type="text" name="name" class="form-control" value="{{$user->name}}">
        @if( Auth::user()->id != $user->id )
            <label for="role">Rol:</label>
            <select class="form-control" name="role">
                @foreach($roles as $rol)
                <option 
                    value="{{$rol->id}}"  
                    @foreach($user->roles as $selected)
                        @if( $selected->id == $rol->id)
                            selected
                        @endif
                    @endforeach
                    >{{$rol->name}}</option>
                @endforeach
            </select> <br>
        @endif
        <label for="email"> Mail: </label>
        <input class="form-control" type="email" name="email" value="{{$user->email}}"><br>
        <input type="submit">
    {!! Form::close() !!}
@endsection 