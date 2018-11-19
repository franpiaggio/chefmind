@extends('layouts.webLayout')
@section('title', 'Todas las recetas')
@section('content')
<main class="main-container">
    <section class="search-filter">
        <div class="container">
            <form method="GET" action="/buscar" class="container">
                <h1 class="lead">Ingredientes:</h1>
                <div class="form-row">
                    <div class="col-12 col-md-10 mb-2 mb-md-0">
                        <select id="ingredientsSelector"  name="ingredients[]" class="form-control form-control-lg js-ingredients" multiple>
                            @if( $names )
                                @foreach($names as $ingredient)
                                    <option value="{{$ingredient}}" selected>{{$ingredient}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-12 col-md-2">
                        <button type="submit" class="btn btn-block btn-lg btn-primary">Buscar</button>
                    </div>
                </div>
            </form>
            {{$recipes->links()}}
        </div>
    </section>
    <section class="container mt-5">
            <h2>Resultados de búsqueda</h2>
            <hr>
            <div class="row mt-5 equal">
                <div class="row">
                    @include('web.listadoRecetas', ['recipes' => $recipes])
                </div>
            </div>
    </section>
    @include('layouts.footer')
    @section('footer')
        <script src="{{ asset('js/home.js') }}"></script>
        <script src="{{ asset('js/recetas.js') }}"></script>
    @endsection
@endsection 