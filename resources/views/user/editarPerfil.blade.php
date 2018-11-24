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
                        <a class="nav-link active" href="/miperfil/editar"> Datos personales </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/miperfil/editar/contraseña"> Cambiar contraseña </a>
                    </li>
                </ul>
                @if($errors->any())
                    <pre> {{var_dump($errors)}} </pre>
                @endif
                @if (Session::has('msg'))
                    <div class="alert alert-info mt-3">{{ Session::get('msg') }}</div>
                @endif
                {!! Form::open(['method' => 'PATCH', 'url' => '/miperfil/editar', 'enctype' => 'multipart/form-data', 'row mt-3 profile-form']) !!}
                    <div class="row mt-5">
                        <div class="col-md-3">
                            <img src="/uploads/perfiles/{{Auth::user()->image}}" class="img-responsive profile-form__img js-preload-img" alt="Foto de perfil del usuario">
                            <div class="custom-file mt-3">
                                <input type="file" class="custom-file-input js-preload-input" name="image">
                                <label class="custom-file-label" for="customFile">Buscar archivo</label>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('name') ? ' is-invalid' : '' }}">
                                        <label for="name">Nombre</label>
                                        <input type="text" placeholder="Ingresar su nombre" class="form-control" name="name" value="{{Auth::user()->name}}" required>
                                        @if($errors->has('name'))
                                            <span class="d-block invalid-feedback" role="alert">
                                                <strong> {{$errors->first('name')}}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group  {{ $errors->has('email') ? ' is-invalid' : '' }}">
                                        <label for="name">Email</label>
                                        <input type="email" placeholder="Ingresar su nombre" class="form-control" name="email" value="{{Auth::user()->email}}" required>
                                        @if($errors->has('email'))
                                            <span class="d-block invalid-feedback" role="alert">
                                                <strong> {{$errors->first('email')}}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">Descripción</label>
                                        <textarea name="description" class="form-control">{{Auth::user()->description}}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">Facebook</label>
                                        <input type="text" placeholder="Ingresar la url completa" class="form-control" name="facebook" value="{{Auth::user()->facebook}}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">Instagram</label>
                                        <input type="text" placeholder="Ingresar la url completa" class="form-control" name="instagram" value="{{Auth::user()->instagram}}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">Twitter</label>
                                        <input type="text" placeholder="Ingresar la url completa" class="form-control" name="twitter" value="{{Auth::user()->twitter}}">
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