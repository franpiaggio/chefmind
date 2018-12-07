@foreach($recipes as $recipe)
<div class="col-md-4 col-12 mb-3 col-6 small-card">
    <div class="card">
        @unless( !$recipe->featured_image )
        <a class="img-link" href="{{ url('/recetas', $recipe->id) }}">
            <img class="card-img-top" src="/uploads/featured/{{$recipe->featured_image}}" alt="{{$recipe->title}}">
        </a>            
            <div class="icons ml-auto d-flex" id="recetaLike{{$recipe->id}}" >
                <div class="d-flex">
                    <div data-id="{{ $recipe->id }}" class="like-receta d-flex {{auth()->user() ? 'js-like' : ''}}">
                        <div class="icon-count mr-1">
                            <span> {{ $recipe->likers()->get()->count() }} </span>	
                        </div>
                        <div class="like-icons">
                            @if( auth()->user() && auth()->user()->hasLiked($recipe)) 
                                <i class="fas fa-thumbs-up"></i>
                            @else
                                <i class="far fa-thumbs-up"></i>
                            @endif
                        </div>
                    </div>
                    <div class="js-fav ml-3" data-id="{{ $recipe->id }}">
                        @if(auth()->user())
                            @if(auth()->user()->hasFavorited($recipe))
                                <i class="fas fa-heart"></i>
                            @else
                                <i class="far fa-heart"></i>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        @endunless
        <div class="card-body">
            <div class="recipe-rate listado stars mt-2 rate-{{(int)$recipe->averageRating}}">
                <span data-rate="1" class="js-rate fa fa-star"></span>
                <span data-rate="2" class="js-rate fa fa-star"></span>
                <span data-rate="3" class="js-rate fa fa-star"></span>
                <span data-rate="4" class="js-rate fa fa-star"></span>
                <span data-rate="5" class="js-rate fa fa-star"></span>
            </div>
            <h3 class="card-title"><a href="{{ url('/recetas', $recipe->id) }}">{{ $recipe->title }}</a></h3>
            <div class="recipe-info">
                <span>{{$recipe->textpreview}}</span>
            </div>
        </div>
        <div class="card-footer d-flex">
            <small class="text-muted">Por <a href="/perfil/{{$recipe->user->id}}" class="recipe-creator">{{$recipe->user->name}}</a></small>
            <a href="{{ url('/recetas', $recipe->id) }}" class="card-link"><i class="fas fa-plus"></i> <span class="sr-only">Ver Receta</span></a>
        </div>
    </div>
</div>
@endforeach