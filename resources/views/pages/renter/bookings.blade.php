<div class="panel panel-default p-1">

    <div class="panel-heading">
        <h2>Bookings</h2>
    </div>



    <div class="panel-body">

        <div class="container" style="width: inherit;">
            <table class="table table-striped">
                <tr>
                    <th></th>
                    <th>Id</th>
                    <th>Destination</th>
                    <th>Start Date Time</th>
                    <th>End Date Time</th>
                    <th>Vehicle Model</th>
                    <th>Owner's Name</th>
                </tr>
            @foreach($bookings as $booking)
                    <tr class="investment-table-row">
                        <td></td>
                        <td>{{$booking->id}}</td>
                        <td>{{$booking->destination}}</td>
                        <td>{{$booking->start_date_time}}</td>
                        <td>{{$booking->end_date_time}}</td>
                        <td>{{DB::table('vehicles')->select('model')->where('id',$booking->vehicle_id)->implode('model')}}</td>
                        <td>{{DB::table('users')->select('name')->where('id',$booking->owner_id)->implode('name')}}</td>

                    </tr>
            @endforeach
            </table>
    </div>
</div>

