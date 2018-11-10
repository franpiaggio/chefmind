@extends('layouts.webLayout')
@section('title', 'Admin')
@section('content')
    <div class="container">
        <h1>Usuarios</h1>
        <p>Si intentas entrar con otro usuario te patea</p>
        <table class="table table-hover">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Email</th>
            <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr @if($user->user_state_id == 2) class="table-danger" @endif>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td> 
                        @if( Auth::user()->id != $user->id )
                            <a href="{{ url('admin/usuarios/'.$user->id.'/editar') }}">Editar</a>
                            @if( $user->user_state_id == 1 ) 
                                <a href="{{ url('admin/usuarios/'.$user->id.'/ban') }}">
                                    Banear 
                                </a> 
                            @elseif( $user->user_state_id == 2 )
                                <a href="{{ url('admin/usuarios/'.$user->id.'/ban') }}">
                                    Desbanear 
                                </a> 
                            @endif
                                
                            <a href="{{ url('admin/usuarios/'.$user->id.'/borrar') }}"> Borrar </a> 
                        @endif
                    </td>
                </tr>
            @endforeach            
        </tbody>
        </table>
        {{$users->links()}}
    </div>
@endsection 