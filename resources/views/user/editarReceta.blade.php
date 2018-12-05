@extends('layouts.webLayout')
@section('title', 'Todas las recetas')
@section('content')
<main class="main-container container-fluid mb-5">
    <div class="row">
        <header class="col-md-12 profile-topbar">
            <div class="container">
                <h2>{{ $recipe->title }}</h2>
            </div>
        </header>
        <div class="col-md-12 mt-5">
            <div class="container">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="#"> Información de la receta </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/recetas/{{$recipe->id}}/crear-galeria"> Album de fotos </a>
                    </li>
                    <li class="nav-item ml-auto">
                        <a href="{{ url('/recetas', $recipe->id) }}" class="btn">Ver receta</a>
                    </li>
                </ul> 
                {!! Form::model($recipe, ['method' => 'PATCH','url' => 'recetas/' . $recipe->id,'class'=>'row my-3 profile-form', 'enctype' => 'multipart/form-data', 'id'=>'enviar']) !!}
                    @csrf
                    <div class="col-md-7">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="title">Nombre</label>
                                    <input type="text" placeholder="Ingresar su nombre" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" name="title" value="{{$recipe->title}}">
                                    @if($errors->has('title'))
                                        <span class="d-block invalid-feedback" role="alert">
                                            <strong> {{$errors->first('title')}}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="textpreview">Descripción corta</label>
                                    <textarea placeholder="Ingresar descripción corta" class="form-control" name="textpreview">{{ $recipe->textpreview }}</textarea>
                                    <small>Este texto se verá en la previsualización de la receta.</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Tiempo estimado</label>
                                    <input type="text" placeholder="Ej: 30 minutos" class="form-control" name="time"  value="{{ $recipe->time }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Dificultad</label>
                                    <select name="difficulty" class="form-control">
                                        @foreach( ['Fácil', 'Media', 'Difícil'] as $difficulty )
                                            @if($difficulty == $recipe->difficulty)
                                                <option value="{{$recipe->difficulty}}" selected>{{$recipe->difficulty}}</option>
                                            @else
                                                <option value="{{$difficulty}}">{{$difficulty}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Comensales</label>
                                    <input type="number" placeholder="Ej: 5 personas" class="form-control" name="quantity" value="{{$recipe->quantity}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5" id="drop-area">
                        <label for="name">Imagen destacada</label>
                        <div class="js-img-container img-container">
                            <img src="/uploads/featured/{{$recipe->featured_image}}" alt="{{$recipe->title}}" class="js-drop-image">
                        </div>
                        <div class="custom-file mt-3">
                            <input type="file" class="custom-file-input js-preload-input {{ $errors->has('featured_image') ? 'is-invalid' : '' }}" name="featured_image" value="{{ old('featured_image') }}">
                            <label class="custom-file-label js-file-label" for="customFile">Subir imagen</label>
                            @if($errors->has('featured_image'))
                                <span class="d-block invalid-feedback" role="alert">
                                    <strong> {{$errors->first('featured_image')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group crear-receta">
                            <label for="test">Categorías</label>
                            <select name="categories[]" id="categoriesSelector" class="form-control" multiple>
                                @foreach($categories as $category)
                                    <option 
                                        value="{{$category->id}}" 
                                        @foreach( $recipe->categories as $selected ) 
                                            @if( $selected->id == $category->id ) 
                                                selected="selected"
                                            @endif
                                        @endforeach
                                    >
                                        {{$category->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>                   
                    <div class="col-md-12">
                        <div class="form-group crear-receta">
                            <label for="test">Ingredientes</label>
                            <select name="ingredients[]" id="ingredientsSelector" class="form-control" multiple>
                                @foreach($recipe->ingredients as $ingredient)
                                    <option value="{{$ingredient->id}}" selected>
                                        {{$ingredient->name}}
                                    </option>
                                @endforeach            
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 crear-receta mb-5">
                        <label for="body" >Pasos a seguir</label>
                        <small class="d-block mb-2">Contanos los detalles más importantes: ¿Que cantidades necesito? ¿Qué pasos debo seguir?</small>
                        <input id="bodyInput" name="body" type="hidden" value="{{$recipe->body}}">
                        <div id="editor-container"></div>
                    </div>
                    <div class="col-md-12 d-flex">
                        <input type="submit" class="btn btn-primary ml-auto" value="Editar">
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</main>
@include('layouts.footer')
@section('footer')
    <script src="{{ asset('js/editar-receta.js') }}">
    </script>
@endsection

@endsection 