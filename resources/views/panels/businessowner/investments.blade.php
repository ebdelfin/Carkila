<div class="panel panel-default p-1">
                    
                    <div class="panel-heading">
                        <h2>Vehicles</h2>
                        <a href="{{ route('vehicle.create') }}" class="btn btn-primary">Create Vehicle Listing</a>
                    </div>
                   
                    <div class="panel-body">
                    
                        @if(count($vehicles) > 0)
                            <table class="table table-striped">
                                <tr>
                                    <th></th>
                                    <th>ID</th>
                                    <th>Make</th>
                                    <th>Model</th>
                                    <td></td>
                                </tr>
                                @foreach($vehicles as $vehicle)
                                    <tr class="investment-table-row">
                                        <td style="width: 200px;">
                                            <a href="{{ $vehicle->image }}" data-lightbox="featured-image">
                                                <div class="table-thumbnail" style="background-image: url({{ $vehicle->image }});"></div>
                                            </a>
                                        </td>
                                        <td>{{$vehicle->id}}</td>
                                        <td>{{$vehicle->make}}</td>
                                        <td>{{$vehicle->model}}</td>
                                        <td>
                                            {{--<a href="{{ route('posts.gallery.index', ['post' => $vehicle]) }}" class="btn btn-default">Gallery</a>--}}
                                            <a href=" {{ route('vehicles.show', ['post' => $vehicle]) }} " class="btn btn-twitter">View</a>
                                            <a href="/posts/{{$vehicle->id}}/edit" class="btn btn-success">Edit</a>
                                            {!!Form::open(['action' => ['PostsController@destroy', $vehicle->id], 'method' => 'POST', 'style' => 'display: inline-block;'])!!}
                                            {{Form::hidden('_method', 'DELETE')}}
                                            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                            <a href="{{ route('booking.show', ['vehicle_id' => $vehicle->id]) }}" class="btn btn-default">Bookings</a>
                                            {!!Form::close()!!}

                                        </td>
                                    </tr>
                                @endforeach
                            </table>

                            <div class="text-center">
                                {!! $vehicles->links() !!}
                            </div>

                        @else
                            <p>You have no vehicles</p>
                        @endif

                    </div>
</div>

                