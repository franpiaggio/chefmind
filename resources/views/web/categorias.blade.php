@extends('layouts.webLayout')
@section('title', 'Categorias')
@section('content')
<div class="container-fluid">
    <div class="container mt-5">
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
        <div class="row">
            @foreach($categories as $category)
                <div class="col-md-4 mb-3">
                    <!-- Card -->
                    <div class="card card-cascade wider reverse">
                        <!-- Card image -->
                        <div class="view view-cascade overlay">
                            @if($category->img)
                                <img class="card-img-top" src="/uploads/categorias/{{$category->img}}" alt="{{$category->name}}">
                            @endif
                            <a href="/categoria/{{$category->id}}">
                                <div class="mask rgba-white-slight"></div>
                            </a>
                        </div>

                        <!-- Card content -->
                        <div class="card-body card-body-cascade text-center">
                    
                            <!-- Title -->
                            <h4 class="card-title"><strong>{{$category->name}}</strong></h4>
                            <!-- Subtitle -->
                            <a href="/categoria/{{$category->id}} class="font-weight-bold indigo-text py-2">Ver recetas</a>                    
                    </div>
                    
                    </div>
                    <!-- Card -->
                </div>
            @endforeach
        </div>
        {{$categories->links()}}
    </div>
</div>
@endsection 