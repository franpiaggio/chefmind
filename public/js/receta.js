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
    $('.js-rate').click(function(){
        var id = $(this).parent().data('id');
        var rate = $(this).data('rate');
        $.ajax({
            type:'POST',
                url:'/rateReceta',
                data:{id:id, rate: rate},
                success:function(data){
                    if(data.success){
                        $('.stars').removeClass('rate-1 rate-2 rate-3 rate-4 rate-5');
                        $('.stars').addClass('rate-'+rate);
                        $('.average').text(parseFloat(data.success).toFixed(2));
                    }else{
                        console.log(data);
                    }
                }
        });
    });
});