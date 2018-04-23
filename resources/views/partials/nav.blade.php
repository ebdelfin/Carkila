<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            {{-- Collapsed Hamburger --}}
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">{!! trans('titles.toggleNav') !!}</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            {{-- Branding Image --}}
            <a class="navbar-brand d-flex" href="{{ url('/') }}">
                <img src="{{ asset('logo.png') }}" / id="logo-img">
               <!-- ondo-->

            </a>

            <?php /*<form action="{{ route('search') }}" method="POST" class="d-flex search-form">
                {{ csrf_field() }}
                <input type="text" name="search" placeholder="Search">
                <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
            </form>
            */?>







        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            {{-- Left Side Of Navbar --}}
            <!--<ul class="nav navbar-nav">
        
            </ul>-->
            

            {{-- Right Side Of Navbar --}}
            <ul class="nav navbar-nav navbar-right">
                {{-- Authentication Links --}}
                @if (Auth::guest())
                    @if (request()->route()->getName() !== 'welcome')
                        <li><a href="{{ route('login') }}">Log In</a></li>
                        <li><a href="{{ route('register') }}">Create Account</a></li>
                    @endif
                @else

                    
                    @if (Auth::User()->hasRole('renter'))
                        <li><a href="{{ url('/') }}"><i class="fa fa-search"></i> Browse Vehicles</a></li>
                        <li><a href="{{ url('/dashboard') }}"><i class="fa fa-car"></i> Bookings</a></li>
                    @endif

                    @if (Auth::User()->hasRole('vehicle.owner'))
                        <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    @endif



                        <li><a href="{{ route('messages') }}"><i class="fa fa-envelope" aria-hidden="true"></i> Messages</a></li>
               

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">

                            @if ((Auth::User()->profile) && Auth::user()->profile->avatar_status == 1)
                                <img src="{{ Auth::user()->profile->avatar }}" alt="{{ Auth::user()->name }}" class="user-avatar-nav">
                            @else
                                <div class="user-avatar-nav"></div>
                            @endif

                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            


                            @if (Auth::User()->hasRole('investor'))
                            <li>
                                <a href="{{ route('investor.favorites') }}"><i class="fa fa-heart" aria-hidden="true"></i>My Favorites</a>
                            </li>
                            @endif

                            <li><a href="{{ route('profile.show', ['profile' => Auth::User()->name]) }}"><i class="fa fa-user" aria-hidden="true"></i>My Profile</a></li>
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out" aria-hidden="true"></i>Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>

                        </div>
        <div class="form-group row">
            <div class="col-xs-3">
                <form action="{{ route('search_initial') }}" method="POST" class="d-flex search-form">
                    {{ csrf_field() }}
                    <div class="input-group" id="adv-search">
                        <input type="text" name="search" class="form-control" placeholder="Search for Vehicles" />
                        <div class="input-group-btn">
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                            </div>
                        </div>
                    </div>

                </form>


            </div>
            <div class="col-xs-2">


                <div class="dropdown dropdown-lg">
                    <button type="button" class="btn btn-twitch dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="glyphicon glyphicon-filter" aria-hidden="true"></span></button>

                    <div class="dropdown-menu dropdown-menu-right" role="menu">

                        <form class="form-horizontal" action="{{ route('search') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="contain">Make</label>
                                <input name="make" class="form-control" type="text" placeholder="Ex., Toyota, Mitsubishi, Honda"/>
                            </div>
                            <div class="form-group">
                                <label for="contain">Model</label>
                                <input name="model" class="form-control" type="text" placeholder="Ex., Vios, Mirage, Civic"/>
                            </div>
                            <div class="form-group">
                                <label for="contain">Type</label>
                                {!! Form::select('type', ['Sedan' => 'Sedan', 'Van' => 'Van', 'SUV' => 'SUV'], null, ['class' => 'form-control','placeholder' => 'Select Vehicle Type']); !!}
                            </div>

                            <?php /*
                                        <div class="form-group">
                                            <label for="contain">City</label>
                                            {!! Form::select('city', ['Others' => 'Others', 'Caloocan City' => 'Caloocan', 'Las Pinas City' => 'Las Piñas', 'Makati City' => 'Makati', 'Malabon City' => 'Malabon', 'Mandaluyong City' => 'Mandaluyong',
                                            'Manila City' => 'Manila', 'Marikina City' => 'Marikina', 'Muntinlupa City' => 'Muntinlupa', 'Navotas City' => 'Navotas', 'Paranaque City' => 'Parañaque', 'Pasay City' => 'Pasay', 'Pasig City' => 'Pasig', 'Pateros City' => 'Pateros',
                                            'Quezon City' => 'Quezon City', 'San Juan City' => 'San Juan', 'Taguig City' => 'Taguig', 'Valenzuela City' => 'Valenzuela'], null, ['class' => 'form-control','placeholder' => 'Select City']); !!}
                                        </div>
                                         */?>

                            <div class="form-group">
                                <label for="contain">Price Range</label>
                                <div class="form-group row">
                                    <div class="col-xs-5">
                                        <label for="ex1">Min</label>
                                        <input name="Min" class="form-control" id="ex1" type="text">
                                    </div>
                                    <div class="col-xs-5">
                                        <label for="ex2">Max</label>
                                        <input name="Max" class="form-control" id="ex2" type="text">
                                    </div>

                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                        </form>
                    </div>
                </div>

            </div>
            <div class="col-xs-7">
            </div>
        </div>
                    </div>








</nav>
