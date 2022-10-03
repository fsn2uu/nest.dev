@extends('_default')

@section('content')

    <h1>
        Rate Tables
    </h1>

    @if ($rates->count() > 0)
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>name</th>
                        <th>complex</th>
                        <th>unit</th>
                        <th>created on</th>
                        <th>last updated</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rates as $rate)
                        <tr>
                            <td>{{ $rate->name }}</td>
                            <td>{{ @$rate->complex->name }}</td>
                            <td>{{ @$rate->unit->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($rate->created_at)->format('m-d-Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($rate->updated_at)->format('m-d-Y') }}</td>
                            <td></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p>There are no rate tables to display.</p>
    @endif

@endsection
