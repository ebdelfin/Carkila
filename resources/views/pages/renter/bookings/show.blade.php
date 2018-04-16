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

            @if(count($requests) > 0)
                <table class="table table-striped">
                    <tr>
                        <th></th>
                        <th>ID</th>
                        <th>Make</th>
                        <th>Model</th>
                        <td></td>
                    </tr>
                    @foreach($requests as $request)
                        <tr class="investment-table-row">
                            <td style="width: 200px;">
                                <a href="{{ $request->image }}" data-lightbox="featured-image">
                                    <div class="table-thumbnail" style="background-image: url({{ $request->image }});"></div>
                                </a>
                            </td>
                            <td>{{$request->id}}</td>
                            <td>{{$request->make}}</td>
                            <td>{{$request->model}}</td>
                            <td>
                                {{--<a href="{{ route('posts.gallery.index', ['post' => $request]) }}" class="btn btn-default">Gallery</a>--}}
                                <a href=" {{ route('vehicles.show', ['post' => $request]) }} " class="btn btn-twitter">View</a>
                                <a href="/posts/{{$request->id}}/edit" class="btn btn-success">Edit</a>
                                {!!Form::open(['action' => ['PostsController@destroy', $request->id], 'method' => 'POST', 'style' => 'display: inline-block;'])!!}
                                {{Form::hidden('_method', 'DELETE')}}
                                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                <a href="{{ route('booking.show', ['post' => $request->id]) }}" class="btn btn-default">Bookings</a>
                                {!!Form::close()!!}

                            </td>
                        </tr>
                    @endforeach
                </table>

                <div class="text-center">
                    {!! $requests->links() !!}
                </div>

            @else
                <p>This vehicle does not have any request</p>
            @endif

        </div>
    </div>




@endsection
