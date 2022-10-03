@extends('_default')

@section('content')

    <h1>
        Add a Rate Table
    </h1>

    <form action="" class="col-xs-12 col-md-9" method="post">
        @csrf
        <div class="form-group">
            <label for="name">name</label>
            <input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
            value="{{ old('name') }}" />
            @if($errors->has('name'))
                <span class="invalid-feedback">{{ $errors->first('name') }}</span>
            @endif
        </div>

        <div id="typeSelector">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="type" id="global" value="global" checked>
                <label class="form-check-label" for="global">
                    Global Rate Table
                </label>
                <small class="form-text text-muted">Used if no complex or unit is specified.</small>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="radio" name="type" id="complex" value="complex">
                <label class="form-check-label" for="complex">
                    Complex Rate Table
                </label>
                <small class="form-text text-muted">Used if no unit is specified, even if a global rate table exists.</small>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="radio" name="type" id="unit" value="unit">
                <label class="form-check-label" for="unit">
                    Unit Rate Table
                </label>
                <small class="form-text text-muted">Used even if a global or complex rate table exists.</small>
            </div>
        </div>

        <div id="rows">
            <div class="form-row mt-3">
                <div class="col-5">
                    <input type="text" name="rates[0][name]" class="form-control" placeholder="Name" />
                </div>
                <div class="col">
                    <input type="text" name="rates[0][start_date]" class="form-control datepicker" placeholder="Start Date">
                </div>
                <div class="col">
                    <input type="text" name="rates[0][end_date]" class="form-control datepicker" placeholder="End Date">
                </div>
                <div class="col input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">$</div>
                    </div>
                    <input type="text" name="rates[0][amount]" class="form-control" placeholder="Amount">
                </div>
            </div>
        </div>

        <div class="form-row mt-3">
            <div class="col-xs-12 col-md-12">
                <p class="form-text text-muted">Rows with no amount will be ignored.</p>
                <a href="" class="btn btn-success float-right adder" style="vertical-align:middle;">
                    <i class="far fa-plus-square"></i> Add a Row
                </a>
            </div>
        </div>

        <input type="submit" value="Add Rate Table" class="btn btn-primary">
    </form>

@endsection

@section('scripts')

    <script>
        $('body').on('focus', '.datepicker', function(){
            $(this).datepicker()
        })

        $('input:radio').on('change', function(e){
            var type = $(this).val()

            if(type == 'global')
            {
                $('#complexSelector, #unitSelector').remove()
            }
            else if(type == 'complex')
            {
                $('#unitSelector').remove()

                var htm = '<div class="form-group" id="complexSelector"><label for="">Complex</label><select name="complex_id" id="complex_id" class="form-control" required><option value="">Select a Complex</option>'
                htm += '</select></div>'

                $('#typeSelector').after(htm)

                axios.get('/api/v1/complexes?api_token={{ \Auth::user()->company->api_token }}&ignore_status=true')
                    .then(function(response){
                        $.each(response.data, function(k, v){
                            $('#complex_id').append('<option value="'+v.id+'">'+v.name+'</option>')
                        })
                    })
                    .catch(function(error){
                        console.log(error)
                    })
            }
            else if(type == 'unit')
            {
                $('#complexSelector').remove()

                var htm = '<div class="form-group" id="unitSelector"><label for="">Unit</label><select name="unit_id" id="unit_id" class="form-control" required><option value="">Select a Unit</option>'
                htm += '</select></div>'

                $('#typeSelector').after(htm)

                axios.get('/api/v1/units?api_token={{ \Auth::user()->company->api_token }}&ignore_status=true')
                    .then(function(response){
                        $.each(response.data, function(k, v){
                            $('#unit_id').append('<option value="'+v.id+'">'+v.name+'</option>')
                        })
                    })
                    .catch(function(error){
                        console.log(error)
                    })
            }
        })

        $('.adder').on('click', function(e){
            e.preventDefault()
            var counter = $('#rows .col-5').length
            var htm = '<div class="form-row mt-3"><div class="col-5"><input type="text" name="rates['+counter+'][name]" class="form-control" placeholder="Name" /></div><div class="col">'
            htm += '<input type="text" name="rates['+counter+'][start_date]" class="form-control datepicker" placeholder="Start Date"></div><div class="col">'
            htm += '<input type="text" name="rates['+counter+'][end_date]" class="form-control datepicker" placeholder="End Date"></div><div class="col input-group">'
            htm += '<div class="input-group-prepend"><div class="input-group-text">$</div></div>'
            htm += '<input type="text" name="rates['+counter+'][amount]" class="form-control" placeholder="Amount"></div></div>'

            $('#rows').append(htm)
        })
    </script>
@endsection
