@extends('_default')

@section('content')

    <h1>
        {{ $traveler->first }} {{ $traveler->last }}
        @if (\Auth::user()->canUpdateTravelers())
            <a href="{{ route('travelers.edit', $traveler->id) }}" class="btn btn-primary float-right">Edit Traveler</a>
        @endif
    </h1>

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

    <h2>Reservation History</h2>
    @if ($traveler->reservations->count() > 0)
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>complex / unit</th>
                        <th>arrival date</th>
                        <th>departure date</th>
                        <th>amount paid</th>
                        <th></th>
                    </tr>
                </thead>
                @foreach ($traveler->reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->unit->has('complex') ? $reservation->unit->complex->name .' / ' : '' }}{{ $reservation->unit->name }}</td>
                        <td>{{ \Carbon\Carbon::parse($reservation->start_date)->format('m/d/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($reservation->end_date)->format('m/d/Y') }}</td>
                        <td>${{ number_format($reservation->amount_charged, 2) }}</td>
                        <td></td>
                    </tr>
                @endforeach
            </table>
        </div>
    @else
        <p>There are no reservations to display.</p>
    @endif

@endsection
