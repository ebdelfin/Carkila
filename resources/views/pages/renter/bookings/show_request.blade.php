@extends('layouts.app')

@section('template_linked_css')
    <link rel="stylesheet" href="{{ asset('css/rating/star-rating.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/post.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/hero.css') }}" />
@endsection


@section('content')

    <h3>{{$booking->status}}</h3>
    <div class="panel panel-default p-1">
        <div class="well">
           {{$booking->destination}}
            <p>Renter: <a href="{{ url('profile/'. DB::table('users')->select('name')->where('id',$booking->user_id)->implode('name')) }}"> {{DB::table('users')->select('name')->where('id',$booking->user_id)->implode('name')}}</a></p>
            {{-- Add mo yung ibang info like $booking->pickup_location, $booking->start_date_time etc.--}}


        </div>
    </div>
    <div class="container">
        @if ($booking->status == "Pending")
            <div class="col-sm-6"><a href=" {{ route('booking.approve_request', ['booking' => $booking->id])}} " class="btn btn-success">Accept</a></div>
            <div class="col-sm-6"><a href=" {{ route('booking.decline_request', ['booking_id' => $booking->id])}} " class="btn btn-danger">Decline</a></div>
        @elseif ($booking->status == "Approved")
            {!! Form::open(['action' => array('BookingController@store_price','booking_id' => $booking->id), 'method' => 'POST']) !!}
            <div class="form-group row">
                <div class="col-xs-5">
                    {{Form::label('price', 'Transaction Price')}}
                    {{Form::text ('price', '', ['class'=>'form-control', 'placeholder'=> 'Price'])}}
                    {{Form::submit('Mark as Complete', ['class'=>'btn btn-success mt-2'])}}
                </div>
            </div>


            {!! Form::close() !!}
        @elseif ($booking->status == "Completed")
            Booking is completed!


            {!! Form::close() !!}
        @elseif ($booking->status == "Declined")
            Booking is declined!


            {!! Form::close() !!}
        @else
            I don't have any records!
        @endif

    </div>




@endsection
