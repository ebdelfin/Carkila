@extends('layouts.app')

@section('template_title')
    Transaction Report
@endsection



@section('content')

        <div class="panel panel-default p-1">

            <div class="panel-heading">
                <h2>App Transaction Report</h2>
            </div>

            <div class="panel-body">

                @if(($requests->isEmpty()))
                    <p>This vehicle does not have any bookings</p>
                @else
                    <table class="table table-striped" id="myTable2">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Transaction date</th>
                                <th>Start Date Time</th>
                                <th>End Date Time</th>
                                <th>Owner</th>
                                <th>Renter</th>
                                <th>Status</th>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($requests as $request)
                            <tr class="investment-table-row">
                                <td>{{$request->id}}</td>
                                <td>{{$request->created_at}}</td>
                                <td>{{$request->start_date_time}}</td>
                                <td>{{$request->end_date_time}}</td>
                                <td><a href="{{ url('profile/'. DB::table('users')->select('name')->where('id',DB::table('vehicles')->select('user_id')->where('id',$request->vehicle_id)->implode('user_id'))->implode('name')) }}"> {{ DB::table('users')->select('name')->where('id',DB::table('vehicles')->select('user_id')->where('id',$request->vehicle_id)->implode('user_id'))->implode('name')}}</a></td>
                                <td><a href="{{ url('profile/'. DB::table('users')->select('name')->where('id',$request->user_id)->implode('name')) }}"> {{DB::table('users')->select('name')->where('id',$request->user_id)->implode('name')}}</a></td>
                                <td>{{$request->status}}</td>
                                <td><a href=" {{ route('booking.show_request', ['booking_id' => $request->id])}} " class="btn btn-twitter">View</a></td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>

                    <div class="text-center">
                        {{-- $requests->links() --}}
                    </div>


                @endif

            </div>
        </div>


@endsection
