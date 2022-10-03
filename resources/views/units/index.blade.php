@extends('_default')

@section('content')

    <h1>
        Units
    </h1>

    @if ($units->count() > 0)
        <div class="table-responsive">
            <table class="table table-stiped table-hover">
                <thead>
                    <tr>
                        <th>name</th>
                        <th>city</th>
                        <th>complex</th>
                        <th># photos</th>
                        <th>status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($units as $unit)
                        <tr>
                            <td>{{ $unit->name }}</td>
                            <td>{{ $unit->city ?: $unit->complex->city ?: '' }}</td>
                            <td>{{ $unit->complex->name ?: '' }}</td>
                            <td>{{ $unit->photos->count() }} / {{ \Auth::user()->photo_limit() }}</td>
                            <td>{{ ucwords($unit->status) }}</td>
                            <td>
                                <a href="{{ route('units.show', $unit->id) }}" class="mr-2"><i class="fas fa-eye fa-lg"></i></a>
                                @if (\Auth::user()->canUpdateUnits())
                                    <a href="{{ route('units.edit', $unit->id) }}" class="mr-2"><i class="fas fa-edit fa-lg"></i></a>
                                @endif
                                @if (\Auth::user()->canDeleteUnits())
                                    <a href="{{ route('units.delete', $unit->id) }}" onclick="return conf();"><i class="fas fa-trash-alt fa-lg"></i></a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        There are no units to display.
    @endif

@endsection
