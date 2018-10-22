@extends('layouts.webLayout')
@section('title', 'Crear recetas')
@section('content')
    <h1>Crear una receta</h1>
    <form method="POST" action="/recetas">
        @csrf
        
        <label for="title">Nombre</label><br>
        <input class="form-control" type="text" name="title"><br>
        {{-- Categorias El server trae todas --}}
        <label for="categories">Categoria</label><br>
        <select class="form-control" id="categoriesSelector" name="categories[]" multiple>
            @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select><br>
        {{-- Ingredientes: se buscan con la api api --}}
        <label for="categories">Ingredientes</label><br>
        <select class="form-control" name="ingredients[]" id="ingredientsSelector" multiple><br>

        </select>
        <label for="body">Descripción</label><br>
        <textarea class="form-control" name="body" cols="30" rows="10"></textarea><br>

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