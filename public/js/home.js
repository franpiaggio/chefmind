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
// Verifico que la sección activa sea la home. Si es le agrega una clase al body para aplicar el background 
$(function(){
    if($('main').hasClass('index-section')){
        $('body').addClass('home');
    }
});