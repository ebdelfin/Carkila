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

                    @if (Auth::User()->hasRole('vehicle.owner') || Auth::User()->hasRole('admin') )
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









</nav>
