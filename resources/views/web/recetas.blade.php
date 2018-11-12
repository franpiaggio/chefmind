@extends('layouts.webLayout')
@section('title', 'Todas las recetas')
@section('content')
    <div class="container">
    <h1>Recetas</h1>
    <div class="row">
        @foreach($recipes as $recipe)
            <div class="col-md-4 my-3">
                <div class="card" style="width: 18rem;">
                    @unless( !$recipe->featured_image )
                        <img class="card-img-top" src="/uploads/featured/{{$recipe->featured_image}}" alt="{{$recipe->title}}">
                    @endunless
                    <div class="card-body">
                        <h5 class="card-title">{{ $recipe->title }}</h5>
                        <p class="card-text">{{ $recipe->textpreview }}</p>
                        <p>Likes: <span id="recetaLike{{$recipe->id}}">{{ $recipe->likers()->get()->count() }}</span> </p>
                        @auth
                            <p class="js-like" data-id="{{ $recipe->id }}"> 
                                    {{ auth()->user()->hasLiked($recipe) ? 'Quitar like' : 'Dar like' }}
                            </p>
                        @endauth
                        <a href="{{ url('/recetas', $recipe->id) }}" class="btn btn-primary">Ver receta</a>
                    </div>
                </div>
            </div>
        @endforeach
        @section('footer')
            <script>
                $(document).ready(function(){
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $(".js-like").click(function(){
                        var clicked = $(this);
                        var id = $(this).data('id');
                        var number = $('#recetaLike'+id);

                        $.ajax({
                            type:'POST',
                                url:'/likeReceta',
                                data:{id:id},
                                success:function(data){
                                    if(jQuery.isEmptyObject(data.success.attached)){
                                        number.html(parseInt(number.text())-1);
                                        clicked.html("Dar like");
                                    }else{
                                        number.html(parseInt(number.text())+1);
                                        clicked.html("Quitar like");
                                    }
                                }
                            });
                    });
                });
            </script>
        @endsection
    </div>
    {{$recipes->links()}}
    </div>
@endsection 