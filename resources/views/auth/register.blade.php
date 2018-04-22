@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">

                    {!! Form::open(['route' => 'register', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'POST'] ) !!}

                        {{ csrf_field() }}


                    <!--Choose Role-->
                        <div class="form-group">
                            <label for="user_role" class="col-sm-4 control-label" name="user_role">What are you:</label>
                            <div class="col-sm-6">
                              <select class="form-control" id="user_role" class="col-sm-6" name="user_role">
                                @foreach($roles as $role)
                                    <option>{{ $role->name }}</option>
                                @endforeach
                              </select>
                            </div>
                        </div>

                        <!--Username-->
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-sm-4 control-label">Username</label>
                            <div class="col-sm-6">
                                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name', 'id' => 'name', 'required', 'autofocus']) !!}
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!--First Name-->
                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <label for="first_name" class="col-sm-4 control-label">First Name</label>
                            <div class="col-sm-6">
                                {!! Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'First Name', 'id' => 'first_name']) !!}
                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!--Last Name-->
                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <label for="last_name" class="col-sm-4 control-label">Last Name</label>
                            <div class="col-sm-6">
                                {!! Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'Last Name', 'id' => 'last_name']) !!}
                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                    {{--    <!--Gender-->
                        <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                            <label for="email" class="col-sm-4 control-label">Gender</label>
                            <div class="col-sm-6">
                                {!! Form::select('gender', ['Male', 'Female' => 'Female',], null, ['class' => 'form-control','placeholder' => 'Choose gender']); !!}
                                @if ($errors->has('gender'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('gender') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>--}}

                        <!--Street-->
                        <div class="form-group{{ $errors->has('street') ? ' has-error' : '' }}">
                            <label for="last_name" class="col-sm-4 control-label">Street</label>
                            <div class="col-sm-6">
                                {!! Form::text('street', null, ['class' => 'form-control', 'placeholder' => 'Street', 'id' => 'street']) !!}
                                @if ($errors->has('street'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('street') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <!--Barangay-->
                        <div class="form-group{{ $errors->has('barangay') ? ' has-error' : '' }}">
                            <label for="last_name" class="col-sm-4 control-label">Barangay</label>
                            <div class="col-sm-6">
                                {!! Form::text('barangay', null, ['class' => 'form-control', 'placeholder' => 'Barangay', 'id' => 'brangay']) !!}
                                @if ($errors->has('barangay'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('barangay') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <!--City-->
                        <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                            <label for="last_name" class="col-sm-4 control-label">City</label>
                            <div class="col-sm-6">
                                {!! Form::select('gender', ['Others' => 'Others', 'Caloocan City' => 'Caloocan', 'Las Pinas City' => 'Las Piñas', 'Makati City' => 'Makati', 'Malabon City' => 'Malabon', 'Mandaluyong City' => 'Mandaluyong',
                                 'Manila City' => 'Manila', 'Marikina City' => 'Marikina', 'Muntinlupa City' => 'Muntinlupa', 'Navotas City' => 'Navotas', 'Paranaque City' => 'Parañaque', 'Pasay City' => 'Pasay', 'Pasig City' => 'Pasig', 'Pateros City' => 'Pateros',
                                 'Quezon City' => 'Quezon City', 'San Juan City' => 'San Juan', 'Taguig City' => 'Taguig', 'Valenzuela City' => 'Valenzuela'], null, ['class' => 'form-control','placeholder' => 'Select City']); !!}
                                @if ($errors->has('city'))
                                    <span class="help-block">
                                                <strong>{{ $errors->first('city') }}</strong>
                                            </span>
                                @endif
                            </div>
                        </div>

                        <!--Mobile Number-->
                        <div class="form-group{{ $errors->has('mobile_number') ? ' has-error' : '' }}">
                            <label for="last_name" class="col-sm-4 control-label">Mobile Number</label>
                            <div class="col-sm-6">
                                {!! Form::text('mobile_number', null, ['class' => 'form-control', 'placeholder' => 'Mobile Number', 'id' => 'mobile_number']) !!}
                                @if ($errors->has('mobile_number'))
                                    <span class="help-block">
                                                    <strong>{{ $errors->first('mobile_number') }}</strong>
                                                </span>
                                @endif
                            </div>
                        </div>


                    <div id="businessOwnerFields">
                        <br>
                        <center>
                            <i class="fa fa-car" style="font-size:24px"></i><span class="oi" data-glyph="graph"></span>
                        </center>
                        <br>
                        <div class="form-group{{ $errors->has('business_name') ? ' has-error' : '' }}">
                            <label for="first_name" class="col-sm-4 control-label">License Number</label>
                            <div class="col-sm-6">
                                {!! Form::text('license_number', null, ['class' => 'form-control', 'placeholder' => '', 'id' => 'license_number']) !!}
                                @if ($errors->has('license_number'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('business_name') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('business_nature') ? ' has-error' : '' }}">
                            <label for="business_nature" class="col-sm-4 control-label">License Expiry</label>
                            <div class="col-sm-6">
                              {!! Form::date('license_expiry', \Carbon\Carbon::now()); !!}
                                @if ($errors->has('license_expiry'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('license_expiry') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>


                            <div class="form-group">
                                <label for="first_name" class="col-sm-4 control-label">Driver's License</label>
                                <div class="col-sm-6">
                                {{Form::file('featured_image')}}
                                @if ($errors->has('featured_image'))
                                    <span class="text-danger">
                            <strong>{{ $errors->first('featured_image') }}</strong>
                        </span>
                                @endif
                            </div>
                            </div>


                            <div id="post-featured-image"  style="width: 100%;
                                                                background-size: contain;
                                                                background-repeat: no-repeat;
                                                                background-position: center;">

                            </div>

                    </div>
                        <br>


                        <center>
                            <span class="glyphicon glyphicon-minus"></span> <span class="glyphicon glyphicon-minus"></span> <span class="glyphicon glyphicon-minus"></span>
                        </center>
                        <br>
                        <!--Email-->
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-sm-4 control-label">E-Mail Address</label>
                            <div class="col-sm-6">
                                {!! Form::email('email', null, ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'E-Mail Address', 'required']) !!}
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!--Password-->
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-sm-4 control-label">Password</label>
                            <div class="col-sm-6">
                                {!! Form::password('password', ['class' => 'form-control', 'id' => 'password', 'placeholder' => 'Password', 'required']) !!}
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!--Password Confirmation-->
                        <div class="form-group">
                            <label for="password-confirm" class="col-sm-4 control-label">Confirm Password</label>
                            <div class="col-sm-6">
                                {!! Form::password('password_confirmation', ['class' => 'form-control', 'id' => 'password-confirm', 'placeholder' => 'Confirm Password', 'required']) !!}
                            </div>
                        </div>
                        @if(config('settings.reCaptchStatus'))
                            <div class="form-group">
                                <div class="col-sm-6 col-sm-offset-4">
                                    <div class="g-recaptcha" data-sitekey="{{ env('RE_CAP_SITE') }}"></div>
                                </div>
                            </div>
                        @endif
                        <div class="form-group margin-bottom-2">
                            <div class="col-sm-6 col-sm-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>



                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('footer_scripts')



    <script>
     $(document).ready(function () {

        var user_role;

        user_role = $("#user_role").val();


            if (user_role == "Vehicle Owner") {

                $("#businessOwnerFields").removeClass("hidden");

            } else {

                $("#businessOwnerFields").addClass("hidden");
            }


            $("#user_role").on("change", function(){

                user_role = $("#user_role").val();

                
                if (user_role == "Vehicle Owner") {

                    $("#businessOwnerFields").removeClass("hidden");

                } else {

                    $("#businessOwnerFields").addClass("hidden");
                }

            });




        });
    </script>

@endsection