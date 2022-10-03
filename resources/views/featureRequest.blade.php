@extends('_default')

@section('content')

    <h1>Feature Request</h1>

    <p>Have an idea for a new feature?  We're all ears!</p>
    <p>You should also check our Update Roadmap before posting a feature request; it may already be in the works!</p>

    <form action="">
        @csrf
        <div class="form-group">
            <label for="suggestion">your suggestion</label>
            <textarea name="suggestion" id="suggestion" cols="30" rows="10" class="form-control
            {{ $errors->has('content') ? 'is-invalid' : '' }}">{{ old('suggestion') }}</textarea>
            @if($errors->has('suggestion'))
                <span class="invalid-feedback">{{ $errors->first('suggestion') }}</span>
            @endif
        </div>

        <input type="submit" value="Submit Request" class="btn btn-primary">
    </form>

    <p><small>New features are added at Nest's discression.  Features must benefit the entire Nest family and must not require
        drastic changes to other functionality to implement.  Submitting a feature request does not obligate Nest to implement
        your suggestion, though we will take it under advisement.</small></p>

@endsection
