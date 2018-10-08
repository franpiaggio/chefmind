@extends('layouts.webLayout')
@section('title', 'Todas las recetas')
@section('content')
    <h1>Crear una receta</h1>
    <!-- Formulario de laravel -->
    {!! Form::open(['url' => 'recetas']) !!}
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