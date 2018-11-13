@extends('layouts.webLayout')
@section('title', 'Todas las recetas')
@section('content')
    <div class="container">
    <h1>Editar: {{ $recipe->title }}</h1>

    {!! Form::model($recipe, ['method' => 'PATCH','url' => 'recetas/' . $recipe->id, 'enctype' => 'multipart/form-data', 'id'=>'enviar']) !!}
        <label for="title">Nombre</label><br>
        <input class="form-control" type="text" name="title" value="{{$recipe->title}}"><br>

        <label for="textpreview">Descripción corta</label>
        <textarea class="form-control" name="textpreview" cols="30" rows="2">{{ $recipe->textpreview}}</textarea><br>

        <label for="time">Tiempo estimado</label>
        <input type="text" class="form-control" name="time" value="{{$recipe->time}}">

        <label for="quantity">Cantidad de personas</label>
        <input type="number" class="form-control" name="quantity" value="{{$recipe->quantity}}">

        <label for="time">Dificultad</label>
        <select name="difficulty" class="form-control">
            @foreach( ['Fácil', 'Media', 'Difícil'] as $difficulty )
                @if($difficulty == $recipe->difficulty)
                    <option value="{{$recipe->difficulty}}" selected>{{$recipe->difficulty}}</option>
                @else
                    <option value="{{$difficulty}}">{{$difficulty}}</option>
                @endif
            @endforeach
        </select>
        
        <label for="categories">Categoria</label><br>
        <select class="form-control" id="categoriesSelector" name="categories[]" multiple>
            @foreach($categories as $category)
                <option 
                    value="{{$category->id}}" 
                    @foreach( $recipe->categories as $selected ) 
                        @if( $selected->id == $category->id ) 
                            selected="selected"
                        @endif
                    @endforeach
                >
                    {{$category->name}}
                </option>
            @endforeach
        </select><br>

        <label for="categories">Ingredientes</label><br>
        <select class="form-control" id="ingredientsSelector" name="ingredients[]" multiple>
            @foreach($recipe->ingredients as $ingredient)
                <option value="{{$ingredient->id}}" selected>
                    {{$ingredient->name}}
                </option>
            @endforeach
        </select><br>

        <label for="body">Descripción</label><br>
        <input name="body" type="hidden" value="{{$recipe->body}}">
        <div id="editor-container"></div>

        @unless( !$recipe->featured_image )
            <img style="max-height: 200px;" src="/uploads/featured/{{$recipe->featured_image}}" alt="{{$recipe->title}}"><br>
        @endunless

        <label for="featured_image">Imágen destacada</label> <br>
        <input name="featured_image" class="form-control" type="file" value="{{ $recipe->featured_image }}"><br>

        <hr>
        <label for="images[]">Galería</label> <br>
        <input name="images[]" class="form-control" type="file" multiple><br>

        <br><br><br>
        @if( $recipe->images()->get() )
            <div class="row">
                @foreach( $recipe->images()->get() as $image )
                    <div class="col-md-3 js-borrar-foto" id="imagen{{$image->id}}" data-id="{{$image->id}}">
                        <img style="max-width: 100%;" src="/uploads/imagenes/{{$image->name}}" alt="">
                    </div>
                @endforeach
            </div>
        @endif

        <input type="submit">
        <br><br>
    {!! Form::close() !!}

    <!-- Errores del server -->
    <div>
        @if($errors->any())
            <pre> {{var_dump($errors)}} </pre>
        @endif
    </div>
    @section('footer')
        <script>
            $(document).ready(function(){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $("#categoriesSelector").select2({
                    placeholder:'Seleccionar categoría'
                });
                $("#ingredientsSelector").select2({
                    language: "es",
                    placeholder: 'Ingresa los ingredientes',
                    minimumInputLength: 3,
                    tags: true,
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
                $(".js-borrar-foto").click(function(){
                    var clicked = $(this);
                    var id = $(this).data('id');
                    $.ajax({
                        type:'POST',
                        url:'/borrarFoto',
                        data:{id:id},
                        success:function(data){
                            clicked.remove();
                        }
                    });
                });
                var quill = new Quill('#editor-container', {
                    modules: {
                        toolbar: [
                            [{ header: [1, 2, false] }],
                            ['bold', 'italic', 'underline', 'link'],
                            ['image'],
                            [{ list: 'ordered' }]
                        ]
                    },
                    placeholder: 'Describinos tu receta',
                    theme: 'snow'
                });
                var form = document.querySelector('#enviar');
                var oldEditor = JSON.parse(document.querySelector('input[name=body]').value).ops;
                var ops = [];
                oldEditor.forEach(function(line) {
                    ops.push(line)
                });
                quill.setContents(ops, 'old');  
                form.onsubmit = function() {
                    alert("Enviar");
                    var body = document.querySelector('input[name=body]');
                    body.value = JSON.stringify(quill.getContents());  
                };
            });
        </script>
    </div>
    @endsection

@endsection 