@extends('layouts.webLayout')
@section('title', 'Home')
@section('content')
<main class="main-container">
    <section class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">Hola!</h1>
            <p class="lead">Bienvenido a Chefmind</p>
            <hr class="my-4">
            <p>Ingresá los ingredientes que tenes disponibles:</p>
            <form  method="GET" action="/buscar">
                <div class="form-row">
                    <div class="col-12 col-md-10 mb-2 mb-md-0">
                        <select id="ingredientsSelector" name="ingredients[]" class="form-control form-control-lg js-ingredients" multiple>

                        </select>
                        <div>
                            @if($errors->any())
                                <pre> {{var_dump($errors)}} </pre>
                            @endif
                        </div>
                    </div>
                    <div class="col-12 col-md-2">
                        <input type="submit" class="btn btn-block btn-lg btn-primary" value="Buscar" />
                    </div>
                </div>
            </form>
        </div>
    </section>
    <section class="container mt-5">
        <h2>Últimas recetas</h2>
        <div class="row mt-5 equal">

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