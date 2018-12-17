@extends('layouts.webLayout')
@section('content')
<div class="container-fluid login-register login pt-5 contacto">
    <div class="container mt-5">
        <div class="row justify-content-center align-items-center mt-5 cont-login-register">
            <div class="col-md-6">
                <div class="card">
                    <h1 class="sr-only">Login</h1>
                    <div class="card-header"><h2 class="h4">Dejanos tu consulta</h2></div>
                    @if($errors->any())
                        <div class="alert alert-success mx-3 my-3" role="alert">
                            {{$errors->first()}}
                        </div>
                    @endif
                    <div class="card-body">
                        <form method="POST" action="/contacto">
                            @csrf
                            <div class="form-group row">
                                <label for="email" class="ml-3">Nombre</label>
                                <div class="col-md-12">
                                    <input id="nombre" type="text" class="form-control" name="name" value="{{ old('email') }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="ml-3">Email</label>
                                <div class="col-md-12">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="consulta" class="ml-3">Consulta</label>
                                <div class="col-md-12">
                                    <textarea name="consulta" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12 d-flex justify-content-between mt-4">
                                    <button type="submit" class="btn btn-green ml-auto">
                                        Enviar consulta
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')
@endsection
