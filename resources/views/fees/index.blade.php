@extends('_default')

@section('content')

    <h1>
        Fees
    </h1>

    @if ($fees->count() > 0)
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>title</th>
                        <th>Complex</th>
                        <th>Unit</th>
                        <th>Amount</th>
                        <th>Per Night (Y/N)</th>
                        <th>Added On</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($fees as $fee)
                        <tr>
                            <td>{{ $fee->title }}</td>
                            <td>{{ @$fee->complex->name }}</td>
                            <td>{{ @$fee->unit->name }}</td>
                            <td>${{ number_format($fee->amount, 2) }}</td>
                            <td>{{ $fee->per_night == '1' ? 'Y' : 'N' }}</td>
                            <td>{{ \Carbon\Carbon::parse($fee->created_at)->format('m-d-Y') }}</td>
                            <td></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p>There are no fees to display.</p>
    @endif

@endsection
