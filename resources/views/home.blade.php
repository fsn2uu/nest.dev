@extends('_default')

@section('content')

    <h2>Nest works for you!</h2>
    <p>Nest is a vacation rental management system that is easy to use and packed full of features others charge an arm and a leg for.
        Want to take credit cards?  That's included.  What about checks?  Included.  API access for your site?  Included.  Pricing tier
        doesn't matter when it comes to features; every tier has the same features.
    </p>

    <h2>Nest is simpler!</h2>
    <p>Nest is designed to be easier to use than similar products.  There's a lot going on under the hood, so you can focus on what matters to you
        and your business instead of learning hyper-complicated software that nickle-and-dime's you without giving you what you need.</p>

    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-12 text-center">
                <h2 class="m-auto">What are you waiting for?</h2>
                <a href="{{ route('pricing') }}" class="btn btn-outline-primary mt-3">Get Started Today!</a>
            </div>
        </div>
    </div>

@endsection
