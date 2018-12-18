$(document).ready(function(){
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

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('.js-drop-image').attr('src', e.target.result);
                $('.icon').remove();
                $('.js-drop-image').removeClass('d-none');
                $('.js-file-label').text($(input).val().split('\\').pop())
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $(".js-preload-input").change(function() {
        readURL(this);
    });

    $('.img-container').click(function(){
        $('.js-preload-input').trigger('click');
    });

    // Activo el editor WYSIWYG
    var quill = new Quill('#editor-container', {
        modules: {
            toolbar: [
                [{ header: [1, 2, false] }],
                ['bold', 'italic', 'underline'],
                [{ list: 'ordered' }]
            ]
        },
        placeholder: 'Describinos tu receta',
        theme: 'snow'
    });
    // Formulario
    var form = document.querySelector('#enviar');
    // Antes de enviar los datos le asigno al input con el name correct un JSON pasado a string
    // Luego el server guarda y parsea
    form.onsubmit = function(e) {
        var body = document.querySelector('#bodyInput');
        body.value = JSON.stringify(quill.getContents());
        localStorage.removeItem('ingredients');
    };


    $("#ingredientsSelector").select2({
        language: "es",
        placeholder: 'Ingresar un ingrediente',
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
    
    if(localStorage.getItem("ingredients") !== null){
        var added = localStorage.getItem("ingredients");
        $('.added').append(added);
    }

    var saveLocalData = function(){
        var added = $('.added').html();
        localStorage.setItem('ingredients', added);
    }

    $('.js-agregar-ingrediente').click(function(){

        var name = $("#ingredientsSelector").val();
        var quantity = $('#ingredientQuantity').val();

        if(!name){
            $('.js-ing-vacio').removeClass('d-none');
            $('.js-ing-vacio').addClass('d-block');
            return false;
        }else{
            $('.js-ing-vacio').addClass('d-none');
            $('.js-ing-vacio').removeClass('d-block');
        }

        $('.multi-ingredient-selector .select2-selection__rendered').html('Ingresar un ingrediente');
        $("#ingredientsSelector").val('');
        $('#ingredientQuantity').val('');

        var p = $('<p class="form-control disabled">'+name+'</p>');
        var inputName = $('<input class="form-control" value="'+name+'"hidden type="text" />').val(name).attr('name', 'ingredients[]');
        var inputquantity = $('<input class="form-control" name="ingQuantity[]" value="'+quantity+'"  type="text" />').val(quantity);

        var col1 = $('<div class="col-md-5 mt-3"></div>').append(p);
        var col2 = $('<div class="col-md-5 mt-3"></div>').append(inputquantity);
        var deleteBtn = $('<div class="col-md-2 mt-3"> <button type="button" class="btn btn-danger w-100 js-delete-ingredient"> Borrar </button> </div>');

        $('.added').append(inputName);
        $('.added').append(col1);
        $('.added').append(col2);
        $('.added').append(deleteBtn);

        saveLocalData();

    });

    $('.added').on('click', '.js-delete-ingredient', function(){
        $(this).parent().prev().prev().remove();
        $(this).parent().prev().remove();
        $(this).parent().remove();
        saveLocalData();
    });

});