@extends('layouts.webLayout')
@section('title', 'Chefmind - Buscá tu receta')
@section('content')
<main class="main-container index-section">
    <section class="jumbotron jumbotron-fluid search-cont">
        <div class="container">
            <h1 class="display-4 text-center">Encontrá tu <span>receta</span> </h1>
            <p class="lead text-center search-desc">¿Tenés los ingredientes pero no sabés qué cocinar? <br /> <span>Escribilos en este buscador</span> y vas a poder resolverlo!</p>
            <!--p class="mt-4 offset-md-1">Ingresá los ingredientes que tenes disponibles:</p-->            
            <form class="mb-2 mt-4" method="GET" action="/buscar">
                <div class="form-row">
                    <div class="col-12 col-md-8 offset-md-1 mb-2 mb-md-0 search-input">
                        <select id="ingredientsSelector" name="ingredients[]" class="form-control form-control-lg js-ingredients d-none" multiple>
                        </select>
                    </div>
                    <div class="col-12 col-md-1 search-btn">
                        <input type="submit" class="btn btn-block btn-lg btn-filled" value="Buscar" />
                    </div>
                </div>
            </form>
            <small class="offset-md-1">¿Buscás algo muy específico? <a href="/categorias">Ingresá aquí</a></small>
        </div>
    </section>
    <section class="container mt-5">
        <h2 class="mb-3 pt-4">Últimas recetas</h2>
        <!--div class="row mt-5 equal"-->
        </div>
        <div class="row">
            @include('web.listadoRecetas', ['recipes' => $latests])
        </div>
    </section>
    @include('layouts.footer')
    @section('footer')
        <script src="{{ asset('js/home.js') }}"></script>
        <script src="{{ asset('js/recetas.js') }}"></script>
    @endsection
</main>
@endsection 