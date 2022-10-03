@extends('_default')

@section('content')

    <h1>
        Reservations
        <a href="" class="btn btn-outline-primary float-right search-light">Search</a>
        <a href="" class="btn btn-light float-right" alt="Calendar View" title="Calendar View"><i class="far fa-calendar-alt"></i></a>
        <a href="" class="btn btn-light float-right" alt="List View" title="List View"><i class="fas fa-list"></i></a>
    </h1>

    <div class="container search-hidden" id="search-form">
        <div class="row">
            [SEARCH FORM GOES HERE]
        </div>
    </div>

    @if ($reservations->count() > 0)
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>traveler</th>
                        <th>complex / unit</th>
                        <th>arrival date</th>
                        <th>departure date</th>
                        <th>amount paid</th>
                        <th></th>
                    </tr>
                </thead>
                @foreach ($reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->traveler->last }}, {{ $reservation->traveler->first }}</td>
                        <td>{{ $reservation->unit->has('complex') ? $reservation->unit->complex->name .' / ' : '' }}{{ $reservation->unit->name }}</td>
                        <td>{{ \Carbon\Carbon::parse($reservation->start_date)->format('m/d/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($reservation->end_date)->format('m/d/Y') }}</td>
                        <td>${{ number_format($reservation->amount_charged, 2) }}</td>
                        <td>
                            <a href="{{ route('reservations.show', $reservation->id) }}" class="mr-2"><i class="fas fa-eye fa-lg"></i></a>
                            <a href="{{ route('reservations.edit', $reservation->id) }}" class="mr-2"><i class="fas fa-edit fa-lg"></i></a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    @else
        <p>There are no reservations to display.</p>
    @endif

@endsection
