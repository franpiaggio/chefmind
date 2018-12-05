$(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // Lo que viene escapado lo inserto como html
    $("#body").html( $("#body").text() );
    // Favs
    // Maneja Favoritos
    $(".js-fav").click(function(){
        var clicked = $(this);
        var id = $(this).data('id');
        $.ajax({
            type:'POST',
                url:'/favReceta',
                data:{id:id},
                success:function(data){
                    if(jQuery.isEmptyObject(data.success.attached)){
                        clicked.html('<i class="far fa-heart"></i> Agregar a favoritos');
                    }else{
                        clicked.html('<i class="fas fa-heart"></i> En mis favoritos');
                    }
                }
        });
    });
});