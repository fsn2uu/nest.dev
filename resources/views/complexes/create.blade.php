@extends('_default')

@section('content')

        <h1>Add a Complex</h1>

        <div class="row">
            <div class="col-xs-12 col-md-6 order-md-2">
                <p><i class="far fa-lightbulb fa-2x"></i> Complexes are buildings with groups of units in them.  For example, a condominium is a complex.</p>
                <p>You can add more information to the complex after it's been created.  Don't worry, it won't show on your site until you're done with it.</p>
                <p>Why do we need the address of the complex?  We need the address so that the traveler can get driving directions.</p>
            </div>

            <div class="col-xs-12 col-md-6">
                <form action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">name</label>
                        <input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                        value="{{ old('name') }}" />
                        @if($errors->has('name'))
                            <span class="invalid-feedback">{{ $errors->first('name') }}</span>
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
                        value="{{ old('address2') }}" placeholder="Suite #, Apt #, etc." />
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

                    <div class="form-group">
                        <label for="description">complex description</label>
                        <textarea name="description" id="description" cols="30" rows="10" class="form-control
                        {{ $errors->has('content') ? 'is-invalid' : '' }}">{{ old('description') }}</textarea>
                        @if($errors->has('description'))
                            <span class="invalid-feedback">{{ $errors->first('description') }}</span>
                        @endif
                    </div>

                    <label>Complex Photos</label>
                    <div class="custom-file mb-3">
                        <input type="file" name="photos[]" class="custom-file-input" id="photos" multiple>
                        <label class="custom-file-label" for="photos">Choose files</label>
                    </div>

                    <input type="submit" value="Add Complex" class="btn btn-primary">
                </form>
            </div>
        </div>

@endsection
