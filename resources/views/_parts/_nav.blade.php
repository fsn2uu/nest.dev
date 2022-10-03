<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="#">Nest VRS</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        @auth
        <ul class="navbar-nav mr-auto">
            <li class="nav-item {{ \Request::segment(1) == 'dashboard' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard') }}">Dashboard {!! \Request::segment(1) == 'dashboard' ? '<span class="sr-only">(current)</span>' : '' !!}</a>
            </li>
            @if (\Auth::user()->canCreateComplexes())
                <li class="nav-item dropdown {{ \Request::segment(1) == 'complexes' ? 'active' : '' }}">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Complexes {!! \Request::segment(1) == 'complexes' ? '<span class="sr-only">(current)</span>' : '' !!}
                        @if (\Auth::user()->package() != 'enterprise')
                            ({{ \Auth::user()->company->complexes->count() }}/{{ \Auth::user()->complex_unit_limit() }})
                        @endif
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('complexes') }}">My Complexes</a>
                        <a class="dropdown-item" href="{{ route('complexes.create') }}">Add a Complex</a>
                    </div>
                </li>
            @else
                <li class="nav-item {{ \Request::segment(1) == 'complexes' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('complexes') }}">Complexes {!! \Request::segment(1) == 'complexes' ? '<span class="sr-only">(current)</span>' : '' !!}</a>
                </li>
            @endif
            @if (\Auth::user()->canCreateUnits())
                <li class="nav-item dropdown {{ \Request::segment(1) == 'units' ? 'active' : '' }}">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Units {!! \Request::segment(1) == 'units' ? '<span class="sr-only">(current)</span>' : '' !!}
                        @if (\Auth::user()->package() != 'enterprise')
                            ({{ \Auth::user()->company->units->count() }}/{{ \Auth::user()->complex_unit_limit() }})
                        @endif
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('units') }}">My Units</a>
                        <a class="dropdown-item" href="{{ route('units.create') }}">Add a Unit</a>
                    </div>
                </li>
            @else
                <li class="nav-item {{ \Request::segment(1) == 'units' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('units') }}">Units {!! \Request::segment(1) == 'units' ? '<span class="sr-only">(current)</span>' : '' !!}</a>
                </li>
            @endif
            @if (\Auth::user()->canCreateReservations())
                <li class="nav-item dropdown {{ \Request::segment(1) == 'reservations' ? 'active' : '' }}">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Reservations {!! \Request::segment(1) == 'reservations' ? '<span class="sr-only">(current)</span>' : '' !!}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('reservations') }}">My Reservations</a>
                        <a class="dropdown-item" href="{{ route('reservations.create') }}">Add a Reservation</a>
                    </div>
                </li>
            @else
                <li class="nav-item {{ \Request::segment(1) == 'reservations' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('reservations') }}">Reservations {!! \Request::segment(1) == 'reservations' ? '<span class="sr-only">(current)</span>' : '' !!}</a>
                </li>
            @endif

            <li class="nav-item dropdown {{ \Request::segment(1) == 'rates' ? 'active' : '' }}">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Rates {!! \Request::segment(1) == 'rates' ? '<span class="sr-only">(current)</span>' : '' !!}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="{{ route('rates') }}">My Rate Tables</a>
                    <a class="dropdown-item" href="{{ route('rates.create') }}">Add a Rate Table</a>
                </div>
            </li>

            <li class="nav-item dropdown {{ \Request::segment(1) == 'fees' ? 'active' : '' }}">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Fees {!! \Request::segment(1) == 'fees' ? '<span class="sr-only">(current)</span>' : '' !!}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="{{ route('fees') }}">My Fees</a>
                    <a class="dropdown-item" href="{{ route('fees.create') }}">Add a Fee</a>
                </div>
            </li>

            @if (\Auth::user()->canCreateTravelers())
                <li class="nav-item dropdown {{ \Request::segment(1) == 'travelers' ? 'active' : '' }}">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Travelers {!! \Request::segment(1) == 'travelers' ? '<span class="sr-only">(current)</span>' : '' !!}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('travelers') }}">My Travelers</a>
                        <a class="dropdown-item" href="{{ route('travelers.create') }}">Add a Traveler</a>
                    </div>
                </li>
            @else
                <li class="nav-item {{ \Request::segment(1) == 'travelers' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('travelers') }}">Travelers {!! \Request::segment(1) == 'travelers' ? '<span class="sr-only">(current)</span>' : '' !!}</a>
                </li>
            @endif
            @if (\Auth::user()->canCreateUsers())
                <li class="nav-item dropdown {{ \Request::segment(1) == 'users' ? 'active' : '' }}">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Users {!! \Request::segment(1) == 'users' ? '<span class="sr-only">(current)</span>' : '' !!}
                        @if (\Auth::user()->package() != 'enterprise')
                            ({{ \Auth::user()->company->users->count() }}/{{ \Auth::user()->user_limit() }})
                        @endif
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('users') }}">My Users</a>
                        <a class="dropdown-item" href="{{ route('users.create') }}">Add a User</a>
                    </div>
                </li>
            @else
                <li class="nav-item {{ \Request::segment(1) == 'users' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('users') }}">Users {!! \Request::segment(1) == 'users' ? '<span class="sr-only">(current)</span>' : '' !!}</a>
                </li>
            @endif
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item {{ \Request::segment(1) == 'feature-request' ? 'active' : '' }}">
                <a class="btn btn-outline-success" href="">Feature Request {!! \Request::segment(1) == 'feature-request' ? '<span class="sr-only">(current)</span>' : '' !!}</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="{{ Gravatar::src(\Auth::user()->email) }}" height="25" style="border-radius:25px;" class="mr-2"> {{ \Auth::user()->name }}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    @if (\Auth::user()->hasRole('superadministrator'))
                        <a class="dropdown-item" href="{{ route('companies.show') }}">Company Settings</a>
                    @endif
                    <a class="dropdown-item" href="#">Change Password</a>
                    <a class="dropdown-item" id="logoutButton" href="">Sign Out</a>
                </div>
            </li>
        </ul>
        @else
            <ul class="navbar-nav mr-auto">
                <li class="nav-item {{ \Request::segment(1) == '' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('home') }}">Home {!! \Request::segment(1) == '' ? '<span class="sr-only">(current)</span>' : '' !!}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ \Request::segment(1) == 'pricing' ? 'active' : '' }}" href="{{ route('pricing') }}">Pricing {!! \Request::segment(1) == 'pricing' ? '<span class="sr-only">(current)</span>' : '' !!}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ \Request::segment(1) == 'questions-and-answers' ? 'active' : '' }}" href="#">FAQ {!! \Request::segment(1) == 'questions-and-answers' ? '<span class="sr-only">(current)</span>' : '' !!}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ \Request::segment(1) == 'developers' ? 'active' : '' }}" href="#">Developers {!! \Request::segment(1) == 'developers' ? '<span class="sr-only">(current)</span>' : '' !!}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ \Request::segment(1) == 'about-nest' ? 'active' : '' }}" href="{{ route('about') }}">About Nest {!! \Request::segment(1) == 'about-nest' ? '<span class="sr-only">(current)</span>' : '' !!}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ \Request::segment(1) == 'contact-us' ? 'active' : '' }}" href="#">Contact Us {!! \Request::segment(1) == 'contact-us' ? '<span class="sr-only">(current)</span>' : '' !!}</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="" class="nav-link">Sign Up</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('login') }}" class="nav-link">Sign In</a>
                </li>
            </ul>
        @endauth
    </div>
</nav>
