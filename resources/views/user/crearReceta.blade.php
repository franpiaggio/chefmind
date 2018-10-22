@extends('layouts.webLayout')
@section('title', 'Crear recetas')
@section('content')
    <h1>Crear una receta</h1>
    <form method="POST" action="/recetas">
        @csrf
        <label for="title">Nombre</label><br>
        <input class="form-control" type="text" name="title"><br>
        
        <label for="categories">Categoria</label><br>
        <select class="form-control" id="categoriesSelector" name="categories[]" multiple>
            @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select><br>

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
        </script>
    @endsection
@endsection 