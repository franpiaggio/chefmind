@extends('layouts.webLayout')
@section('title', 'Todas las recetas')
@section('content')
<main class="main-container">
    <section class="search-filter top-banner">
        <div class="container">
            <form method="GET" action="/buscar">
                <h1 class="lead">Ingredientes:</h1>
                <div class="form-row">
                    <div class="col-10 col-md-10 mb-2 mb-md-0 search-input">
                        <select id="ingredientsSelector"  name="ingredients[]" class="form-control form-control-lg js-ingredients d-none" multiple>
                            @if( Request::query('ingredients') )
                                @foreach(Request::query('ingredients') as $ingredient)
                                    <option value="{{$ingredient}}" selected>{{$ingredient}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-2 col-md-1 pl-0 search-btn">
                        <button type="submit" class="btn btn-block btn-lg btn-primary"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <section class="container mt-5 mb-5">
        @if(count($recipes))
            <h2>Resultados de búsqueda</h2>
            <hr>
            <div class="row mt-5 equal">
                @include('web.listadoRecetas', ['recipes' => $recipes])
            </div>
            {{$recipes->links()}}
        @else
            <div class="my-5 empty-results">
                <div class="alert alert-warning mt-3 mb-5" role="alert">
                    No se encontraron recetas con esos ingredientes. Intente ingresando los más prioritarios.
                </div>
            </div>
        @endif
    </section>
    @include('layouts.footer')
    @section('footer')
        <script src="{{ asset('js/home.js') }}"></script>
        <script src="{{ asset('js/recetas.js') }}"></script>
    @endsection
@endsection 