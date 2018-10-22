@extends('layouts.webLayout')
@section('title', 'Admin')
@section('content')
    <h1>Vistas solo para administradores</h1>
    <p>Si intentas entrar con otro usuario te patea</p>
    <!-- Chequeo manual -->
    @if(Auth::check())
        @if(Auth::user()->hasRole('admin'))
            <div>Acceso como administrador</div>
        @else
            <div>Acceso usuario</div>
        @endif
        Estas Logeado
    @endif
    <!-- Chequeo usando guest de blade -->
    <ul>
        @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            <li class="nav-item">
                @if (Route::has('register'))
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                @endif
            </li>
        @else
            <li class="nav-item dropdown">
                Nombre de usuario: {{ Auth::user()->name }} <span class="caret"></span>
            </li>
            <li>
                <a 
                href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                </form>
            </li>
        @endguest
    </ul>
@endsection 