@extends('layouts.app')

@section('content')
    <h3>Vehicles</h3>
    @if(count($vehicles) > 0)
        @foreach($vehicles as $vehicle)
            <div class="well">
                <h3><a href="/vehicle/{{$vehicle->id}}"> {{$vehicle->make}} {{$vehicle->model}} {{$vehicle->year}} </a></h3>
                <small>Added on {{$vehicle->created_at}}</small>
            </div>
        @endforeach
    @else
        <p>No vehicles found.</p>
    @endif
@endsection