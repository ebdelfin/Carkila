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
    @if ( Auth::User()->hasRole('vehicle.owner'))
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
            <div class="alert alert-success">

                    Booking is completed at <strong>{{ \Carbon\Carbon::createFromTimeStamp(strtotime(DB::table('transactions')->select('created_at')->where('booking_id',$booking->id)->implode('created_at')))->toDayDateTimeString()}}</strong>

            </div>


            <hr>


            @if (Auth::User()->hasRole('renter')|| Auth::User()->hasRole('vehicle.owner'))
                <h3>Rate the user</h3>
                @if (Auth::check())
                    <div class="comment-form">
                        <div class="comment-avatar"><img src="{{ Auth::user()->profile->avatar }}"></div>
                        <form name="form" class="form" method="POST" action="{{ route('comments.store') }}">
                            {{ csrf_field() }}

                            <div class="form-row">
                                <textarea name="comment" placeholder="Add comment..." required="required" class="input"></textarea>
                            </div>
                            <div class="form-row">
                                <div class="rating">

                                    <input id="input-1" name="rate" class="rating rating-loading" data-min="0" data-max="5" data-step="1" value="" data-size="xs">

                                    @if ($errors->has('rate'))
                                        <span class="text-danger">
                                                    <strong>{{ $errors->first('rate') }}</strong>
                                                </span>
                                    @endif

                                </div>
                            </div>

                            <div class="form-row">
                                <input placeholder="{{ Auth::user()->name }}" type="text" disabled="disabled" class="input">
                            </div>

                            <input type="hidden" name="owner_id" required="" value="{{ $booking->owner_id }}">

                            <input type="hidden" name="user_id" required="" value="{{ $booking->user_id }}">

                            <div class="form-row">
                                <input type="submit" value="Submit Review" class="btn btn-success">
                            </div>

                        </form>
                    </div>
                @else
                    <div class="comment-form">
                        <div class="comment-avatar"><img src="{{ asset('images/smile.png') }}"></div>
                        <form name="form" class="form">
                            <div class="form-row">
                                <a href="{{ route('login') }}">
                                    <textarea name="comment" placeholder="Add comment..." required="required" class="input"></textarea>
                                </a>
                            </div>
                        </form>
                    </div>
                @endif
            @endif



            {!! Form::close() !!}
        @elseif ($booking->status == "Declined")
            <div class="alert alert-danger">

               Booking is declined by the Owner.

            </div>


            {!! Form::close() !!}
        @else
            I don't have any records!
        @endif

    </div>
    @endif










@endsection

@section('footer_scripts')
    <script src="{{ asset('js/rating/star-rating.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $(".menu").on("click", function(){
                var dataMenu = $(this).data("menu");
                var contentItem = $(".content .item[data-item="+ dataMenu +"]");
                if (!$(this).hasClass("active") && !contentItem.hasClass("active")) {
                    $(this).siblings().removeClass("active");
                    $(this).addClass("active");
                    contentItem.siblings().removeClass("active");
                    contentItem.addClass("active");
                }
            });
        });
    </script>
@endsection
