<div class="panel panel-default p-1">

    <div class="panel-heading">
        <h2>Bookings</h2>
    </div>



    <div class="panel-body">

        <div class="container" style="width: inherit;">
            <table class="table table-striped" id="myTable2">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Id</th>
                        <th>Destination</th>
                        <th>Start Date Time</th>
                        <th>End Date Time</th>
                        <th>Vehicle Model</th>
                        <th>Owner's Name</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
            @foreach($bookings as $booking)
                    <tr class="investment-table-row">
                        <td style="width: 200px;">

                                <div class="table-thumbnail" style="background-image: url({{ DB::table('vehicles')->select('image')->where('id',$booking->vehicle_id)->implode('image')  }});"></div>

                        </td>
                        <td>{{$booking->id}}</td>
                        <td>{{$booking->destination}}</td>
                        <td>{{$booking->start_date_time}}</td>
                        <td>{{$booking->end_date_time}}</td>
                        <td>{{DB::table('vehicles')->select('model')->where('id',$booking->vehicle_id)->implode('model')}}</td>
                        <td><a href="{{ url('profile/'. DB::table('users')->select('first_name')->where('id',$booking->owner_id)->implode('first_name')) }}">
                                {{DB::table('users')->select('last_name')->where('id',$booking->owner_id)->implode('last_name')}}</a></td>
                        <td>{{$booking->status}}</td>

                    </tr>
            @endforeach
                </tbody>
            </table>
    </div>
</div>

</div>
