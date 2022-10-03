@extends('_default')

@section('content')

    <h1>
        Edit a User

        @if (\Auth::user()->canDeleteUsers())
            <a href="{{ route('users.delete', $user->id) }}" onclick="return conf();" class="btn btn-danger float-right mr-2">Delete User</a>
        @endif
    </h1>

    <form action="" method="post" class="">
        @csrf
        <div class="row">
            <div class="col-xs-12 col-md-6">
                <div class="form-group">
                    <label for="name">name</label>
                    <input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                    value="{{ old('name') ?: $user->name }}" />
                    @if($errors->has('name'))
                        <span class="invalid-feedback">{{ $errors->first('name') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="email">email</label>
                    <input type="text" name="email" id="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                    value="{{ old('email') ?: $user->email }}" />
                    @if($errors->has('email'))
                        <span class="invalid-feedback">{{ $errors->first('email') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="phone">phone</label>
                    <input type="text" name="phone" id="phone" class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}"
                    value="{{ old('phone') ?: $user->phone }}" />
                    @if($errors->has('phone'))
                        <span class="invalid-feedback">{{ $errors->first('phone') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="phone2">alt phone</label>
                    <input type="text" name="phone2" id="phone2" class="form-control {{ $errors->has('phone2') ? 'is-invalid' : '' }}"
                    value="{{ old('phone2') ?: $user->phone2 }}" />
                    @if($errors->has('phone2'))
                        <span class="invalid-feedback">{{ $errors->first('phone2') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="password">new password</label>
                    <input type="text" name="password" id="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                    value="{{ old('password') }}" />
                    <small id="passwordHelpBlock" class="form-text text-muted">Leave this blank if you want to keep the existing password.</small>
                    @if($errors->has('password'))
                        <span class="invalid-feedback">{{ $errors->first('password') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-xs-12 col-md-6">
                <h3>Permissions</h3>
                @foreach ($user->roles as $role)
                    <div class="form-group">
                        <label>{{ $role->display_name }}</label>
                        @foreach (\App\Permission::all() as $perm)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $perm->id }}" id="permission-{{ $perm->id }}" {{ $user->hasPermission($perm->name) ? 'checked' : '' }}>
                                <label class="form-check-label" for="permission-{{ $perm->id }}">
                                    {{ $perm->display_name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>


        <input type="submit" value="Edit User" class="btn btn-primary">
    </form>

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
