@extends('_default')

@section('content')

    <h1>
        Permissions
        <a href="{{ route('permissions.create') }}" class="btn btn-primary float-right">Create Permission</a>
    </h1>

    <strong>NOTE: DELETE THIS INTERFACE BEFORE LAUNCH</strong>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>name</th>
                    <th>display name</th>
                    <th>description</th>
                </tr>
            </thead>
            @foreach ($permissions as $perm)
                <tr>
                    <td>{{ $perm->name }}</td>
                    <td>{{ $perm->display_name }}</td>
                    <td>{{ $perm->description }}</td>
                </tr>
            @endforeach
        </table>
    </div>

@endsection
