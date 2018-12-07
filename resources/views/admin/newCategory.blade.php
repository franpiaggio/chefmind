@extends('layouts.webLayout')
@section('title', 'Admin')
@section('content')
    <div class="container">
        <h1>Nueva categoría</h1>
        <form method="POST" action="/admin/categorias/nueva" enctype="multipart/form-data">
            @csrf
            <label for="name">Nombre</label>
            <input type="text" name="name" class="form-control" value="{{old('name')}}">
            {{-- 
            <label for="img">Imágen</label>
            <input class="form-control" name="img" type="file">
            --}}
            <input type="submit">
        </form>
        <div>
            @if($errors->any())
                <pre> {{var_dump($errors)}} </pre>
            @endif
        </div>
    </div>
@endsection