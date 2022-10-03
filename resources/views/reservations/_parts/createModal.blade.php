<div class="modal fade" id="reservationModal" tabindex="-1" role="dialog" aria-labelledby="reservationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reservationModalLabel">Create a Reservation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="type" id="type-traveler" value="traveler" checked>
                    <label class="form-check-label" for="type-traveler">
                        Reservation for a Traveler
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="type" id="type-maintenance" value="maintenance">
                    <label class="form-check-label" for="type-maintenance">
                        Reserve for Maintenance
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="type" id="type-owner" value="owner">
                    <label class="form-check-label" for="type-owner">
                        Reserve for Owner
                    </label>
                </div>

                <div class="form-group">
                    <label for="start_date">start_date</label>
                    <input type="text" name="start_date" id="start_date" class="form-control datepicker {{ $errors->has('start_date') ? 'is-invalid' : '' }}"
                    value="{{ old('start_date') }}" />
                    @if($errors->has('start_date'))
                        <span class="invalid-feedback">{{ $errors->first('start_date') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="end_date">end_date</label>
                    <input type="text" name="end_date" id="end_date" class="form-control datepicker {{ $errors->has('end_date') ? 'is-invalid' : '' }}"
                    value="{{ old('end_date') }}" />
                    @if($errors->has('end_date'))
                        <span class="invalid-feedback">{{ $errors->first('end_date') }}</span>
                    @endif
                </div>

                <div id="traveler-fields">
                    <div class="form-group">
                        <label for="traveler_id">traveler</label>
                        <select name="traveler_id" id="traveler_id" class="form-control {{ $errors->has('traveler_id') ? 'has-error' : '' }}">
                            <option value="">Select a Traveler</option>
                            <option value="NEW">Create a New Traveler</option>
                            @foreach (\Auth::user()->company->travelers as $traveler)
                                <option value="{{ $traveler->id }}">{{ $traveler->last }}, {{ $traveler->first }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('traveler_id'))
                            <span class="invalid-feedback">{{ $errors->first('traveler_id') }}</span>
                        @endif
                    </div>

                    <div id="new-traveler-fields">
                        <div class="form-group">
                            <label for="traveler_first">traveler first name</label>
                            <input type="text" name="traveler_first" id="traveler_first" class="form-control {{ $errors->has('traveler_first') ? 'is-invalid' : '' }}"
                            value="{{ old('traveler_first') }}" />
                            @if($errors->has('traveler_first'))
                                <span class="invalid-feedback">{{ $errors->first('traveler_first') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="traveler_last">traveler last name</label>
                            <input type="text" name="traveler_last" id="traveler_last" class="form-control {{ $errors->has('traveler_last') ? 'is-invalid' : '' }}"
                            value="{{ old('traveler_last') }}" />
                            @if($errors->has('traveler_last'))
                                <span class="invalid-feedback">{{ $errors->first('traveler_last') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="traveler_email">traveler email</label>
                            <input type="text" name="traveler_email" id="traveler_email" class="form-control {{ $errors->has('traveler_email') ? 'is-invalid' : '' }}"
                            value="{{ old('traveler_email') }}" />
                            @if($errors->has('traveler_email'))
                                <span class="invalid-feedback">{{ $errors->first('traveler_email') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="traveler_phone">traveler phone</label>
                            <input type="text" name="traveler_phone" id="traveler_phone" class="form-control {{ $errors->has('traveler_phone') ? 'is-invalid' : '' }}"
                            value="{{ old('traveler_phone') }}" />
                            @if($errors->has('traveler_phone'))
                                <span class="invalid-feedback">{{ $errors->first('traveler_phone') }}</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div id="payment-method-fields">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment" id="payment-card" value="payment-card" checked>
                        <label class="form-check-label" for="payment-card">
                            Pay by Card
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment" id="payment-other" value="payment-other">
                        <label class="form-check-label" for="payment-other">
                            Pay by Cash / Check / Other
                        </label>
                    </div>
                </div>

                <div id="credit-card-fields">
                    <div class="form-group">
                        <label for="card">card #</label>
                        <input type="text" name="card" id="card" class="form-control {{ $errors->has('card') ? 'is-invalid' : '' }}"
                        value="{{ old('card') }}" />
                        @if($errors->has('card'))
                            <span class="invalid-feedback">{{ $errors->first('card') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="exp_mo">Expiration Month</label>
                        <input type="text" name="exp_mo" id="exp_mo" class="form-control {{ $errors->has('exp_mo') ? 'is-invalid' : '' }}"
                        value="{{ old('exp_mo') }}" />
                        @if($errors->has('exp_mo'))
                            <span class="invalid-feedback">{{ $errors->first('exp_mo') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="exp_yr">Expiration Year</label>
                        <input type="text" name="exp_yr" id="exp_yr" class="form-control {{ $errors->has('exp_yr') ? 'is-invalid' : '' }}"
                        value="{{ old('exp_yr') }}" />
                        @if($errors->has('exp_yr'))
                            <span class="invalid-feedback">{{ $errors->first('exp_yr') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="cvv">CVV</label>
                        <input type="text" name="cvv" id="cvv" class="form-control {{ $errors->has('cvv') ? 'is-invalid' : '' }}"
                        value="{{ old('cvv') }}" />
                        @if($errors->has('cvv'))
                            <span class="invalid-feedback">{{ $errors->first('cvv') }}</span>
                        @endif
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Create Reservation</button>
            </div>
        </div>
    </div>
</div>

@prepend('scriptsStack')

    <script>
        $(function(){
            $('[name=type]').on('change', function(){
                var type = $('input[name=type]:checked').val()

                if(type == 'traveler')
                {
                    $('#maintenance-fields').hide()
                    $('#traveler-fields, #payment-method-fields, #credit-card-fields').show()
                }

                if(type == 'maintenance')
                {
                    $('#payment-method-fields, #credit-card-fields, #traveler-fields').hide()
                    $('#maintenance-fields').show()
                }

                if(type == 'owner')
                {
                    $('#payment-method-fields, #credit-card-fields, #traveler-fields, #maintenance-fields').hide()
                }
            })

            $('[name=payment]').on('change', function(){
                var payment = $('input[name=payment]:checked').val()

                if(payment == 'payment-other')
                {
                    $('#credit-card-fields').hide()
                }

                if(payment == 'payment-card')
                {
                    $('#credit-card-fields').show()
                }
            })

            $('#traveler_id').on('change', function(){
                var traveler_id = $('#traveler_id').val()
                if(traveler_id == 'NEW')
                {}
            })

            $('.datepicker').datepicker()
        })
    </script>

@endprepend
