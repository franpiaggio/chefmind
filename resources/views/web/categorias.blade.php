@extends('layouts.webLayout')
@section('title', 'Categorias')
@section('content')
@if(Auth::check())
    @if(Auth::user()->hasRole('user'))
        <h1>Recomendá una categoría</h1>
        <p>Esto solo se ve si estás logeado</p>
        <form method="POST" action="/categoria" enctype="multipart/form-data">
            @csrf
            <label for="name">Nombre</label>
            <input type="text" name="name" class="form-control" value="{{old('name')}}">
            <label for="img">Imágen</label>
            <input class="form-control" name="img" type="file">
            <input type="submit">
        </form>
        <div>
            @if($errors->any())
                <pre> {{var_dump($errors)}} </pre>
            @endif
        </div>
    @endif
@endif
    @foreach($categories as $category)
        <div>
            <p>{{$category->name}}</p>
            @if($category->img)
                <img src="/uploads/categorias/{{$category->img}}" alt="{{$category->name}}" style="max-width: 300px">
            @endif
            <br>
            <a href="/categoria/{{$category->id}}">Ver recetas</a>
        </div><hr>
    @endforeach
    {{$categories->links()}}
@endsection 