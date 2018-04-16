<h3 class="page-header">Investments</h3>

<div id="investment-list" class="row">
            @forelse ($posts as $post)
                <div class="investment-item col-md-4">

                    <div class="investment-item-panel">

                        <a href="/vehicle/{{$post->id}}">
                            <div class="investment-item-header" style="background-image: url({{$post->image}})"></div>

                            <div class="investment-item-body">
                                <h2 class="investment-item-title">{{$post->title}}</h2>
                                <div class="rating" style="pointer-events: none;">
                                    <?php /*
                                        <input id="input-1" class="rating rating-loading" data-min="0" data-max="5" data-step="1" value="{{ $post->averageRating }}" data-size="xs">
                                        <small>({{ $post->countRating() }})
                                            @if ($post->countRating() > 1)
                                                Ratings
                                            @else
                                                Rating
                                            @endif
                                        </small>
                                    */ ?>

                                </div>
                                <p>Model: {{$post->model}}</p>
                                <p>Rental Rate: {{$post->rental_rate}}</p>
                                <p>Address: {{$address}}</p>
                            </div>
                        </a>

                    </div>

                </div>
            @empty
                <p>No investment.</p>
            @endforelse

</div>

<div class="text-center">
    {!! $posts->links() !!}
</div>
