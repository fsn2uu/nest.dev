@extends('_default')

@section('content')

    <h1>
        Reservation for {{ $reservation->traveler->last }}, {{ $reservation->traveler->first }}
    </h1>

    <h2>Details</h2>

    <div class="row">
        <div class="col-xs-12 col-md-12">
            <div class="table-responsive">
                <table class="table table-borderless table-hover">
                    <tbody>
                        <tr>
                            <th scope="row">Arrival Date</th>
                            <td>{{ \Carbon\Carbon::parse($reservation->start_date)->format('m/d/Y') }} ({{ \Carbon\Carbon::parse($reservation->start_date)->format('l') }})</td>
                            <th scope="row">Departure Date</th>
                            <td>{{ \Carbon\Carbon::parse($reservation->end_date)->format('m/d/Y') }} ({{ \Carbon\Carbon::parse($reservation->end_date)->format('l') }})</td>
                        </tr>
                        <tr>
                            <th scope="row">Complex / Unit</th>
                            <td>{{ $reservation->unit->complex ? $reservation->unit->complex->name.' / ' : '' }}{{ $reservation->unit->name }}</td>
                            <th scope="row">Payment Status</th>
                            <td>{{ ucwords($reservation->status) }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Processing Fees</th>
                            <td>${{ number_format($reservation->stripe_fees, 2) }}</td>
                            <th scope="row">Additional Fees</th>
                            <td>$</td>
                        </tr>
                        <tr>
                            <th scope="row">Total Charged</th>
                            <td>${{ number_format($reservation->amount_charged, 2) }}</td>
                            <th scope="row">Total Revenue</th>
                            <td>${{ number_format($reservation->amount_charged - $reservation->stripe_fees, 2) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <h2>Traveler Information</h2>

    @php
        $traveler = $reservation->traveler;
    @endphp
{{ round((($reservation->amount_charged / 100) * 2.5) + .30, 2) }}
    <div class="row mt-5">
        <div class="col-xs-12 col-md-2">
            <img src="{{ Gravatar::src($traveler->email) }}" width="150" style="border-radius:150px;">
        </div>
        <div class="col-xs-12 col-md-10">
            <div class="table-responsive">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <th scope="row">Name</th>
                            <td>{{ $traveler->last }}, {{ $traveler->first }}</td>
                            <th scope="row">Address</th>
                            <td rowspan="{{ $traveler->address2  ? '3' : '2' }}">
                                {{ $traveler->address }}<br>
                                {{ $traveler->address2 ? $traveler->address2.'<br>' : '' }}
                                {{ $traveler->city }}, {{ $traveler->state }} {{ $traveler->zip }}
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Email</th>
                            <td>{{ $traveler->email }}</td>
                        </tr>
                        <tr>
                            <th scope="row">phone</th>
                            <td>{{ $traveler->phone }}</td>
                        </tr>
                        <tr>
                            <th scope="row">alt phone</th>
                            <td>{{ $traveler->phone2 }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
