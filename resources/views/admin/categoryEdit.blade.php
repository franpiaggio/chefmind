@extends('layouts.webLayout')
@section('title', 'Admin')
@section('content')
    <h1>{{$cat->name}}</h1>
    {!! Form::model($cat, ['method' => 'PATCH','url' => '/admin/categoria/' . $cat->id, 'enctype' => 'multipart/form-data']) !!}
        <label for="name">Nombre</label>
        <input type="text" name="name" class="form-control" value="{{$cat->name}}">
        <label for="img">Imágen</label>
        <input class="form-control" name="img" type="file">
        <img src="/uploads/categorias/{{$cat->img}}" alt="" style="max-width: 500px"> <br>
        <input type="submit">
    {!! Form::close() !!}
    <div>
        @if($errors->any())
            <pre> {{var_dump($errors)}} </pre>
        @endif
    </div>
@endsection