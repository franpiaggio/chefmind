@extends('layouts.webLayout')
@section('title', 'Todas las recetas')
@section('content')
    <h1>Editar: {{ $recipe->title }}</h1>

    {!! Form::model($recipe, ['method' => 'PATCH','url' => 'recetas/' . $recipe->id, 'enctype' => 'multipart/form-data']) !!}
        <label for="title">Nombre</label><br>
        <input class="form-control" type="text" name="title" value="{{$recipe->title}}"><br>

        <label for="time">Tiempo estimado</label>
        <input type="text" class="form-control" name="time" value="{{$recipe->time}}">

        <label for="time">Dificultad</label>
        <select name="difficulty" class="form-control">
            @foreach( ['Fácil', 'Media', 'Difícil'] as $difficulty )
                @if($difficulty == $recipe->difficulty)
                    <option value="{{$recipe->difficulty}}" selected>{{$recipe->difficulty}}</option>
                @else
                    <option value="{{$difficulty}}">{{$difficulty}}</option>
                @endif
            @endforeach
        </select>
        
        <label for="categories">Categoria</label><br>
        <select class="form-control" id="categoriesSelector" name="categories[]" multiple>
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
        </select><br>

        <label for="categories">Ingredientes</label><br>
        <select class="form-control" id="ingredientsSelector" name="ingredients[]" multiple>
            @foreach($recipe->ingredients as $ingredient)
                <option value="{{$ingredient->id}}" selected>
                    {{$ingredient->name}}
                </option>
            @endforeach
        </select><br>

        <label for="body">Descripción</label><br>
        <textarea class="form-control" name="body" cols="30" rows="10">{{$recipe->body}}</textarea><br>

        @unless( !$recipe->featured_image )
            <img style="max-height: 200px;" src="/uploads/featured/{{$recipe->featured_image}}" alt="{{$recipe->title}}"><br>
        @endunless
        <label for="featured_image">Imágen destacada</label> <br>
        <input name="featured_image" class="form-control" type="file" value="{{ $recipe->featured_image }}"><br>

        <input type="submit">
    {!! Form::close() !!}

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