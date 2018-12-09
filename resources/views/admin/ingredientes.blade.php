@extends('layouts.webLayout')
@section('title', 'Ingredientes')
@section('content')
<main class="main-container container-fluid mb-5">  
    <div class="row">
        <header class="col-md-12 admin-topbar top-banner">
            <div class="container">
                <h2>Administrador</h2>
            </div>
        </header>
        <div class="col-md-12 mt-5">
            <div class="container">
                <ul class="nav nav-tabs">
                  <li class="nav-item">
                    <a class="nav-link" href="/admin/usuarios">Usuarios</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/admin/recetas">Todas las recetas</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/admin/categorias">Categorías</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" href="/admin/ingredientes">Ingredientes</a>
                  </li>
                </ul>
            </div>
        </div>
        <section class="col-md-12 mt-3">
            <div class="container">
                @if($errors->any())
                    <div class="alert alert-warning mt-3 mb-3" role="alert">
                        {{$errors->first()}}
                    </div>
                @endif
                <div class="d-flex mt-3 mb-3 align-items-center">
                    <h2 class="mb-3">Ingredientes registrados</h2>
                    <button class="btn btn-primary ml-auto">Agregar nuevo</button>
                </div>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Recetas que lo usan</th>
                        <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($ingredients as $ingredient)
                    <tr>
                        <td>{{$ingredient->id}}</td>
                        <td>{{$ingredient->name}}</td>
                        <td>{{$ingredient->recipes->count()}}</td>
                        <td class="d-flex">
                            <button data-id="{{$ingredient->id}}" data-name="{{$ingredient->name}}" class="btn btn-outline-warning reasign-ingredient ml-3">Reasignar</button>
                            <button data-id="{{$ingredient->id}}" data-name="{{$ingredient->name}}" class="btn btn-outline-primary edit-ingredient ml-3">Editar nombre</button>
                            <a href="/admin/ingredientes/{{$ingredient->id}}/borrar" class="btn btn-danger ml-auto">Borrar</a>
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                {{$ingredients->links()}}
            </div>
        </section>
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar ingrediente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editForm" method="POST" action="#">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Nombre:</label>
                            <input type="text" class="form-control" id="old-name" disabled>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Nuevo nombre:</label>
                            <input type="text" placeholder="Ingresar nuevo valor" class="form-control" required id="new-name" name="name">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <input type="submit" class="btn btn-primary" value="Guardar cambio" >
                    </div>
                </form>
                </div>
            </div>
        </div> 
        <div class="modal fade" id="reasignModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Reasignar ingrediente</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="reasignForm" method="POST" action="#">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Nombre:</label>
                                <input type="text" class="form-control" id="old-name-reasign" disabled>
                            </div>
                            <div class="form-group select-reasign">
                                <label for="recipient-name" class="col-form-label">Reasignar a:</label>
                                <select id="ingredientsSelector" name="name" class="form-control js-ingredients" required>
                                </select>
                            </div>
                            <p class="text-danger">Todas las recetas que contengan este ingrediente se reasignaran al seleccionado.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <input type="submit" class="btn btn-primary" value="Guardar cambio" >
                        </div>
                    </form>
                    </div>
                </div>
            </div>     
    </div>
</main>
@include('layouts.footer')
<script>
    $(function(){
        $('.edit-ingredient').click(function(){
            var name = $(this).data('name');
            var id = $(this).data('id');
            $('#old-name').val(name);
            $('#editForm').attr('action', '/admin/ingredientes/'+id+'/editar');
            $('#editModal').modal();
        });
        $('.reasign-ingredient').click(function(){
            var name = $(this).data('name');
            var id = $(this).data('id');
            $('#old-name-reasign').val(name);
            $('#reasignForm').attr('action', '/admin/ingredientes/'+id+'/reasignar');
            $('#reasignModal').modal();
        });
        $("#ingredientsSelector").select2({
            language: "es",
            placeholder: 'Ingresa los ingredientes',
            minimumInputLength: 3,
            ajax: {
                dataType: 'json',
                url: '/api/ingredients',
                delay: 250,
                data: function(params){
                    return{
                        ingredient: params.term
                    }
                },
                processResults: function(data){
                    // Le cambio la propiedad que viene como "name" a "text"
                    var test = $.map(data, function (obj) {
                        obj.id =  obj.text || obj.name; 
                        obj.text = obj.text || obj.name;
                        return obj;
                    });
                    // Devuelvo un object con la propiedad results como espera el plugin
                    return {
                        results: test
                    }
                }
            },
            id: function(object) {
                return object.text;
            }
        });
    });
</script>
@endsection