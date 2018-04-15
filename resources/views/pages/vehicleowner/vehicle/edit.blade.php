@extends('layouts.app')

@section('content')

    <div class="row">
        {!! Form::open(['action' => ['VehicleController@update', $vehicle->id], 'method' => 'POST']) !!}
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1>Edit Vehicle Listing</h1>
            </div>
            <div class="panel-body">

                <div class="col-md-8">

                    <div class="form-group">
                        {{Form::label('make', 'Make')}}
                        {{Form::text('make', $vehicle->make, ['class' => 'form-control', 'placeholder' => 'Make'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('model', 'Model')}}
                        {{Form::text('model', $vehicle->model, ['class' => 'form-control', 'placeholder' => 'Model'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('year', 'Year')}}
                        {{Form::text('year', $vehicle->year, ['class' => 'form-control', 'placeholder' => 'Year'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('rental_rate', 'Rental Rate')}}
                        {{Form::textarea('rental_rate', $vehicle->rental_rate, ['class' => 'form-control', 'placeholder' => 'Rental Rate'])}}
                    </div>

                </div>


                    {{ Form::label('featured_image' , 'Update Featured Image:') }}
                    {{ Form::file('featured_image') }}

                    <div id="post-featured-image" data-src="{{ $vehicle->image }}"   style="width: 100%;
                            height: 500px;
                            background-image: url({{ $vehicle->image }});
                            background-size: contain;
                            background-repeat: no-repeat;
                            background-position: center;">

                    </div>




                </div>

            </div>
        </div>

        {{Form::hidden('_method','PUT')}}
        {!! Form::close() !!}
    </div>

@endsection

@section("footer_scripts")
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#post-featured-image').css("background-image", "url("+e.target.result+")");
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#featured_image").change(function(){
            readURL(this);
        });
    </script>
@endsection