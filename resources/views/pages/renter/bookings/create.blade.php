@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1>Request Vehicle Booking</h1>
        </div>
        <div class="panel-body">

            {!! Form::open(['action' => 'BookingController@store', 'method' => 'POST', 'files' => true]) !!}

            <div class="form-group">
                {{Form::label('destination', 'Destination')}}
                {{Form::text ('destination', '', ['class'=>'form-control', 'placeholder'=> 'Destination'])}}
                @if ($errors->has('destination'))
                    <span class="text-danger">
                            <strong>{{ $errors->first('destination') }}</strong>
                        </span>
                @endif
            </div>

            <div class="form-group">
                {{Form::label('pickup_location', 'Pickup location')}}
                {{Form::text ('pickup_location', '', ['class'=>'form-control', 'placeholder'=> 'Your Pickup location'])}}
                @if ($errors->has('pickup_location'))
                    <span class="text-danger">
                                <strong>{{ $errors->first('pickup_location') }}</strong>
                            </span>
                @endif
            </div>


            <div class="form-group">
                {{Form::label('start_date', 'Start date')}}
                {!! Form::date('start_date', \Carbon\Carbon::now()); !!}
                @if ($errors->has('start_date'))
                    <span class="text-danger">
                                    <strong>{{ $errors->first('start_date') }}</strong>
                                </span>
                @endif
            </div>


            <div class="form-group">
                {{Form::label('start_time', 'Start Time')}}
                {!! Form::selectRange('start_hours', 00, 24); !!}
                <strong>:</strong>
                {!! Form::selectRange('start_minutes', 00, 60); !!}
                {!! Form::hidden('start_seconds', '00') !!}
                @if ($errors->has('start_date'))
                    <span class="text-danger">
                                    <strong>{{ $errors->first('start_date') }}</strong>
                                </span>
                @endif
            </div>

            <h3>To</h3>
            </br>


            <div class="form-group">
                {{Form::label('end_date', 'End date')}}
                {!! Form::date('end_date', \Carbon\Carbon::now()); !!}
                @if ($errors->has('end_date'))
                    <span class="text-danger">
                                    <strong>{{ $errors->first('end_date') }}</strong>
                                </span>
                @endif
            </div>

            <div class="form-group">
                {{Form::label('end_time', 'End Time')}}
                {!! Form::selectRange('end_hours', 00, 24); !!}
                <strong>:</strong>
                {!! Form::selectRange('end_minutes', 00, 60); !!}
                {!! Form::hidden('end_seconds', '00') !!}
                @if ($errors->has('end_date'))
                    <span class="text-danger">
                                    <strong>{{ $errors->first('end_date') }}</strong>
                                </span>
                @endif
            </div>

            <div class="form-group">
                {{Form::label('pax', 'Pax')}}
                {{ Form::number('pax', 'value')}}
                @if ($errors->has('pax'))
                    <span class="text-danger">
                                        <strong>{{ $errors->first('pax') }}</strong>
                                    </span>
                @endif
            </div>

            <div class="form-group">
                {{Form::label('price', 'Price')}}
                {{Form::text ('price', '', ['class'=>'form-control', 'placeholder'=> 'Price'])}}
                @if ($errors->has('price'))
                    <span class="text-danger">
                                            <strong>{{ $errors->first('price') }}</strong>
                                        </span>
                @endif
            </div>

            {!! Form::hidden('vehicle_id', $vehicle_id) !!}
            {!! Form::hidden('owner_id', $owner_id) !!}
            {{Form::submit('Submit Booking', ['class'=>'btn btn-success mt-2'])}}
            {!! Form::close() !!}

        </div>
    </div>

@endsection


@section("footer_scripts")


@endsection