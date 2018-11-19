$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // Maneja likes
    $(".js-like").click(function(){
        var clicked = $(this);
        var id = $(this).data('id');
        var number = $('#recetaLike'+id).find('.icon-count');
        $.ajax({
            type:'POST',
                url:'/likeReceta',
                data:{id:id},
                success:function(data){
                    if(jQuery.isEmptyObject(data.success.attached)){
                        number.html(parseInt(number.text())-1);
                        clicked.find('.like-icons').html('<i class="far fa-thumbs-up"></i>');
                    }else{
                        number.html(parseInt(number.text())+1);
                        clicked.find('.like-icons').html('<i class="fas fa-thumbs-up"></i>');
                    }
                }
        });
    });
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
                        clicked.html('<i class="far fa-heart"></i>');
                    }else{
                        clicked.html('<i class="fas fa-heart"></i>');
                    }
                }
        });
    });
});