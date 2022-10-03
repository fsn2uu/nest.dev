@extends('_default')

@section('content')

    <h1>
        {{ $complex->name }}
        @if (\Auth::user()->canUpdateComplexes())
            <a href="{{ route('complexes.edit', $complex->id) }}" class="btn btn-primary float-right">Edit Complex</a>
        @endif
    </h1>

    <ul class="nav nav-tabs mt-3" id="complexInfo" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="units-tab" data-toggle="tab" href="#units" role="tab" aria-controls="units" aria-selected="true">Units</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="info-tab" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="false">Info</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="photos-tab" data-toggle="tab" href="#photos" role="tab" aria-controls="photos" aria-selected="false">Photos</a>
        </li>
    </ul>

    <div class="tab-content mt-2" id="complexInfoContent">
        <div class="tab-pane fade show active" id="units" role="tabpanel" aria-labelledby="units-tab">
            @if ($complex->units->count() > 0)
                <div class="card-deck">
                    @foreach ($complex->units as $unit)
                        <div class="card">
                            <img src="{{ asset('storage/'.\Auth::user()->company_id.'/units/'.$unit->id.'/'.\App\Photo::where('unit_id', $unit->id)->first()->filename) }}" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">{{ $unit->name }}</h5>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p>There are no units attached to this complex.</p>
            @endif
        </div>

        <div class="tab-pane fade" id="info" role="tabpanel" aria-labelledby="info-tab">
            <div class="row">
                <div class="col-xs-12 col-md-4">
                    <h4>Location Information</h4>
                    <strong>Address:</strong><br>
                    {{ $complex->address }}<br>
                    {{ $complex->address2 ? $complex->address2.'<br>' : '' }}
                    {{ $complex->city }}, {{ $complex->state }} {{ $complex->zip }}<br><br>
                    <strong>Phone:</strong><br>
                    {{ $complex->phone }}
                    <strong>Alt Phone:</strong><br>
                    {{ $complex->phone2 }}
                    <strong>Toll-Free:</strong><br>
                    {{ $complex->toll_free }}
                    <strong>Website:</strong><br>
                    {{ $complex->website }}
                </div>
                <div class="col-xs-12 col-md-8">
                    <h4>Location</h4>
                    @php ($addr = str_replace(' ', '+', $complex->address).'+'.str_replace(' ', '+', $complex->city).'+'.$complex->state.'+'.$complex->zip)
                    <iframe class="mapframe" width="100%" height="420" frameborder="0" scrolling="no"
                    scrollwheel="0" marginheight="0" marginwidth="0"
                    src="https://maps.google.com/maps?t=h&amp;q={{ $addr }}&amp;iwloc=A&amp;output=embed"></iframe>
                </div>
            </div>
            <h4 class="mt-2">Description</h4>
            {!! $complex->description !!}

            <h4 class="mt-2">Amenities</h4>
            @if ($complex->amenities->count() > 0)
                <ul>
                    @foreach ($complex->amenities as $amenity)
                        <li>{{ ucwords($amenity->name) }}</li>
                    @endforeach
                </ul>
            @else
                <p>This complex has no amenities.</p>
            @endif
        </div>

        <div class="tab-pane fade" id="photos" role="tabpanel" aria-labelledby="photos-tab">
            @if ($complex->photos->count() > 0)
                <div class="card-deck">
                    @foreach ($complex->photos as $pic)
                        <div class="card">
                            <img src="{{ asset('storage/'.\Auth::user()->company_id.'/complexes/'.$complex->id.'/'.$pic->filename) }}" class="card-img-top">
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
                There are no photos for this complex yet.
            @endif
        </div>
    </div>

@endsection
