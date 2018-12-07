@extends('layouts.webLayout')
@section('content')
<div class="container-fluid login-register login pt-5">
    <div class="container mt-5">
        <div class="row justify-content-center align-items-center mt-5 cont-login-register">
            <div class="col-md-6">
                <div class="card">
                    <h1 class="sr-only">Login</h1>
                    <div class="card-header"><h2 class="h4">Iniciar sesión</h2></div>
                    @if($errors->any())
                        <div class="alert alert-danger mx-3 my-3" role="alert">
                            {{$errors->first()}}
                        </div>
                    @endif
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email" class="ml-3">Email</label>
                                <div class="col-md-12">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="ml-3">Contraseña</label>

                                <div class="col-md-12">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12 d-flex justify-content-between mt-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">
                                            Recordarme
                                        </label>
                                    </div>
                                    <button type="submit" class="btn btn-green">
                                        Ingresar
                                    </button>

                                    {{--<a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>--}}
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
