@extends('layouts.app')

@section('template_title')
    Transaction Report
@endsection

@section('template_linked_css')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css" />
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
                            <th onclick="sortTable(0)"><a href="#"> Transaction date</a></th>
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
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th ><a href="#"> Transaction date</a></th>
                                <th>Start Date Time</th>
                                <th>End Date Time</th>
                                <th>Owner</th>
                                <th>Renter</th>
                                <th>Status</th>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>

                    <div class="text-center">
                        {{-- $requests->links() --}}
                    </div>


                @endif

            </div>
        </div>


@endsection

@section('footer_scripts')
    <script>
        function sortTable(n) {
            var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
            table = document.getElementById("myTable2");
            switching = true;
            // Set the sorting direction to ascending:
            dir = "asc";
            /* Make a loop that will continue until
            no switching has been done: */
            while (switching) {
                // Start by saying: no switching is done:
                switching = false;
                rows = table.getElementsByTagName("TR");
                /* Loop through all table rows (except the
                first, which contains table headers): */
                for (i = 1; i < (rows.length - 1); i++) {
                    // Start by saying there should be no switching:
                    shouldSwitch = false;
                    /* Get the two elements you want to compare,
                    one from current row and one from the next: */
                    x = rows[i].getElementsByTagName("TD")[n];
                    y = rows[i + 1].getElementsByTagName("TD")[n];
                    /* Check if the two rows should switch place,
                    based on the direction, asc or desc: */
                    if (dir == "asc") {
                        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                            // If so, mark as a switch and break the loop:
                            shouldSwitch= true;
                            break;
                        }
                    } else if (dir == "desc") {
                        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                            // If so, mark as a switch and break the loop:
                            shouldSwitch= true;
                            break;
                        }
                    }
                }
                if (shouldSwitch) {
                    /* If a switch has been marked, make the switch
                    and mark that a switch has been done: */
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                    // Each time a switch is done, increase this count by 1:
                    switchcount ++;
                } else {
                    /* If no switching has been done AND the direction is "asc",
                    set the direction to "desc" and run the while loop again. */
                    if (switchcount == 0 && dir == "asc") {
                        dir = "desc";
                        switching = true;
                    }
                }
            }
        }
    </script>
    <script>$(document).ready(function() {
            $('#myTable2').DataTable();
        } );</script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
@endsection
