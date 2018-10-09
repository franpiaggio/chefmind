@extends('layouts.webLayout')
@section('title', 'Todas las recetas')
@section('content')
    <h1>Editar: {{ $recipe->title }}</h1>
    <!-- Formulario de laravel -->
    {!! Form::model($recipe, ['method' => 'PATCH','url' => 'recetas/' . $recipe->id]) !!}
        <div>
            {!! Form::label('title', 'Nombre') !!} <br>
            {!! Form::text('title') !!}
        </div>
        <div>
            {!! Form::label('body', 'Descripción') !!}<br>
            {!! Form::textarea('body') !!} 
        </div>
        <div>
            {!! Form::submit('Crear receta') !!}
        </div>
    {!! Form::close() !!}
    <!-- Errores del server -->
    <div>
        @if($errors->any())
            <pre> {{var_dump($errors)}} </pre>
        @endif
    </div>
@endsection 