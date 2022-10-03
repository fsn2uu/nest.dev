@extends('_default')

@section('content')

    <h1>Sign-up</h1>

    <form action="" method="post" class="form" id="payment-form">
        @csrf

        <h3>Your Information</h3>
        <div class="form-group">
            <label for="your_name">your name</label>
            <input type="text" name="your_name" id="your_name" class="form-control {{ $errors->has('your_name') ? 'is-invalid' : '' }}"
            value="{{ old('your_name') }}" />
            @if($errors->has('your_name'))
                <span class="invalid-feedback">{{ $errors->first('your_name') }}</span>
            @endif
        </div>

        <div class="form-group">
            <label for="your_email">your email</label>
            <input type="text" name="your_email" id="your_email" class="form-control {{ $errors->has('your_email') ? 'is-invalid' : '' }}"
            value="{{ old('your_email') }}" />
            @if($errors->has('your_email'))
                <span class="invalid-feedback">{{ $errors->first('your_email') }}</span>
            @endif
        </div>

        <div class="form-group">
            <label for="your_phone">your phone</label>
            <input type="text" name="your_phone" id="your_phone" class="form-control {{ $errors->has('your_phone') ? 'is-invalid' : '' }}"
            value="{{ old('your_phone') }}" />
            @if($errors->has('your_phone'))
                <span class="invalid-feedback">{{ $errors->first('your_phone') }}</span>
            @endif
        </div>

        <h3>Company Information</h3>

        <div class="form-group">
            <label for="company_name">company name</label>
            <input type="text" name="company_name" id="company_name" class="form-control {{ $errors->has('company_name') ? 'is-invalid' : '' }}"
            value="{{ old('company_name') }}" />
            @if($errors->has('company_name'))
                <span class="invalid-feedback">{{ $errors->first('company_name') }}</span>
            @endif
        </div>

        <div class="form-group">
            <label for="company_phone">company phone</label>
            <input type="text" name="company_phone" id="company_phone" class="form-control {{ $errors->has('company_phone') ? 'is-invalid' : '' }}"
            value="{{ old('company_phone') }}" />
            @if($errors->has('company_phone'))
                <span class="invalid-feedback">{{ $errors->first('company_phone') }}</span>
            @endif
        </div>

        <div class="form-group">
            <label for="company_address">company address</label>
            <input type="text" name="company_address" id="company_address" class="form-control {{ $errors->has('company_address') ? 'is-invalid' : '' }}"
            value="{{ old('company_address') }}" />
            @if($errors->has('company_address'))
                <span class="invalid-feedback">{{ $errors->first('company_address') }}</span>
            @endif
        </div>

        <div class="form-group">
            <label for="company_address2">company address 2</label>
            <input type="text" name="company_address2" id="company_address2" class="form-control {{ $errors->has('company_address2') ? 'is-invalid' : '' }}"
            value="{{ old('company_address2') }}" />
            @if($errors->has('company_address2'))
                <span class="invalid-feedback">{{ $errors->first('company_address2') }}</span>
            @endif
        </div>

        <div class="form-group">
            <label for="company_city">company city</label>
            <input type="text" name="company_city" id="company_city" class="form-control {{ $errors->has('company_city') ? 'is-invalid' : '' }}"
            value="{{ old('company_city') }}" />
            @if($errors->has('company_city'))
                <span class="invalid-feedback">{{ $errors->first('company_city') }}</span>
            @endif
        </div>

        <div class="form-group">
            <label for="company_state">company state</label>
            <select name="company_state" id="company_state" class="form-control {{ $errors->has('company_state') ? 'has-error' : '' }}">
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
            @if($errors->has('company_state'))
                <span class="invalid-feedback">{{ $errors->first('company_state') }}</span>
            @endif
        </div>

        <div class="form-group">
            <label for="company_zip">company zip</label>
            <input type="text" name="company_zip" id="company_zip" class="form-control {{ $errors->has('company_zip') ? 'is-invalid' : '' }}"
            value="{{ old('company_zip') }}" />
            @if($errors->has('company_zip'))
                <span class="invalid-feedback">{{ $errors->first('company_zip') }}</span>
            @endif
        </div>

        <div class="form-group">
            <label for="company_url">company url</label>
            <input type="text" name="company_url" id="company_url" class="form-control {{ $errors->has('company_url') ? 'is-invalid' : '' }}"
            value="{{ old('company_url') }}" />
            @if($errors->has('company_url'))
                <span class="invalid-feedback">{{ $errors->first('company_url') }}</span>
            @endif
        </div>

        <div class="form-group">
            <label for="plan">plan</label>
            <select name="plan" id="plan" class="form-control {{ $errors->has('plan') ? 'has-error' : '' }}">
                <option value="hobbyist" {{ @$_GET['plan'] && strtolower(@$_GET['plan']) == 'hobbyist' ? 'selected' : '' }}>Hobbyist</option>
                <option value="beginner" {{ @$_GET['plan'] && strtolower(@$_GET['plan']) == 'beginner' ? 'selected' : '' }}>Beginner</option>
                <option value="pro" {{ @$_GET['plan'] && strtolower(@$_GET['plan']) == 'pro' ? 'selected' : '' }}>Pro</option>
                <option value="enterprise" {{ @$_GET['plan'] && strtolower(@$_GET['plan']) == 'enterprise' ? 'selected' : '' }}>Enterprise</option>
            </select>
            @if($errors->has('plan'))
                <span class="invalid-feedback">{{ $errors->first('plan') }}</span>
            @endif
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="help me obi-wan!" name="need_help" id="need_help">
            <label class="form-check-label" for="need_help">
                I need help importing my properties!
            </label>
        </div>

        <h3>Payment Information</h3>

        <div class="form-group">
            <label for="card-element">Credit Card Information</label>
            <div id="card-element">
             <!-- A Stripe Element will be inserted here. -->
           </div>

           <!-- Used to display Element errors. -->
           <div id="card-errors" role="alert"></div>
            @if($errors->has('card-element'))
                <span class="invalid-feedback">{{ $errors->first('card-element') }}</span>
            @endif
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="tos accepted" name="tos_accepted" id="acceptsTOS" required>
            <label class="form-check-label" for="acceptsTOS">
                I verify that I have read and accept the <a href="">Terms of Service</a>.
            </label>
        </div>

        <input type="submit" value="Sign Up" class="btn btn-lg btn-primary mt-3">

    </form>

