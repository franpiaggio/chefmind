@extends('layouts.webLayout')
@section('title', 'Editar mi perfil')
@section('content')
<main class="main-container container-fluid">
    <div class="row">
        <header class="col-md-12 profile-topbar">
            <div class="container">
                <h2>Editar mi perfil</h2>
            </div>
        </header>
        <div class="col-md-12 mt-5">
            <div class="container">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link" href="/miperfil/editar"> Datos personales </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/miperfil/editar/contraseña"> Cambiar contraseña </a>
                    </li>
                </ul>
                @if($errors->any())
                    <div class="alert alert-warning my-3">
                        {{$errors->first()}}
                    </div>
                @endif
                {!! Form::open(['method' => 'POST', 'url' => '/miperfil/editarContraseña', 'row mt-3 profile-form']) !!}
                    <div class="row mt-5 mb-5">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">Nueva contraseña</label>
                                        <input type="text" placeholder="Ingresar la nueva contraseña" class="form-control" name="pass1" value="">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">Repetir contraseña</label>
                                        <input type="text" placeholder="Repetir la nueva contraseña" class="form-control" name="pass2" value="">
                                    </div>
                                </div>
                                <div class="col-md-12 d-flex">
                                    <input type="submit" class="btn btn-primary ml-auto" value="Guardar cambios">
                                </div>
                            </div>                            
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    @include('layouts.footer')
</main>
@endsection