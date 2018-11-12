@extends('layouts.webLayout')
@section('title', 'Home')
@section('content')
    <div class="container mt-5">
        <h1>Home</h1>
        <label for="categories">Ingredientes</label><br>
        <form method="POST" action="/buscar">
            @csrf
            <select class="form-control" name="ingredients[]" id="ingredientsSelector" multiple><br>
                {{-- Si hay valores viejos los agrego --}}
                @if( old('ingredients') )
                    @foreach(old('ingredients') as $ingredient)
                        <option value="{{$ingredient}}" selected>{{$ingredient}}</option>
                    @endforeach
                @endif
            </select>
            <input type="submit" class="btn btn-primary">
            <div>
                @if($errors->any())
                    <pre> {{var_dump($errors)}} </pre>
                @endif
            </div>
        </form>
        @section('footer')
            <script>
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
    </div>
@endsection 