@extends('_default')

@section('content')

    <h1>
        {{ $user->name }}
        @if (\Auth::user()->canUpdateUsers())
            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary float-right">Edit User</a>
        @endif
        @if (\Auth::user()->canDeleteUsers())
            <a href="{{ route('users.delete', $user->id) }}" onclick="return conf();" class="btn btn-danger float-right mr-2">Delete User</a>
        @endif
    </h1>

    <div class="row mt-5">
        <div class="col-xs-12 col-md-2">
            <img src="{{ Gravatar::src(\Auth::user()->email) }}" width="150" style="border-radius:150px;">
        </div>
        <div class="col-xs-12 col-md-10">
            <div class="table-responsive">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <th scope="row">Name</th>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Email</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th scope="row">phone</th>
                            <td>{{ $user->phone }}</td>
                        </tr>
                        <tr>
                            <th scope="row">alt phone</th>
                            <td>{{ $user->phone2 }}</td>
                        </tr>
                        <tr>
                            <th scope="row">user level</th>
                            <td>{{ $user->roles[0]->display_name }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

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
