@extends('layouts.webLayout')
@section('title', 'Chefmind - Buscá tu receta')
@section('content')
<main class="main-container index-section">
    <section class="search-cont">
        <div class="container mb-3 d-flex flex-column">
            <img src="/svg/logo-xl.svg" alt="logo-xl" class="logo-xl my-2" />
            <h1 class="display-4 text-center">Encontrá tu receta</h1>
            <p class="lead text-center search-desc">Escribí los ingredientes en el buscador</p>          
            <form class="mb-2 mt-4" method="GET" action="/buscar">
                <div class="form-row justify-content-center">
                    <div class="col-10 col-md-8 mb-2 mb-md-0 search-input">
                        <select id="ingredientsSelector" name="ingredients[]" class="form-control form-control-lg js-ingredients d-none" multiple>
                        </select>
                    </div>
                    <div class="col-2 col-md-1 search-btn">
                        <input type="submit" class="btn btn-block" value="" />
                    </div>
                    <div class="col-md-9 col-md-1 mt-2 justify-content-center">
                        <small class="">¿Buscás una receta en especial?<a href="/categorias" class="ml-1">Ingresá aquí</a></small>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <section class="container mb-5 mt-3">
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