@extends('layouts.webLayout')
@section('title', 'Home')
@section('content')
    <h1>Home</h1>
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
            <li class="nav-item">
                Nombre de usuario: {{ Auth::user()->name }} <span class="caret"></span>
            </li>
            <li>
                <a href="recetas/nueva">Crear receta nueva</a>
            </li>
            <li>
                <a href="recetas/mis-recetas">Mis recetas</a>
            </li>
            @if(Auth::user()->hasRole('admin'))
                <li>
                    <a href="/admin">Vista que solo pueden ver los admin</a>                    
                </li>
            @endif
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