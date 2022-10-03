@extends('_default')

@section('content')

    <h1>My Company</h1>

    <h3>
        General Information
        <a href="" class="float-right" data-toggle="modal" data-target="#infoModal"><i class="far fa-edit"></i></a>
    </h3>
    <div class="container mb-5">
        <div class="row">
            <div class="col-xs-12 col-md-6">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <img src="storage/{{ $company->logo }}" alt="" style="max-height:195px;">
                    </div>
                </div>

            </div>
            <div class="col-xs-12 col-md-6">
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-3">
                        <strong>Company Name</strong>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-3">
                        {{ $company->name }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-3">
                        <strong>Address</strong>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-3">
                        {{ $company->address }}<br>
                        {{ $company->address2 ? $company->address2.'<br>' : ''}}
                        {{ $company->city }}, {{ $company->state }} {{ $company->zip }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-3">
                        <strong>Phone</strong>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-3">
                        {{ $company->phone }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-3">
                        <strong>Phone 2</strong>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-3">
                        {{ $company->phone2 }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-3">
                        <strong>Toll Free</strong>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-3">
                        {{ $company->toll_free }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-3">
                        <strong>Website</strong>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-3">
                        {{ $company->website }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <h3>
        Nest Plan
        <a href="" class="float-right"><i class="far fa-edit"></i></a>
    </h3>
    <div class="container mb-5">
        Current Plan:  {{ $package['nickname'] }}<br>
        Next Payment:  On {{ \Carbon\Carbon::parse($plan['subscriptions']['data'][0]['current_period_end'])->format('Y-m-d') }}, your {{ $plan['sources']['data'][0]['brand'] }} ending in {{ $plan['sources']['data'][0]['last4'] }} will be charged ${{ number_format($package['amount']/100, 2) }}
    </div>

    <h3>
        Payout Information
        <a href="" class="float-right" data-toggle="modal" data-target="#bankAttachModal"><i class="far fa-edit"></i></a>
    </h3>
    <div class="container mb-5">
        @if (!is_null($bank))
            Payouts made to: {{ $bank['bank_name'] }}
        @else
            <p>You haven't attached your bank account yet.  Payouts cannot be made until your bank account is attached.</p>
            <a href="" class="btn btn-primary" data-toggle="modal" data-target="#bankAttachModal">Attach Bank Account</a>
            @include('companies._parts.attachAccount')
        @endif
    </div>

    <h3>
        API Key
        <a href="" class="float-right"><i class="far fa-edit"></i></a>
    </h3>
    <div class="container mb-5">
        <p>API Token:  <input type="text" class="form-control col-md-6" style="display:inline-block;" id="api_token_string" readonly value="{{ $company->api_token }}"> <a href="" style="display:inline-block;" class="btn btn-outline-secondary ml-3" id="tokenCopy">Copy to Clipboard</a></p>
    </div>

    @include('companies._parts.infoModal')

@endsection

@section('scripts')

    <script>
    $(function(){
        $('#tokenCopy').on('click', function(e){
            e.preventDefault()
            var copyText = document.getElementById('api_token_string')
            copyText.select()
            document.execCommand("copy")
            alert('Copied to clipboard!')
        })
    })
    </script>

@endsection
