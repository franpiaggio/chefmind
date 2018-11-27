@extends('layouts.webLayout')
@section('title', 'Crear recetas')
@section('content')
<main class="main-container container-fluid">
    <div class="row">
        <header class="col-md-12 profile-topbar">
            <div class="container">
                <h2>Nueva receta</h2>
            </div>
        </header>
        <div class="col-md-12 mt-5">
            <div class="container">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="#"> Infromación de la receta </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"> Album de fotos </a>
                    </li>
                </ul> 
                <form id="enviar" method="POST" action="/recetas" class="row mt-3 profile-form" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-7">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">Nombre</label>
                                    <input type="text" placeholder="Ingresar su nombre" class="form-control" name="title" value="{{ old('title') }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="textpreview">Descripción corta</label>
                                    <textarea placeholder="Ingresar descripción corta" class="form-control" name="textpreview">{{ old('textpreview') }}</textarea>
                                    <small>Este texto se verá en la previsualización de la receta.</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Tiempo estimado</label>
                                    <input type="text" placeholder="Ej: 30 minutos" class="form-control" name="time"  value="{{old('title')}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Dificultad</label>
                                    <select name="difficulty" class="form-control">
                                        <option value="Fácil">Fácil</option>
                                        <option value="Media">Media</option>
                                        <option value="Difícil">Difícil</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Comensales</label>
                                    <input type="number" placeholder="Ej: 5 personas" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5" id="drop-area">
                        <label for="name">Imagen destacada</label>
                        <div class="js-img-container img-container">
                            <i class="fas fa-plus icon"></i>
                            <img src="" alt="preview de la receta" class="js-drop-image d-none">
                        </div>
                        <div class="custom-file mt-3">
                            <input type="file" class="custom-file-input js-preload-input" name="featured_image" value="{{ old('featured_image') }}">
                            <label class="custom-file-label" for="customFile">Subir imagen</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group crear-receta">
                            <label for="test">Categorías</label>
                            <select name="categories[]" id="categoriesSelector" class="form-control" multiple>
                                @foreach($categories as $category)
                                    {{-- Si hay valores viejos, reviso si la opcion estaba seleccionada y la marco como selected --}}
                                    @if(old('categories') && in_array( $category->id, old('categories') ))
                                        <option value="{{$category->id}}" selected>{{$category->name}}</option>
                                    @else
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>                   
                    <div class="col-md-12">
                        <div class="form-group crear-receta">
                            <label for="test">Ingredientes</label>
                            <select name="ingredients[]" id="ingredientsSelector" class="form-control" multiple>
                                    {{-- Si hay valores viejos los agrego --}}
                                @if( old('ingredients') )
                                    @foreach(old('ingredients') as $ingredient)
                                        <option value="{{$ingredient}}" selected>{{$ingredient}}</option>
                                    @endforeach
                                @endif            
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 crear-receta mb-5">
                        <label for="body" >Pasos a seguir</label>
                        <small class="d-block mb-2">Contanos los detalles más importantes: ¿Que cantidades necesito? ¿Qué pasos debo seguir?</small>
                        <input name="body" type="hidden" value="{{old('body')}}">
                        <div id="editor-container"></div>
                    </div>
                    <div class="col-md-12 d-flex">
                        <input type="submit" class="btn btn-primary ml-auto" value="Crear receta">
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
    {{-- 
    <div class="container">
        <h1>Crear una receta</h1>
        <form method="POST" action="/recetas" enctype="multipart/form-data" id="enviar">
            @csrf
            
            <label for="title">Nombre</label><br>
            <input class="form-control" type="text" name="title" value="{{ old('title') }}"><br>

            <label for="textpreview">Descripción corta</label>
            <textarea class="form-control" name="textpreview" cols="30" rows="2">{{ old('textpreview') }}</textarea><br>

            <label for="time">Tiempo estimado</label>
            <input type="text" class="form-control" name="time" value="{{old('title')}}">

            <label for="quantity">Cantidad de personas</label>
            <input type="number" class="form-control" name="quantity" value="{{old('quantity')}}">

            <label for="time">Dificultad</label>
            <select name="difficulty" class="form-control">
                <option value="Fácil">Fácil</option>
                <option value="Media">Media</option>
                <option value="Difícil">Difícil</option>
            </select>
            

            <label for="categories">Categoria</label><br>
            <select class="form-control" id="categoriesSelector" name="categories[]" multiple>
                @foreach($categories as $category)
                    @if(old('categories') && in_array( $category->id, old('categories') ))
                        <option value="{{$category->id}}" selected>{{$category->name}}</option>
                    @else
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endif
                @endforeach
            </select><br>


            <label for="categories">Ingredientes</label><br>
            <select class="form-control" name="ingredients[]" id="ingredientsSelector" multiple><br>

                @if( old('ingredients') )
                    @foreach(old('ingredients') as $ingredient)
                        <option value="{{$ingredient}}" selected>{{$ingredient}}</option>
                    @endforeach
                @endif
            </select>

            <label for="body">Descripción</label><br>
            <input name="body" type="hidden" value="{{old('body')}}">
            <div id="editor-container"></div>
            
            <label for="featured_image">Imágen destacada</label> <br>
            <input name="featured_image" class="form-control" type="file" value="{{ old('featured_image') }}"><br>

            <hr>
            <label for="images[]">Galería</label> <br>
            <input name="images[]" class="form-control" type="file" multiple><br>

            <input type="submit">
        </form>
    </div>
        <div>
            @if($errors->any())
                <pre> {{var_dump($errors)}} </pre>
            @endif
        </div>
    --}}
        <div>
            @if($errors->any())
                <pre> {{var_dump($errors)}} </pre>
            @endif
        </div>
        @include('layouts.footer')
        @section('footer')
        <script src="{{ asset('js/crear-receta.js') }}">
        </script>
    @endsection
@endsection 