@extends('_default')

@section('content')

    <h1>
        Create a Fee
    </h1>

    <div class="col-xs-12 col-md-6">
        <form action="" method="post" class="form">
            @csrf
            <div class="form-group">
                <label for="title">title</label>
                <input type="text" name="title" id="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                value="{{ old('title') }}" />
                @if($errors->has('title'))
                    <span class="invalid-feedback">{{ $errors->first('title') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="complex_id">complex</label>
                <select name="complex_id" id="complex_id" class="form-control {{ $errors->has('complex_id') ? 'has-error' : '' }}">
                    <option value=""></option>
                    @foreach (\Auth::user()->company->complexes as $complex)
                        <option value="{{ $complex->id }}">{{ $complex->name }}</option>
                    @endforeach
                </select>
                <small class="form-text text-muted">Select a complex if this fee is specific to an entire complex.</small>
                @if($errors->has('complex_id'))
                    <span class="invalid-feedback">{{ $errors->first('complex_id') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="unit_id">unit</label>
                <select name="unit_id" id="unit_id" class="form-control {{ $errors->has('unit_id') ? 'has-error' : '' }}">
                    <option value=""></option>
                    @foreach (\Auth::user()->company->units as $unit)
                        <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                    @endforeach
                </select>
                <small class="text-muted form-text">Select a unit if this fee is specific to a unit.</small>
                @if($errors->has('unit_id'))
                    <span class="invalid-feedback">{{ $errors->first('unit_id') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="amount">fee amount</label>
                <input type="text" name="amount" id="amount" class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}"
                value="{{ old('amount') }}" />
                @if($errors->has('amount'))
                    <span class="invalid-feedback">{{ $errors->first('amount') }}</span>
                @endif
            </div>

            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" name="per_night" value="1" id="per_night">
                <label class="form-check-label" for="per_night">Per Night</label>
                <small class="text-muted form-text">Check here to charge this fee every night of the stay.</small>
            </div>

            <input type="submit" value="Add Fee" class="btn btn-primary">
        </form>
    </div>

@endsection