@endsection

@section('scripts')

    <script src="https://js.stripe.com/v3/"></script>

    <script>
        jQuery(function(){
            var stripe = Stripe('{{ env('STRIPE_KEY') }}');
            var elements = stripe.elements();

            var style = {
                base: {
                    // Add your base input styles here. For example:
                    fontSize: '16px',
                    color: "#32325d",
                }
            };
            var card = elements.create('card', {style: style});
            card.mount('#card-element');

            card.addEventListener('change', function(event) {
              var displayError = document.getElementById('card-errors');
              if (event.error) {
                displayError.textContent = event.error.message;
              } else {
                displayError.textContent = '';
              }
            });

            var form = document.getElementById('payment-form');
            form.addEventListener('submit', function(event) {
              event.preventDefault();

              stripe.createToken(card).then(function(result) {
                if (result.error) {
                  // Inform the customer that there was an error.
                  var errorElement = document.getElementById('card-errors');
                  errorElement.textContent = result.error.message;
                } else {
                  // Send the token to your server.
                  stripeTokenHandler(result.token);
                }
              });
            });

            function stripeTokenHandler(token) {
              // Insert the token ID into the form so it gets submitted to the server
              var form = document.getElementById('payment-form');
              var hiddenInput = document.createElement('input');
              hiddenInput.setAttribute('type', 'hidden');
              hiddenInput.setAttribute('name', 'stripeToken');
              hiddenInput.setAttribute('value', token.id);
              form.appendChild(hiddenInput);

              // Submit the form
              form.submit();
            }
        })
    </script>

@endsection
