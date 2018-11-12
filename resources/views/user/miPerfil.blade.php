@extends('layouts.webLayout')
@section('title', 'Todas las recetas')
@section('content')
<div class="container mt-5">
    <style>
        .profile-header{
            background-color: #4285f4;
            height:150px;
        }
        .user-detail{
            margin:-50px 0px 30px 0px;
        }
        .user-detail img{
            height:100px;
            width:100px;
        }
        .user-detail h5{
            margin:15px 0px 5px 0px;
        }
        .user-social-detail{
            padding:15px 0px;
            background-color: #4285f4;
        }
        .user-social-detail a i{
            color:#fff;
            font-size:23px;
            padding: 0px 5px;
        }
    </style>
    <div class="row">
      <div class="offset-lg-4 col-lg-4 col-sm-6 col-12 main-section text-center">
          <div class="row">
              <div class="col-lg-12 col-sm-12 col-12 profile-header"></div>
          </div>
          <div class="row user-detail">
              <div class="col-lg-12 col-sm-12 col-12">
                  <img src="uploads/perfiles/{{Auth::user()->image}}" class="rounded-circle img-thumbnail">
                  <h5>{{ Auth::user()->name }}</h5>
                  <p><i class="fa fa-mail" aria-hidden="true"></i> {{ Auth::user()->email }}</p>

                  <hr>
                  <a href="/miperfil/editar" class="btn btn-info btn-sm">Editar datos</a>
                  <a href="/miperfil/editarContraseña" class="btn btn-danger btn-sm">Cambiar contraseña</a>

                  <hr>
                  <span>{{ Auth::user()->description }}</span>
              </div>
          </div>
          <div class="row user-social-detail">
              <div class="col-lg-12 col-sm-12 col-12">
                  @if( Auth::user()->facebook )
                    <a href="{{Auth::user()->facebook }}"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                  @endif
                  @if( Auth::user()->instagram )
                    <a href="{{Auth::user()->instagram }}"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                  @endif
                  @if( Auth::user()->twitter )
                    <a href="{{Auth::user()->twitter}}"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                  @endif
              </div>
          </div>
      </div>
    </div>
  </div>
@endsection 