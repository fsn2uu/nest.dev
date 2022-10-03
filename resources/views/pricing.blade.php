@extends('_default')

@section('content')
<h1>Pricing</h1>

<div class="card-deck mb-3 text-center">
    <div class="card mb-4 shadow-sm">
        <div class="card-header">
            <h4 class="my-0 font-weight-normal">Hobbyist</h4>
        </div>
        <div class="card-body">
            <h1 class="card-title pricing-card-title">$15 <small class="text-muted">/ mo</small></h1>
            <ul class="list-unstyled mt-3 mb-4">
                <li>Up to 3 Complexes / Units</li>
                <li>5 Pictures Per Complex / Unit</li>
                <li>Up to 5 Managers</li>
                <li>WordPress Plugin</li>
                <li>API Access</li>
                <li>Email Support</li>
            </ul>
            <a class="btn btn-lg btn-block btn-primary" href="{{ route('signup', ['plan' => 'hobbyist']) }}">Get Started</a>
        </div>
    </div>
    <div class="card mb-4 shadow-sm">
        <div class="card-header">
            <h4 class="my-0 font-weight-normal">Beginner</h4>
        </div>
        <div class="card-body">
            <h1 class="card-title pricing-card-title">$60 <small class="text-muted">/ mo</small></h1>
            <ul class="list-unstyled mt-3 mb-4">
                <li>Up to 10 Complexes / Units</li>
                <li>10 Pictures Per Complex / Unit</li>
                <li>Up to 10 Managers</li>
                <li>WordPress Plugin</li>
                <li>API Access</li>
                <li>Email Support</li>
            </ul>
            <a class="btn btn-lg btn-block btn-primary" href="{{ route('signup', ['plan' => 'beginner']) }}">Get started</a>
        </div>
    </div>
    <div class="card mb-4 shadow-sm">
        <div class="card-header">
            <h4 class="my-0 font-weight-normal">Pro</h4>
        </div>
        <div class="card-body">
            <h1 class="card-title pricing-card-title">$120 <small class="text-muted">/ mo</small></h1>
            <ul class="list-unstyled mt-3 mb-4">
                <li>Up to 30 Complexes / Units</li>
                <li>30 Pictures Per Complex / Unit</li>
                <li>Up to 15 Managers</li>
                <li>WordPress Plugin</li>
                <li>API Access</li>
                <li>Email Support</li>
            </ul>
            <a class="btn btn-lg btn-block btn-primary" href="{{ route('signup', ['plan' => 'pro']) }}">Get Started</a>
        </div>
    </div>
    <div class="card mb-4 shadow-sm">
        <div class="card-header">
            <h4 class="my-0 font-weight-normal">Enterprise</h4>
        </div>
        <div class="card-body">
            <h1 class="card-title pricing-card-title">$210 <small class="text-muted">/ mo</small></h1>
            <ul class="list-unstyled mt-3 mb-4">
                <li>No Complex / Unit Cap</li>
                <li>50 Pictures Per Complex / Unit</li>
                <li>Unlimited Managers</li>
                <li>WordPress Plugin</li>
                <li>API Access</li>
                <li>Phone & Email Support</li>
            </ul>
            <a class="btn btn-lg btn-block btn-primary" href="{{ route('signup', ['plan' => 'enterprise']) }}">Get Started</a>
        </div>
    </div>
</div>

<p>No hidden fees. Up-front pricing that makes sense.</p>

<p>Need help adding your properties? We provide on-boarding assistance at a reasonable hourly rate! Just select "I need help getting started!" when you sign up.</p>

<h2>Questions? Contact us!</h2>

<form action="">
    @csrf
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <div class="form-group">
                <label for="name">name</label>
                <input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ old('name') }}" />
                @if($errors->has('name'))
                    <span class="invalid-feedback">{{ $errors->first('name') }}</span>
                    @endif
            </div>

            <div class="form-group">
                <label for="phone">phone</label>
                <input type="text" name="phone" id="phone" class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" value="{{ old('phone') }}" />
                @if($errors->has('phone'))
                    <span class="invalid-feedback">{{ $errors->first('phone') }}</span>
                    @endif
            </div>
        </div>
        <div class="col-xs-12 col-md-6">
            <div class="form-group">
                <label for="email">email</label>
                <input type="text" name="email" id="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email') }}" />
                @if($errors->has('email'))
                    <span class="invalid-feedback">{{ $errors->first('email') }}</span>
                    @endif
            </div>

            <div class="form-group">
                <label for="subject">subject</label>
                <select name="subject" id="subject" class="form-control {{ $errors->has('subject') ? 'has-error' : '' }}">
                    <option>Questions about Nest VRS</option>
                </select>
                @if($errors->has('subject'))
                    <span class="invalid-feedback">{{ $errors->first('subject') }}</span>
                    @endif
            </div>
        </div>
    </div>
    <div class="col-xs-12 text-center">
        <div class="form-group">
            <label for="comment">comment</label>
            <textarea name="comment" id="comment" cols="30" rows="10" class="form-control
                {{ $errors->has('content') ? 'is-invalid' : '' }}">{{ old('comment') }}</textarea>
            @if($errors->has('comment'))
                <span class="invalid-feedback">{{ $errors->first('comment') }}</span>
                @endif
        </div>
        <input type="submit" value="Contact Us" class="btn btn-lg btn-primary">
    </div>
</form>
@endsection
