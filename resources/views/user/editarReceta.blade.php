@extends('layouts.webLayout')
@section('title', 'Todas las recetas')
@section('content')
    <h1>Editar: {{ $recipe->title }}</h1>

    {!! Form::model($recipe, ['method' => 'PATCH','url' => 'recetas/' . $recipe->id]) !!}
        <label for="title">Nombre</label><br>
        <input class="form-control" type="text" name="title" value="{{$recipe->title}}"><br>
        
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

        <label for="body">Descripción</label><br>
        <textarea class="form-control" name="body" cols="30" rows="10">{{$recipe->body}}</textarea><br>

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
        </script>
    @endsection

@endsection 