@extends('_default')

@section('content')

    <h1>Users</h1>

    @if ($users->count() > 0)
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>name</th>
                        <th>email</th>
                        <th>phone</th>
                        <th>phone 2</th>
                        <th>user level</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->phone2 }}</td>
                            <td>
                                @foreach (\Auth::user()->roles as $role)
                                    {{ $role->display_name }}
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ route('users.show', $user->id) }}" class="mr-2"><i class="fas fa-eye fa-lg"></i></a>
                                @if (\Auth::user()->canUpdateUsers())
                                    <a href="{{ route('users.edit', $user->id) }}" class="mr-2"><i class="fas fa-edit fa-lg"></i></a>
                                @endif
                                @if (\Auth::user()->canDeleteUsers())
                                    <a href="{{ route('users.delete', $user->id) }}" onclick="return conf();"><i class="fas fa-trash-alt fa-lg"></i></a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p>There are no users to display.</p>
    @endif

@endsection

@section('scripts')

    <script>
    function conf()
    {
        if(confirm('Are you sure?') === false)
        {
            return false;
        }

        return true;
    }
    </script>

@endsection
