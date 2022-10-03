@extends('_default')

@section('content')

    <h1>Travelers</h1>

    @if ($travelers->count() > 0)
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>name</th>
                        <th>email</th>
                        <th>phone</th>
                        <th>phone 2</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($travelers as $traveler)
                        <tr>
                            <td>{{ $traveler->last }}, {{ $traveler->first }}</td>
                            <td>{{ $traveler->email }}</td>
                            <td>{{ $traveler->phone }}</td>
                            <td>{{ $traveler->phone2 }}</td>
                            <td>
                                <a href="{{ route('travelers.show', $traveler->id) }}" class="mr-2"><i class="fas fa-eye fa-lg"></i></a>
                                @if (\Auth::user()->canUpdateTravelers())
                                    <a href="{{ route('travelers.edit', $traveler->id) }}" class="mr-2"><i class="fas fa-edit fa-lg"></i></a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p>There are no travelers to display.</p>
    @endif

@endsection
