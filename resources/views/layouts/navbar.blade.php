<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
    <div class="container">
        <a class="navbar-brand" href="/">Chefmind</a>
        <button 
            class="navbar-toggler" 
            type="button" 
            data-toggle="collapse" 
            data-target="#menuPrincipal" 
            aria-controls="menuPrincipal" 
            aria-expanded="false" 
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="menuPrincipal">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item {{ Request::is('categorias') ? 'active' : '' }}">
                    <a class="nav-link" href="/categorias">Recetas</a>
                </li>
                <li class="nav-item {{ Request::is('contacto') ? 'active' : '' }}">
                    <a class="nav-link" href="/contacto">Contacto</a>
                </li>
                @auth
                @if(Auth::user()->hasRole('admin'))
                    <li class="nav-item {{ Request::is('admin') ? 'active' : '' }}">
                        <a class="nav-link" href="admin">Administrador</a>
                    </li>
                @endif
                @endauth
                @guest
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('login') ? 'active' : '' }}" href="/login">Login</a>
                    </li>
                    <li class="nav-item {{ Request::is('register') ? 'active' : '' }}">
                        <a href="/register" class="btn btn-outline-primary btn-sm registrarse">Registrarse</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="/recetas/nueva" class="btn btn-outline-warning btn-sm registrarse">Crear receta</a>
                    </li>
                    <li class="nav-item menu-usuario">
                        <div class="dropdown">                           
                          <button class="btn btn-light btn-sm registrarse dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Mi Perfil
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="/miperfil"> <i class="far fa-user"></i> Mi perfil</a>
                            <a class="dropdown-item" href="/recetas/mis-recetas"> <i class="fas fa-book"></i> Mis recetas</a>
                            <a class="dropdown-item" href="/recetas/mis-favoritos"> <i class="far fa-star"></i> Favoritos</a>
                            <a 
                                class="dropdown-item logout"
                                href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i> 
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" class="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                            </form>
                          </div>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
<nav class="navbar navbar-expand-lg navbar-dark primary-color">
    <div class="container">
        <a class="navbar-brand" href="/">Chefmind</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav  ml-auto">
                {{-- Items globales --}}
                <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item {{ Request::is('categorias') ? 'active' : '' }}">
                    <a class="nav-link" href="/categorias">Categorías</a>
                </li>
                <li class="nav-item {{ Request::is('contacto') ? 'active' : '' }}">
                    <a class="nav-link" href="/contacto">Contacto</a>
                </li>
                {{-- Items logueado/deslogueado --}}
                @guest
                    <li class="nav-item {{ Request::is('login') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    <li class="nav-item {{ Request::is('register') ? 'active' : '' }}">
                        @if (Route::has('register'))
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        @endif
                    </li>
                @else
                    <li class="nav-item {{ Request::is('recetas/nueva') ? 'active' : '' }}">
                        <a class="nav-link" href="/recetas/nueva">Subí tu receta</a>
                    </li>
                    {{-- Desplegable usuario --}}
                    <li class="nav-item dropdown">
                        <a 
                            class="nav-link dropdown-toggle waves-effect waves-light" 
                            id="navbarDropdownMenuLink-4" 
                            data-toggle="dropdown" 
                            aria-haspopup="true" 
                            aria-expanded="true">
                            <i class="fa fa-user"></i> {{ Auth::user()->name }} 
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-info" aria-labelledby="navbarDropdownMenuLink-4">
                            <a class="dropdown-item waves-effect waves-light" href="/miperfil">Mi cuenta</a>
                            <a class="dropdown-item waves-effect waves-light" href="/recetas/mis-recetas">Mis recetas</a>
                            <a class="dropdown-item waves-effect waves-light" href="/recetas/mis-favoritos">Mis favoritos</a>
                            <a 
                                class="dropdown-item waves-effect waves-light"
                                href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" class="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                            </form>
                        </div>
                    </li>
                    {{-- Desplegable de administrador --}}
                    @if(Auth::user()->hasRole('admin'))
                        <li class="nav-item dropdown">
                            <a 
                                class="nav-link dropdown-toggle waves-effect waves-light" 
                                id="navbarDropdownMenuLink-4" 
                                data-toggle="dropdown" 
                                aria-haspopup="true" 
                                aria-expanded="true">
                                <i class="fa fa-user"></i> Administrador 
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-info" aria-labelledby="navbarDropdownMenuLink-4">
                                <a class="dropdown-item waves-effect waves-light" href="/admin/usuarios">Usuarios</a>
                                <a class="dropdown-item waves-effect waves-light" href="/admin/recetas">Todas las recetas</a>
                                <a class="dropdown-item waves-effect waves-light" href="/admin/categorias">Categorías</a>
                            </div>
                        </li>
                    @endif
                @endguest
            </ul>
        </div>
    </div>
</nav>