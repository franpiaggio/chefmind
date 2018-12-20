<nav class="navbar navbar-expand-lg navbar-light bg-light {{Request::is('/')  ? 'fixed' : 'sticky-top'}}">
    <div class="container">
        <a class="navbar-brand" href="/"><img src="/svg/logo.svg" alt="logo chefmind" /></a>
        <button 
            class="navbar-toggler" 
            type="button" 
            data-toggle="collapse" 
            data-target="#menuPrincipal" 
            aria-controls="menuPrincipal" 
            aria-expanded="false" 
            aria-label="Toggle navigation"
            id="nav-icon">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
        </button>

        <div class="collapse navbar-collapse" id="menuPrincipal">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item {{ Request::is('/') || Request::is('buscar') ? 'active' : '' }}">
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
                        <a class="nav-link" href="/admin/usuarios">Administrador</a>
                    </li>
                @endif
                @endauth
                @guest
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('login') ? 'active' : '' }}" href="/login">Login</a>
                    </li>
                    <li class="nav-item {{ Request::is('register') ? 'active' : '' }}">
                        <a href="/register" class="btn btn-orange btn-sm registrarse">Registrarse</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="/recetas/nueva" class="btn btn-orange btn-sm registrarse">Crear receta</a>
                    </li>
                    <li class="nav-item menu-usuario">
                        <div class="dropdown">                           
                          <button class="btn btn-outline-orange btn-sm registrarse dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Mi Perfil
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item my-2" href="/miperfil"> <i class="far fa-user"></i> Mi perfil</a>
                            <a class="dropdown-item my-2" href="/miperfil/mis-favoritos"> <i class="far fa-star"></i> Favoritos</a>
                            <a class="dropdown-item my-2" href="/miperfil/seguidos"> <i class="far fa-address-book"></i> Usuarios seguidos</a>
                            <a 
                                class="dropdown-item my-2 logout"
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