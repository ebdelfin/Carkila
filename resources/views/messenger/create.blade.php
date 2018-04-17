@extends('layouts.app')

@section('content')
    <h1>Create a new message</h1>
    <form action="{{ route('messages.store') }}" method="post">
        {{ csrf_field() }}
        <div class="col-md-6">
            <!-- Subject Form Input -->
            <div class="form-group">
                <label class="control-label">Make</label>
                <input type="text" class="form-control" name="make" placeholder="Subject" value="{{ $vehicle->make }}" style="pointer-events: none">

                @if ($errors->has('subject'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('subject') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <label class="control-label">Model</label>
                <input type="text" class="form-control" name="model" placeholder="Subject" value="{{ $vehicle->model }}" style="pointer-events: none">

                @if ($errors->has('subject'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('subject') }}</strong>
                    </span>
                @endif
            </div>

            <!-- Message Form Input -->
            <div class="form-group">
                <label class="control-label">Message</label>
                <textarea name="message" class="form-control">{{ old('message') }}</textarea>

                @if ($errors->has('message'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('message') }}</strong>
                    </span>
                @endif
            </div>

            <div class="checkbox" style="visibility: hidden;">
                <label title="{{ $vehicle->user_id}}"><input type="checkbox" name="recipients[]"
                                                             value="{{ $vehicle->user_id }}" checked>{!!$vehicle->user_id!!}</label>
            </div>


            <!-- Submit Form Input -->
            <div class="form-group">
                <button type="submit" class="btn btn-success">Send</button>
            </div>
        </div>
    </form>
@stop
