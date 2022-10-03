@extends('_default')

@section('content')

    <h1>New Permission</h1>

    <form action="" method="post">
        @csrf

        <perm-form></perm-form>
        
        <input type="submit" value="Create Permission" class="btn btn-primary">
    </form>


@endsection
