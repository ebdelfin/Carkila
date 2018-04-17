@extends('layouts.app')

@section('template_linked_css')
    <link rel="stylesheet" href="{{ asset('css/rating/star-rating.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/post.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/hero.css') }}" />
@endsection


@section('content')

    <div class="panel panel-default p-1">

        <div class="panel-heading">
            <h2>Requests</h2>
        </div>

        <div class="panel-body">

            @if((is_null($requests)))
                <p>This vehicle does not have any request</p>
            @else
                <table class="table table-striped">
                    <tr>
                        <th>ID</th>
                        <th>Start Date Time</th>
                        <th>End Date Time</th>
                        <th>Renter</th>
                        <td></td>
                    </tr>
                    {{--@foreach($requests as $request)--}}
                        <tr class="investment-table-row">
                            <td>{{$requests->id}}</td>
                            <td>{{$requests->start_date_time}}</td>
                            <td>{{$requests->end_date_time}}</td>
                            <td>{{DB::Table('users')->select('name')->where('id',$requests->user_id)->implode('name')}}</td>
                            <td></td>
                        </tr>
                    {{--@endforeach--}}
                </table>

                <div class="text-center">
                    {{-- $requests->links() --}}
                </div>


            @endif

        </div>
    </div>




@endsection
