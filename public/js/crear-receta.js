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
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $(".js-preload-input").change(function() {
        readURL(this);
    });

    /*
    $("#drop-area").dmUploader({
        url: '#',
        allowedTypes: "image/*",		  
        onInit: function(){
            console.log('Init');
        },
        onNewFile: function(id, file){
            if (typeof FileReader !== 'undefined'){
            var reader = new FileReader();
            var img = $('.js-drop-image');  
            reader.onload = function (e) {
                img.attr('src', e.target.result);
                $('.js-img-container').append(img);
                $('.js-img-container img').removeClass('d-none');
                $('.js-img-container i').addClass('d-none');
                $(".custom-file-label").text("Imagen cargada");
            }

            reader.readAsDataURL(file);
            }
        }
    });
    */
    // Activo el editor WYSIWYG
    var quill = new Quill('#editor-container', {
        modules: {
            toolbar: [
                [{ header: [1, 2, false] }],
                ['bold', 'italic', 'underline', 'link'],
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
    form.onsubmit = function() {
        alert("Envio")
        var body = document.querySelector('input[name=body]');
        body.value = JSON.stringify(quill.getContents());  
    };
});