@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h1>Add Vehicle Listing</h1>
        </div>
        <div class="panel-body">

            {!! Form::open(['action' => 'VehicleController@store', 'method' => 'POST', 'files' => true]) !!}
                <div class="form-group">
                    {{Form::label('make', 'Vehicle Make')}}
                    {{Form::text ('make', '', ['class'=>'form-control', 'placeholder'=> 'Make'])}}
                    @if ($errors->has('make'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('make') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    {{Form::label('model', 'Model')}}
                    {{Form::text ('model', '', ['class'=>'form-control', 'placeholder'=> 'Model'])}}
                    @if ($errors->has('model'))
                        <span class="text-danger">
                                <strong>{{ $errors->first('model') }}</strong>
                            </span>
                    @endif
                </div>

                <div class="form-group">
                    {{Form::label('year', 'Year')}}
                    {{Form::text ('year', '', ['class'=>'form-control', 'placeholder'=> 'year'])}}
                    @if ($errors->has('year'))
                        <span class="text-danger">
                                    <strong>{{ $errors->first('year') }}</strong>
                                </span>
                    @endif
                </div>

                <div class="form-group">
                    {{Form::label('color', 'Color')}}
                    {{Form::text ('color', '', ['class'=>'form-control', 'placeholder'=> 'color'])}}
                    @if ($errors->has('color'))
                        <span class="text-danger">
                                        <strong>{{ $errors->first('color') }}</strong>
                                    </span>
                    @endif
                </div>

                <div class="form-group">
                    {{Form::label('seating_capacity', 'Seating Capacity')}}
                    {{Form::text ('seating_capacity', '', ['class'=>'form-control', 'placeholder'=> 'Capacity'])}}
                    @if ($errors->has('seating_capacity'))
                        <span class="text-danger">
                                            <strong>{{ $errors->first('seating_capacity') }}</strong>
                                        </span>
                    @endif
                </div>


                <div class="form-group">
                    {{Form::label('engine_number', 'Engine Number')}}
                    {{Form::text ('engine_number', '', ['class'=>'form-control', 'placeholder'=> 'Engine Number'])}}
                    @if ($errors->has('engine_number'))
                        <span class="text-danger">
                                                <strong>{{ $errors->first('engine_number') }}</strong>
                                            </span>
                    @endif
                </div>


                <div class="form-group">
                    {{Form::label('chassis_number', 'Chassis Number')}}
                    {{Form::text ('chassis_number', '', ['class'=>'form-control', 'placeholder'=> 'Chassis Number'])}}
                    @if ($errors->has('chassis_number'))
                        <span class="text-danger">
                                                    <strong>{{ $errors->first('chassis_number') }}</strong>
                                                </span>
                    @endif
                </div>

                <div class="form-group">
                    {{Form::label('plate_number', 'Plate Number')}}
                    {{Form::text ('plate_number', '', ['class'=>'form-control', 'placeholder'=> 'Plate Number'])}}
                    @if ($errors->has('plate_number'))
                        <span class="text-danger">
                                                        <strong>{{ $errors->first('plate_number') }}</strong>
                                                    </span>
                    @endif
                </div>

                <div class="form-group">
                    {{Form::label('rental_rate', 'Rental Rate')}}
                    {{Form::text ('rental_rate', '', ['class'=>'form-control', 'placeholder'=> 'Price'])}}
                    @if ($errors->has('rental_rate'))
                        <span class="text-danger">
                                                            <strong>{{ $errors->first('rental_rate') }}</strong>
                                                        </span>
                    @endif
                </div>




                <div class="form-group">
                    {{Form::label('featured_image', 'Upload Featured Image')}}
                    {{Form::file('featured_image')}}
                    @if ($errors->has('featured_image'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('featured_image') }}</strong>
                        </span>
                    @endif
                </div>



                <div id="post-featured-image"  style="width: 100%;
                                                                background-size: contain;
                                                                background-repeat: no-repeat;
                                                                background-position: center;">

                </div>


                {{Form::submit('Publish Listing', ['class'=>'btn btn-primary mt-2'])}}
            {!! Form::close() !!}

        </div>
        </div>
    </div>

@endsection


@section("footer_scripts")
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#post-featured-image').css({
                        "height" : "500px",
                        "background-image" : "url("+e.target.result+")",
                    });
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#featured_image").change(function(){
            readURL(this);
        });
    </script>
@endsection