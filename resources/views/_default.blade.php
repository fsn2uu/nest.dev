<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Nest VRS</title>
        <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    </head>
    <body>
        <header>
            @include('_parts._nav')
        </header>
        <main role="main" class="flex-shrink-0" style="{{ \Auth::check() ? 'margin-top:65px;' : 'margin-top:55px;' }}min-height:60vh;">
            @if (\Request::segment(1) == '')
                <div class="position-relative overflow-hidden p-3 p-md-5 mb-5 text-center bg-light home-hero">
                    <div class="col-md-5 p-lg-5 mx-auto my-5">
                        <h1 class="display-3">Introducing Nest</h1>
                        <p class="lead">Keeping track of your properties and reservations so you can focus on what you need to.</p>
                        <a href="{{ route('about') }}" class="btn btn-outline-light">Learn More</a>
                    </div>
                </div>
            @endif
            <div class="container" id="app">
                @yield('content')
            </div>
        </main>
        @include('_parts._footer')
        <script src="{{ asset('/js/app.js') }}"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        @yield('scripts')
        @stack('scriptsStack')

        <script>
            $('#logoutButton').on('click', function(e){
                e.preventDefault()
                $('#logoutForm').submit()
            })
        </script>

        @include('_parts._toasts')

        <form action="{{ route('logout') }}" method="post" id="logoutForm">
            @csrf
        </form>

    </body>
</html>
