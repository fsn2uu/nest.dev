<div class="modal fade" id="bankAttachModal" tabindex="-1" role="dialog" aria-labelledby="bankAttachModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bankAttachModalLabel">Attach Your Bank Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>The information in this form is required and must be the owner of your company.</p>
                <p>For security reasons, this information is not stored on our server and cannot be saved & completed in stages.</p>
                <p>All fields are required.</p>
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <div class="form-group">
                            <label for="first_name">first name</label>
                            <input type="text" name="first_name" id="first_name" class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}"
                            value="{{ old('first_name') }}" />
                            @if($errors->has('first_name'))
                                <span class="invalid-feedback">{{ $errors->first('first_name') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="last_name">last name</label>
                            <input type="text" name="last_name" id="last_name" class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}"
                            value="{{ old('last_name') }}" />
                            @if($errors->has('last_name'))
                                <span class="invalid-feedback">{{ $errors->first('last_name') }}</span>
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
                            <label for="city">city</label>
                            <input type="text" name="city" id="city" class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}"
                            value="{{ old('city') }}" />
                            @if($errors->has('city'))
                                <span class="invalid-feedback">{{ $errors->first('city') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="state">state</label>
                            <input type="text" name="state" id="state" class="form-control {{ $errors->has('state') ? 'is-invalid' : '' }}"
                            value="{{ old('state') }}" />
                            @if($errors->has('state'))
                                <span class="invalid-feedback">{{ $errors->first('state') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="postal_code">postal code</label>
                            <input type="text" name="postal_code" id="postal_code" class="form-control {{ $errors->has('postal_code') ? 'is-invalid' : '' }}"
                            value="{{ old('postal_code') }}" />
                            @if($errors->has('postal_code'))
                                <span class="invalid-feedback">{{ $errors->first('postal_code') }}</span>
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
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="tos_acceptance" value="true">
                            <label class="form-check-label" for="tos_acceptance">I Accept the Stripe Connected Account Agreement</label>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <div class="form-group">
                            <label for="email">email</label>
                            <input type="text" name="email" id="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                            value="{{ old('email') }}" />
                            @if($errors->has('email'))
                                <span class="invalid-feedback">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="day">birth day</label>
                            <input type="text" name="day" id="day" class="form-control {{ $errors->has('day') ? 'is-invalid' : '' }}"
                            value="{{ old('day') }}" />
                            @if($errors->has('day'))
                                <span class="invalid-feedback">{{ $errors->first('day') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="month">birth month</label>
                            <input type="text" name="month" id="month" class="form-control {{ $errors->has('month') ? 'is-invalid' : '' }}"
                            value="{{ old('month') }}" />
                            @if($errors->has('month'))
                                <span class="invalid-feedback">{{ $errors->first('month') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="year">birth year</label>
                            <input type="text" name="year" id="year" class="form-control {{ $errors->has('year') ? 'is-invalid' : '' }}"
                            value="{{ old('year') }}" />
                            @if($errors->has('year'))
                                <span class="invalid-feedback">{{ $errors->first('year') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="id_number">last 4 of SSN</label>
                            <input type="text" name="id_number" id="id_number" class="form-control {{ $errors->has('id_number') ? 'is-invalid' : '' }}"
                            value="{{ old('id_number') }}" />
                            @if($errors->has('id_number'))
                                <span class="invalid-feedback">{{ $errors->first('id_number') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="routing_number">routing number</label>
                            <input type="text" name="routing_number" id="routing_number" class="form-control {{ $errors->has('routing_number') ? 'is-invalid' : '' }}"
                            value="{{ old('routing_number') }}" />
                            @if($errors->has('routing_number'))
                                <span class="invalid-feedback">{{ $errors->first('routing_number') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="account_number">account number</label>
                            <input type="text" name="account_number" id="account_number" class="form-control {{ $errors->has('account_number') ? 'is-invalid' : '' }}"
                            value="{{ old('account_number') }}" />
                            @if($errors->has('account_number'))
                                <span class="invalid-feedback">{{ $errors->first('account_number') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="tax_id">tax id</label>
                            <input type="text" name="tax_id" id="tax_id" class="form-control {{ $errors->has('tax_id') ? 'is-invalid' : '' }}"
                            value="{{ old('tax_id') }}" />
                            @if($errors->has('tax_id'))
                                <span class="invalid-feedback">{{ $errors->first('tax_id') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <p>Payment processing services for property managers on Nest are provided by Stripe and are subject to the <a href="https://stripe.com/connect-account/legal" target="_blank">Stripe Connected Account Agreement</a>, which includes the <a href="https://stripe.com/legal" target="_blank">Stripe Terms of Service</a> (collectively, the “Stripe Services Agreement”). By attaching your account or continuing to operate as a property manager on Nest, you agree to be bound by the Stripe Services Agreement, as the same may be modified by Stripe from time to time. As a condition of Nest enabling payment processing services through Stripe, you agree to provide Nest accurate and complete information about you and your business, and you authorize Nest to share it and transaction information related to your use of the payment processing services provided by Stripe.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
