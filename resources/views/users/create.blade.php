@extends('_default')

@section('content')

    <h1>Add a User</h1>

    <form action="" method="post">
        @csrf
        <div class="row">
            <div class="col-xs-12 col-md-6">
                <div class="form-group">
                    <label for="name">name</label>
                    <input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                    value="{{ old('name') }}" />
                    @if($errors->has('name'))
                        <span class="invalid-feedback">{{ $errors->first('name') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="email">email</label>
                    <input type="text" name="email" id="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                    value="{{ old('email') }}" />
                    @if($errors->has('email'))
                        <span class="invalid-feedback">{{ $errors->first('email') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="phone">phone</label>
                    <input type="text" name="phone" id="phone" class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}"
                    value="{{ old('phone') }}" />
                    @if($errors->has('phone'))
                        <span class="invalid-feedback">{{ $errors->first('phone') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="phone2">alt phone</label>
                    <input type="text" name="phone2" id="phone2" class="form-control {{ $errors->has('phone2') ? 'is-invalid' : '' }}"
                    value="{{ old('phone2') }}" />
                    @if($errors->has('phone2'))
                        <span class="invalid-feedback">{{ $errors->first('phone2') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="password">password</label>
                    <input type="text" name="password" id="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                    value="{{ old('password') }}" />
                    <small id="passwordHelpBlock" class="form-text text-muted">Leave this blank if you want us to generate a random password.</small>
                    @if($errors->has('password'))
                        <span class="invalid-feedback">{!! $errors->first('password') !!}</span>
                    @endif
                </div>
            </div>
            <div class="col-xs-12 col-md-6">
                <div class="col-xs-12 col-md-6">
                    <h3>Permissions</h3>
                </div>
            </div>
        </div>

        <input type="submit" value="Add User" class="btn btn-primary">
    </form>

    <p class="mt-5"><small>Don't worry, we'll send the new user their password once they've been created.</small></p>

@endsection
