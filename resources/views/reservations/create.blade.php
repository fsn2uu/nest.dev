@extends('_default')

@section('content')

    <h1>Add a Reservation</h1>

    <form action="" method="post" class="col-xs-12 col-md-6">
        @csrf

        <input type="submit" value="Add Reservation" class="btn btn-primary">
    </form>

@endsection
