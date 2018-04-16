@extends('layouts.app')

@section('template_linked_css')
    <link rel="stylesheet" href="{{ asset('css/rating/star-rating.min.css') }}" />


    <style>

        #post-featured-image {
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        #post-featured-image:hover {opacity: 0.7;}

        #gallery-images {
            white-space: nowrap;
            overflow-y: scroll;
            width: 300px;
        }

        .investment-gallery-image {
            width: 100%;
        }

    </style>
@endsection

@section('content')
    <div class="panel panel-body">
        <div class="panel-heading">


            <div class="d-flex" style="height: 500px;">

                <a href="{{ $vehicle->image }}" data-lightbox="featured-image" style="width: 70%">
                    <div id="post-featured-image" data-src="{{ $vehicle->image }}"   style="width: 70%;
                            height: 500px;
                            background-image: url({{ $vehicle->image }});
                            background-size: contain;
                            background-repeat: no-repeat;
                            background-position: center;">

                    </div>
                </a>


            </div>
            <div class="panel-body">
                <h3>{{$vehicle->make}} {{$vehicle->model}} {{$vehicle->year}}</h3>
                <h3>Capacity: {{$vehicle->seating_capacity}}</h3>
                <h1>Rental Rate: {{$vehicle->rental_rate}}</h1>
                <h3>Address: {{$address}}</h3>



            </div>


            @if(Auth::check())
                @if(Auth::user()->id == $vehicle->user_id)
                    <a href="/vehicle/{{$vehicle->id}}/edit" class="btn btn-default">Edit</a>

                    {!!Form::open(['action' => ['VehicleController@destroy', $vehicle->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                    {{Form::hidden('_method', 'DELETE')}}
                    {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                    {!!Form::close()!!}
                @endif
            @endif

        <!--Messaging-->
            @if (Auth::check())
                @if(Auth::user()->hasRole('renter'))


                    <div class="container">
                        <a href="{{ route('booking.create_request', ['owner_id' => $vehicle->user_id, 'vehicle' => $vehicle->id])  }}" class="btn btn-primary">
                            Book this vehicle now!
                        </a>
                    </div>
                <p></p>
                        <div class="container">
                                <a href="{{ route('messages.create', ['user' => $vehicle->user, 'vehicle' => $vehicle])  }}" class="btn btn-twitch">
                                    Message Business Owner
                                    <i aria-hidden="true" class="fa fa-envelope"></i>
                                </a>
                        </div>


                @endif
            @endif


                </div>
            </div>

        </div>
    </div>
@endsection

@section('footer_scripts')
    <script src="{{ asset('js/rating/star-rating.min.js') }}"></script>
@endsection