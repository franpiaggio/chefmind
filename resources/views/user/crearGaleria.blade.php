@extends('layouts.webLayout')
@section('title', 'Crear recetas')
@section('content')
<main class="main-container container-fluid  mb-5">
    <div class="row">
        <header class="col-md-12 profile-topbar top-banner">
            <div class="container">
                <h2>{{ $recipe->title }}</h2>
            </div>
        </header>
        <div class="col-md-12 mt-5">
            <div class="container">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link" href="/recetas/{{$recipe->id}}/editar"> Infromación de la receta </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#"> Album de fotos </a>
                    </li>
                    <li class="nav-item ml-auto">
                        <a href="{{ url('/recetas', $recipe->id) }}" class="btn">Ver receta</a>
                    </li>
                </ul>
                <!-- Galería -->
                <form action="/recetas/{{$recipe->id}}/galeria" id="img-upload-form"  class="mt-3 profile-form" enctype="multipart/form-data" method="POST">
                    @csrf
                    <h3 class="border">Cargar nuevas imágenes</h3>
                    <div class="form-group">
                        <label for="upload_imgs" class="btn btn-outline-success"> + Seleccionar imágenes</label>
                        <input class="d-none" type="file" id="upload_imgs" name="images[]" multiple/>
                        <div class="quote-imgs-thumbs quote-imgs-thumbs--hidden" id="img_preview">
                    </div>
                        
                    </div>
                    <input class="btn btn-primary" type="submit" name="submit" value="Subir imágenes"/>
                </form>
                @if( $recipe->images()->get() )
                    <div class="gallery mt-5">
                        <h3 class="mt-3">Imágenes cargadas</h3>
                        <div class="row">
                            @foreach( $recipe->images()->get() as $image )
                                <div class="col-md-4" id="imagen{{ $image->id}}">
                                    <div class="card">
                                        <img class="card-img-top" src="/uploads/imagenes/{{$image->name}}" alt="Imagen de galeria">
                                        <div class="card-body d-flex">
                                            <a href="/uploads/imagenes/{{$image->name}}" class="btn btn-light">Ver</a>
                                            <button data-id="{{$image->id}} "class="btn btn-danger ml-auto js-borrar-foto">Borrar</button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</main>
@include('layouts.footer')
@section('footer')
    <script src="{{ asset('js/galeria.js') }}">
    </script>
@endsection
@endsection 