@extends('layouts.webLayout')
@section('title', 'Admin')
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
                    <a class="nav-link active" href="#">Usuarios</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Todas las recetas</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Categorías</a>
                  </li>
                </ul>
            </div>
        </div>
        <section class="col-md-12 mt-3">
            <div class="container">
                <h2 class="mb-3">Usuarios registrados</h2>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Nombre</th>
                      <th scope="col">Email</th>
                      <th scope="col">Estado</th>
                      <th scope="col">Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($users as $user)
                        <tr @if($user->user_state_id == 2) class="table-warning" @endif>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            @if($user->user_state_id == 2)
                                <span class="badge badge-pill badge-danger">Baneado</span>
                            @else
                                <span class="badge badge-pill badge-success">Activo</span>
                            @endif
                        </td>
                        <td>
                            @if( Auth::user()->id != $user->id )
                            @if(!$user->hasRole('admin'))
                                    <a href="{{ url('admin/usuarios/'.$user->id.'/editar') }}" class="btn btn-outline-primary btn-sm mr-2"> <i class="far fa-edit"></i> Editar</a>
                                    @if( $user->user_state_id == 1 ) 
                                        <a href="{{ url('admin/usuarios/'.$user->id.'/ban') }}" class="btn btn-outline-warning btn-sm mr-2"> <i class="fas fa-hammer"></i> Banear</a>
                                    @elseif( $user->user_state_id == 2 )
                                        <a href="{{ url('admin/usuarios/'.$user->id.'/ban') }}" class="btn btn-outline-success btn-sm mr-2">Desbanear</a>
                                    @endif
                                    <a href="{{ url('admin/usuarios/'.$user->id.'/borrar') }}" class="btn btn-outline-danger btn-sm"> <i class="far fa-trash-alt"></i> Borrar</a>
                                @else
                                    <span class="badge badge-pill badge-warning">Administrador</span>
                                @endif
                            @endif
                        </td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
                {{$users->links()}}
            </div>
        </section>	        
    </div>
</main>
@include('layouts.footer')
@endsection 