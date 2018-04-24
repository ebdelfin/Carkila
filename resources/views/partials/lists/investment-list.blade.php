<div class="form-group row">
    <div class="col-xs-2">
    </div>
    <div class="col-xs-5">
        <form action="{{ route('search_initial') }}" method="POST" class="d-flex search-form">
            {{ csrf_field() }}
            <div class="input-group" id="adv-search">
                <input type="text" name="search" class="form-control" placeholder="Search for Vehicles" />
                <div class="input-group-btn">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                    </div>
                </div>
            </div>

        </form>


    </div>
    <div class="col-xs-3">


        <div class="dropdown dropdown-lg">
            <button type="button" class="btn btn-twitch dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="glyphicon glyphicon-filter" aria-hidden="true"></span></button>

            <div class="dropdown-menu dropdown-menu-right" role="menu">

                <form class="form-horizontal" action="{{ route('search') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="contain">Make</label>
                        <input name="make" class="form-control" type="text" placeholder="Ex., Toyota, Mitsubishi, Honda"/>
                    </div>
                    <div class="form-group">
                        <label for="contain">Model</label>
                        <input name="model" class="form-control" type="text" placeholder="Ex., Vios, Mirage, Civic"/>
                    </div>
                    <div class="form-group">
                        <label for="contain">Type</label>
                        {!! Form::select('type', ['Sedan' => 'Sedan', 'Van' => 'Van', 'SUV' => 'SUV'], null, ['class' => 'form-control','placeholder' => 'Select Vehicle Type']); !!}
                    </div>


                    <div class="form-group">
                        <label for="contain">City</label>
                        {!! Form::select('city', ['Others' => 'Others', 'Caloocan City' => 'Caloocan', 'Las Pinas City' => 'Las Piñas', 'Makati City' => 'Makati', 'Malabon City' => 'Malabon', 'Mandaluyong City' => 'Mandaluyong',
                        'Manila City' => 'Manila', 'Marikina City' => 'Marikina', 'Muntinlupa City' => 'Muntinlupa', 'Navotas City' => 'Navotas', 'Paranaque City' => 'Parañaque', 'Pasay City' => 'Pasay', 'Pasig City' => 'Pasig', 'Pateros City' => 'Pateros',
                        'Quezon City' => 'Quezon City', 'San Juan City' => 'San Juan', 'Taguig City' => 'Taguig', 'Valenzuela City' => 'Valenzuela'], null, ['class' => 'form-control','placeholder' => 'Select City']); !!}
                    </div>
                    <div class="form-group">
                        <label for="contain">Price Range</label>
                        <div class="form-group row">
                            <div class="col-xs-5">
                                <label for="ex1">Min</label>
                                <input value = "" name="min" class="form-control" id="ex1" type="text">
                            </div>
                            <div class="col-xs-5">
                                <label for="ex2">Max</label>
                                <input value = ""  name="max" class="form-control" id="ex2" type="text">
                            </div>

                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                </form>
            </div>
        </div>

    </div>
    <div class="col-xs-2">
    </div>
</div>


<h3 class="page-header">Vehicle Listings</h3>

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

                                <h4>{{$post->make}} {{$post->model}} </h4>
                                <h5>₱{{$post->rental_rate}}</h5>
                                {{--<p>Model: {{$post->model}}</p>
                                <p>Rental Rate: {{$post->rental_rate}}</p>
                                <p>Address: {{DB::table('users')->select('address')->where('id', '=', (DB::table('vehicles')->select('user_id')->where('id', '=', $post->id))->implode('user_id'))->get()->implode('address')}}</p>
                                <p>City: {{DB::table('users')->select('city')->where('id', '=', (DB::table('vehicles')->select('user_id')->where('id', '=', $post->id))->implode('user_id'))->get()->implode('city')}}</p>
                                <p>Owner: <a href="{{ url('profile/'. DB::table('users')->select('name')->where('id',$post->user_id)->implode('name')) }}"> {{DB::table('users')->select('name')->where('id',$post->user_id)->implode('name')}}</a></p>--}}
                            </div>
                        </a>

                    </div>

                </div>
            @empty
                <p>No vehicles.</p>
            @endforelse

</div>

