@extends('_default')

@section('content')

    <h1>Complex Limit Reached</h1>
    <p>It looks like you've reached the maximum number of complexes allowed on the plan you're subscribed to.  You are currently subscribed to the <strong>{{ $current }}</strong> plan.</p>
    <p>Don't worry, though, there's definitely a plan that can handle more complexes:</p>

    <div class="card-deck mb-3 text-center">
        @if ($current == 'hobbist')
            <div class="card mb-4 shadow-sm">
                <div class="card-header">
                    <h4 class="my-0 font-weight-normal">Beginner</h4>
                </div>
                <div class="card-body">
                    <h1 class="card-title pricing-card-title">$60 <small class="text-muted">/ mo</small></h1>
                    <ul class="list-unstyled mt-3 mb-4">
                        <li>Up to 10 Complexes / Units</li>
                        <li>10 Pictures Per Complex / Unit</li>
                        <li>Up to 5 Managers</li>
                        <li>WordPress Plugin</li>
                        <li>API Access</li>
                        <li>Email Support</li>
                    </ul>
                    <a class="btn btn-lg btn-block btn-primary" href="{{ route('plan.upgrade', ['plan' => 'beginner']) }}">Upgrade Now</a>
                </div>
            </div>
        @endif
        @if ($current == 'hobbist' || $current == 'beginner')
            <div class="card mb-4 shadow-sm">
                <div class="card-header">
                    <h4 class="my-0 font-weight-normal">Pro</h4>
                </div>
                <div class="card-body">
                    <h1 class="card-title pricing-card-title">$120 <small class="text-muted">/ mo</small></h1>
                    <ul class="list-unstyled mt-3 mb-4">
                        <li>Up to 30 Complexes / Units</li>
                        <li>30 Pictures Per Complex / Unit</li>
                        <li>Up to 8 Managers</li>
                        <li>WordPress Plugin</li>
                        <li>API Access</li>
                        <li>Email Support</li>
                    </ul>
                    <a class="btn btn-lg btn-block btn-primary" href="{{ route('plan.upgrade', ['plan' => 'pro']) }}">Upgrade Now</a>
                </div>
            </div>
        @endif
        @if ($current == 'hobbist' || $current == 'beginner' || $current == 'pro')

        @endif
        <div class="card mb-4 shadow-sm">
            <div class="card-header">
                <h4 class="my-0 font-weight-normal">Enterprise</h4>
            </div>
            <div class="card-body">
                <h1 class="card-title pricing-card-title">$210 <small class="text-muted">/ mo</small></h1>
                <ul class="list-unstyled mt-3 mb-4">
                    <li>No Complex / Unit Cap</li>
                    <li>50 Pictures Per Complex / Unit</li>
                    <li>Up to 15 Managers</li>
                    <li>WordPress Plugin</li>
                    <li>API Access</li>
                    <li>Phone & Email Support</li>
                </ul>
                <a class="btn btn-lg btn-block btn-primary" href="{{ route('plan.upgrade', ['plan' => 'enterprise']) }}">Upgrade Now</a>
            </div>
        </div>
    </div>

@endsection
