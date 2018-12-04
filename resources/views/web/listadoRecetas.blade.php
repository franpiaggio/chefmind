@foreach($recipes as $recipe)
<div class="col-md-4 col-sm-6 mb-3 small-card">
    <div class="card">
        @unless( !$recipe->featured_image )
            <img class="card-img-top" src="/uploads/featured/{{$recipe->featured_image}}" alt="{{$recipe->title}}">            
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
            <span class="recipe-rate">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="far fa-star"></i>
                <i class="far fa-star"></i>
            </span>
            <h3 class="card-title">{{ $recipe->title }}</h3>
            <div class="recipe-info">
                <span>{{$recipe->textpreview}}</span>
                {{-- 
                <span> <i class="far fa-clock"></i> {{ $recipe->time ? $recipe->time : 'No especificado' }} min</span>
                <span> <img src="/svg/chefs.svg" /> {{ $recipe->difficulty ? $recipe->difficulty : 'No especificado' }} </span>
                <span> <i class="far fa-user"></i>{{ $recipe->quantity ? $recipe->quantity : 'No especificado' }}  {{$recipe->quantity && $recipe->quantity == 1 ? 'persona' : 'personas'}}  </span>
                --}}
            </div>
        </div>
        <div class="card-footer d-flex">
            <small class="text-muted">Por <a href="/perfil/{{$recipe->user->id}}" class="recipe-creator">{{$recipe->user->name}}</a></small>
            <a href="{{ url('/recetas', $recipe->id) }}" class="card-link"><i class="fas fa-plus"></i> <span class="sr-only">Ver Receta</span></a>
        </div>
    </div>
</div>
@endforeach