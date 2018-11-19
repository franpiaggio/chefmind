@foreach($recipes as $recipe)
<div class="col-md-4 mb-3">
    <div class="card">
        @unless( !$recipe->featured_image )
            <img class="card-img-top" src="/uploads/featured/{{$recipe->featured_image}}" alt="{{$recipe->title}}">
        @endunless
        <div class="card-body">
            <h3 class="card-title">{{ $recipe->title }}</h3>
            <p class="card-text">{{ $recipe->textpreview }}</p>
            <a href="{{ url('/recetas', $recipe->id) }}" class="card-link">Ver Receta</a>
        </div>
        <div class="card-footer d-flex">
            <small class="text-muted">Creada por <a href="#">{{$recipe->user->name}}</a></small>
            <div class="icons ml-auto d-flex" id="recetaLike{{$recipe->id}}" >
                <div data-id="{{ $recipe->id }}" class="like-receta d-flex {{auth()->user() ? 'js-like' : ''}}">
                    <div class="icon-count mr-1">
                        {{ $recipe->likers()->get()->count() }}	
                    </div>
                    <div class="like-icons">
                        @if( auth()->user() && auth()->user()->hasLiked($recipe)) 
                            <i class="fas fa-thumbs-up"></i>
                        @else
                            <i class="far fa-thumbs-up"></i>
                        @endif
                    </div>
                </div>
                <p class="js-fav ml-3" data-id="{{ $recipe->id }}">
                    @if(auth()->user())
                        @if(auth()->user()->hasFavorited($recipe))
                            <i class="fas fa-heart"></i>
                        @else
                            <i class="far fa-heart"></i>
                        @endif
                    @endif
                </p>
            </div>
        </div>
    </div>
</div>
@endforeach