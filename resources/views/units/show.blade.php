@extends('_default')

@section('content')

    <h1>
        {{ $unit->name }}
        @if (\Auth::user()->canUpdateComplexes())
            <a href="{{ route('units.edit', $unit->id) }}" class="btn btn-primary float-right">Edit Unit</a>
        @endif
        @if (\Auth::user()->canCreateReservations())
            <a href="" class="btn btn-outline-success float-right mr-2" data-toggle="modal" data-target="#reservationModal">Create Reservation</a>
        @endif
    </h1>

    <ul class="nav nav-tabs mt-3" id="unitInfo" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="reservations-tab" data-toggle="tab" href="#reservations" role="tab" aria-controls="reservations" aria-selected="true">Reservations</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="info-tab" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="false">Info</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="rates-tab" data-toggle="tab" href="#rates" role="tab" aria-controls="rates" aria-selected="false">Rates & Fees</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="photos-tab" data-toggle="tab" href="#photos" role="tab" aria-controls="photos" aria-selected="false">Photos</a>
        </li>
    </ul>

    <div class="tab-content mt-2" id="unitInfoContent">
        <div class="tab-pane fade show active" id="reservations" role="tabpanel" aria-labelledby="reservations-tab">
            reservations go here when they're fleshed out
        </div>

        <div class="tab-pane fade" id="info" role="tabpanel" aria-labelledby="info-tab">
            <div class="row">
                <div class="col-xs-12 col-md-4">
                    <h4>Location Information</h4>
                    <strong>Address:</strong><br>
                    @if ($unit->complex)
                        {{ $unit->complex->address }}<br>
                        {{ $unit->complex->address2 ? $unit->complex->address2.'<br>' : '' }}
                        {{ $unit->complex->city }}, {{ $unit->complex->state }} {{ $unit->complex->zip }}<br><br>
                        @php ($addr = str_replace(' ', '+', $unit->complex->address).'+'.str_replace(' ', '+', $unit->complex->city).'+'.$unit->complex->state.'+'.$unit->complex->zip)
                    @else
                        {{ $unit->address }}<br>
                        {{ $unit->address2 ? $unit->address2.'<br>' : '' }}
                        {{ $unit->city }}, {{ $unit->state }} {{ $unit->zip }}<br><br>
                        @php ($addr = str_replace(' ', '+', $unit->address).'+'.str_replace(' ', '+', $unit->city).'+'.$unit->state.'+'.$unit->zip)
                    @endif
                </div>
                <div class="col-xs-12 col-md-8">
                    <h4>Location</h4>
                    <iframe class="mapframe" width="100%" height="420" frameborder="0" scrolling="no"
                    scrollwheel="0" marginheight="0" marginwidth="0"
                    src="https://maps.google.com/maps?t=h&amp;q={{ $addr }}&amp;iwloc=A&amp;output=embed"></iframe>
                </div>
            </div>
            <h4 class="mt-2">Description</h4>
            {!! $unit->description !!}

            <h4 class="mt-2">Amenities</h4>
            @if ($unit->amenities->count() > 0)
                <ul>
                    @foreach ($unit->amenities as $amenity)
                        <li>{{ ucwords($amenity->name) }}</li>
                    @endforeach
                </ul>
            @else
                <p>This unit has no amenities.</p>
            @endif

            @if ($unit->complex)
                <h4 class="mt-2">Complex Amenities</h4>
                @if ($unit->complex->amenities->count() > 0)
                    <ul>
                        @foreach ($unit->complex->amenities as $amenity)
                            <li>{{ ucwords($amenity->name) }}</li>
                        @endforeach
                    </ul>
                @else
                    <p>This complex has no amenities.</p>
                @endif
            @endif
        </div>

        <div class="tab-pane fade" id="rates" role="tabpanel" aria-labelledby="rates-tab">
            <h3>Rates</h3>
            @if ($unit->rate_table)
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            @if ($unit->rate_table->name != '')
                                <tr class="text-center">
                                    <th colspan="4">{{ $unit->rate_table->name }}</th>
                                </tr>
                            @endif
                            <tr>
                                <th>Name</th>
                                <th>Starts</th>
                                <th>Ends</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($unit->rate_table->rates as $rate)
                                <tr>
                                    <td>{{ $rate->name != "" ?: "" }}</td>
                                    <td>{{ \Carbon\Carbon::parse($rate->start_date)->format('m-d-Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($rate->end_date)->format('m-d-Y') }}</td>
                                    <td>${{ number_format($rate->amount, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @elseif ($unit->complex && $unit->complex->rate_table)
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            @if ($unit->complex->rate_table->name != '')
                                <tr class="text-center">
                                    <th colspan="4">{{ $unit->complex->rate_table->name }}</th>
                                </tr>
                            @endif
                            <tr>
                                <th>Name</th>
                                <th>Starts</th>
                                <th>Ends</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($unit->complex->rate_table->rates as $rate)
                                <tr>
                                    <td>{{ $rate->name != "" ?: "" }}</td>
                                    <td>{{ \Carbon\Carbon::parse($rate->start_date)->format('m-d-Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($rate->end_date)->format('m-d-Y') }}</td>
                                    <td>${{ number_format($rate->amount, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @elseif (\Auth::user()->company->rate_table)
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            @if (\Auth::user()->company->rate_table->name != '')
                                <tr class="text-center">
                                    <th colspan="4">{{ \Auth::user()->company->rate_table->name }}</th>
                                </tr>
                            @endif
                            <tr>
                                <th>Name</th>
                                <th>Starts</th>
                                <th>Ends</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (\Auth::user()->company->rate_table->rates as $rate)
                                <tr>
                                    <td>{{ $rate->name != "" ?: "" }}</td>
                                    <td>{{ \Carbon\Carbon::parse($rate->start_date)->format('m-d-Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($rate->end_date)->format('m-d-Y') }}</td>
                                    <td>${{ number_format($rate->amount, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p>There is no rate table attached to this unit.</p>
            @endif
            <h3>Fees</h3>
        </div>

        <div class="tab-pane fade" id="photos" role="tabpanel" aria-labelledby="photos-tab">
            @if ($unit->photos->count() > 0)
                <div class="card-deck">
                    @foreach ($unit->photos as $pic)
                        <div class="card">
                            <img src="{{ asset('storage/'.\Auth::user()->company_id.'/units/'.$unit->id.'/'.$pic->filename) }}" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">{{ $pic->filename }}</h5>
                                <p class="card-text">Alt: {{ $pic->alt }}</p>
                                <p class="card-text">Title: {{ $pic->title }}</p>
                                <p class="card-text">Order: {{ $pic->order+1 }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p>There are no photos for this complex yet.</p>
            @endif
        </div>
    </div>

    @if (\Auth::user()->canCreateReservations())
        @include('reservations._parts.createModal')
    @endif

@endsection
