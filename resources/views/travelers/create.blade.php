@extends('_default')

@section('content')

    <h1>Add a Traveler</h1>

    <form action="" method="post" class="col-xs-12 col-md-6">
        @csrf

        <div class="form-group">
            <label for="first">first name</label>
            <input type="text" name="first" id="first" class="form-control {{ $errors->has('first') ? 'is-invalid' : '' }}"
            value="{{ old('first') }}" />
            @if($errors->has('first'))
                <span class="invalid-feedback">{{ $errors->first('first') }}</span>
            @endif
        </div>

        <div class="form-group">
            <label for="last">last name</label>
            <input type="text" name="last" id="last" class="form-control {{ $errors->has('last') ? 'is-invalid' : '' }}"
            value="{{ old('last') }}" />
            @if($errors->has('last'))
                <span class="invalid-feedback">{{ $errors->first('last') }}</span>
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
            <label for="address">address</label>
            <input type="text" name="address" id="address" class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}"
            value="{{ old('address') }}" />
            @if($errors->has('address'))
                <span class="invalid-feedback">{{ $errors->first('address') }}</span>
            @endif
        </div>

        <div class="form-group">
            <label for="address2">address 2</label>
            <input type="text" name="address2" id="address2" class="form-control {{ $errors->has('address2') ? 'is-invalid' : '' }}"
            value="{{ old('address2') }}" />
            @if($errors->has('address2'))
                <span class="invalid-feedback">{{ $errors->first('address2') }}</span>
            @endif
        </div>

        <div class="form-group">
            <label for="city">city</label>
            <input type="text" name="city" id="city" class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}"
            value="{{ old('city') }}" />
            @if($errors->has('city'))
                <span class="invalid-feedback">{{ $errors->first('city') }}</span>
            @endif
        </div>

        <div class="form-group">
            <label for="state">state</label>
            <select name="state" id="state" class="form-control {{ $errors->has('state') ? 'has-error' : '' }}">
                <option value="AL">Alabama</option>
                <option value="AK">Alaska</option>
                <option value="AZ">Arizona</option>
                <option value="AR">Arkansas</option>
                <option value="CA">California</option>
                <option value="CO">Colorado</option>
                <option value="CT">Connecticut</option>
                <option value="DE">Delaware</option>
                <option value="DC">District of Columbia</option>
                <option value="FL" selected>Florida</option>
                <option value="GA">Georgia</option>
                <option value="HI">Hawaii</option>
                <option value="ID">Idaho</option>
                <option value="IL">Illinois</option>
                <option value="IN">Indiana</option>
                <option value="IA">Iowa</option>
                <option value="KS">Kansas</option>
                <option value="KY">Kentucky</option>
                <option value="LA">Louisiana</option>
                <option value="ME">Maine</option>
                <option value="MD">Maryland</option>
                <option value="MA">Massachusetts</option>
                <option value="MI">Michigan</option>
                <option value="MN">Minnesota</option>
                <option value="MS">Mississippi</option>
                <option value="MO">Missouri</option>
                <option value="MT">Montana</option>
                <option value="NE">Nebraska</option>
                <option value="NV">Nevada</option>
                <option value="NH">New Hampshire</option>
                <option value="NJ">New Jersey</option>
                <option value="NM">New Mexico</option>
                <option value="NY">New York</option>
                <option value="NC">North Carolina</option>
                <option value="ND">North Dakota</option>
                <option value="OH">Ohio</option>
                <option value="OK">Oklahoma</option>
                <option value="OR">Oregon</option>
                <option value="PA">Pennsylvania</option>
                <option value="RI">Rhode Island</option>
                <option value="SC">South Carolina</option>
                <option value="SD">South Dakota</option>
                <option value="TN">Tennessee</option>
                <option value="TX">Texas</option>
                <option value="UT">Utah</option>
                <option value="VT">Vermont</option>
                <option value="VA">Virginia</option>
                <option value="WA">Washington</option>
                <option value="WV">West Virginia</option>
                <option value="WI">Wisconsin</option>
                <option value="WY">Wyoming</option>
            </select>
            @if($errors->has('state'))
                <span class="invalid-feedback">{{ $errors->first('state') }}</span>
            @endif
        </div>

        <div class="form-group">
            <label for="zip">zip</label>
            <input type="text" name="zip" id="zip" class="form-control {{ $errors->has('zip') ? 'is-invalid' : '' }}"
            value="{{ old('zip') }}" />
            @if($errors->has('zip'))
                <span class="invalid-feedback">{{ $errors->first('zip') }}</span>
            @endif
        </div>

        <input type="submit" value="Add Traveler" class="btn btn-primary">
    </form>

@endsection
