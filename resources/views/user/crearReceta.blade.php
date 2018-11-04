@extends('layouts.webLayout')
@section('title', 'Crear recetas')
@section('content')
    <h1>Crear una receta</h1>
    <form method="POST" action="/recetas" enctype="multipart/form-data">
        @csrf
        
        <label for="title">Nombre</label><br>
        <input class="form-control" type="text" name="title" value="{{ old('title') }}"><br>

        <label for="time">Tiempo estimado</label>
        <input type="text" class="form-control" name="time" value="{{old('title')}}">

        <label for="time">Dificultad</label>
        <select name="difficulty" class="form-control">
            <option value="fácil">Fácil</option>
            <option value="media">Media</option>
            <option value="difícil">Difícil</option>
        </select>
        
        {{-- Categorias El server trae todas --}}
        <label for="categories">Categoria</label><br>
        <select class="form-control" id="categoriesSelector" name="categories[]" multiple>
            @foreach($categories as $category)
                {{-- Si hay valores viejos, reviso si la opcion estaba seleccionada y la marco como selected --}}
                @if(old('categories') && in_array( $category->id, old('categories') ))
                    <option value="{{$category->id}}" selected>{{$category->name}}</option>
                @else
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endif
            @endforeach
        </select><br>
        {{-- Ingredientes: se buscan con la api --}}
        <label for="categories">Ingredientes</label><br>
        <select class="form-control" name="ingredients[]" id="ingredientsSelector" multiple><br>
            {{-- Si hay valores viejos los agrego --}}
            @if( old('ingredients') )
                @foreach(old('ingredients') as $ingredient)
                    <option value="{{$ingredient}}" selected>{{$ingredient}}</option>
                @endforeach
            @endif
        </select>
        <label for="body">Descripción</label><br>
        <textarea class="form-control" name="body" cols="30" rows="10">{{ old('body') }}</textarea><br>
        
        <label for="featured_image">Imágen destacada</label> <br>
        <input name="featured_image" class="form-control" type="file" value="{{ old('featured_image') }}"><br>

        <input type="submit">
    </form>
    <!-- Errores del server -->
    <div>
        @if($errors->any())
            <pre> {{var_dump($errors)}} </pre>
        @endif
    </div>
    @section('footer')
        <script>
            $("#categoriesSelector").select2({
                placeholder:'Seleccionar categoría'
            });
            $("#ingredientsSelector").select2({
                language: "es",
                placeholder: 'Ingresa los ingredientes',
                minimumInputLength: 3,
                tags: true,
                ajax: {
                    dataType: 'json',
                    url: '/api/ingredients',
                    delay: 250,
                    data: function(params){
                        return{
                            ingredient: params.term
                        }
                    },
                    processResults: function(data){
                        // Le cambio la propiedad que viene como "name" a "text"
                        var test = $.map(data, function (obj) {
                            obj.id =  obj.text || obj.name; 
                            obj.text = obj.text || obj.name;
                            return obj;
                        });
                        // Devuelvo un object con la propiedad results como espera el plugin
                        return {
                            results: test
                        }
                    }
                },
                id: function(object) {
                    return object.text;
                }
            });
        </script>
    @endsection
@endsection 