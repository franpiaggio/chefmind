$(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.js-follow').click(function(){
        var clicked = $(this);
        var id = $(this).data('id');
        $.ajax({
            type:'POST',
                url:'/followUser',
                data:{id:id},
                success:function(data){
                    if(jQuery.isEmptyObject(data.success.attached)){
                        clicked.html('<i class="fas fa-user-plus"></i> Seguir');
                    }else{
                        clicked.html('<i class="fas fa-user-minus"></i> Dejar de seguir');
                    }
                }
        });
    });
});