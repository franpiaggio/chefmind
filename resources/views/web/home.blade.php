@extends('layouts.webLayout')
@section('title', 'Chefmind - Buscá tu receta')
@section('content')
<main class="main-container index-section">
    <section class="search-cont">
        <div class="container mb-3">
            <h1 class="display-4 text-center">Encontrá tu <span>receta</span> </h1>
            <p class="lead text-center search-desc">¿Tenés los ingredientes pero no sabés qué cocinar? <br /> <span>Escribilos en este buscador</span> y vas a poder resolverlo!</p>          
            <form class="mb-2 mt-4" method="GET" action="/buscar">
                <div class="form-row">
                    <div class="col-12 col-md-8 offset-md-1 mb-2 mb-md-0 search-input">
                        <select id="ingredientsSelector" name="ingredients[]" class="form-control form-control-lg js-ingredients d-none" multiple>
                        </select>
                    </div>
                    <div class="col-12 col-md-1 search-btn">
                        <input type="submit" class="btn btn-block btn-lg btn-filled" value="" />
                    </div>
                </div>
            </form>
            <small class="offset-md-1">¿Buscás una receta en especial?<a href="/categorias" class="ml-1">Ingresá aquí</a></small>
        </div>
    </section>
    <section class="container mb-5">
        <h2 class="mb-3">Últimas recetas</h2>
        <div class="row">
            @include('web.listadoRecetas', ['recipes' => $latests])
        </div>
    </section>
    @include('layouts.footer')
    @section('footer')
        <script src="{{ asset('js/home.js') }}"></script>
        <script src="{{ asset('js/recetas.js') }}"></script>
        <script src="{{asset('js/nav.js')}}"></script>
    @endsection
    <script>

    </script>
</main>
@endsection 