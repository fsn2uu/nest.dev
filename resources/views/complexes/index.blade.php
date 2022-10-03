@extends('_default')

@section('content')

    <h1>
        Complexes
        <a href="" class="btn btn-outline-primary float-right search-light">Search</a>
    </h1>

    <div class="container search-hidden" id="search-form">
        <div class="row">
            [SEARCH FORM GOES HERE]
        </div>
    </div>

    @if ($complexes->count() > 0)
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>name</th>
                        <th>city</th>
                        <th># units</th>
                        <th># photos</th>
                        <th>status</th>
                        <th></th>
                    </tr>
                </thead>
                @foreach ($complexes as $complex)
                    <tr>
                        <td>{{ $complex->name }}</td>
                        <td>{{ $complex->city }}</td>
                        <td>{{ $complex->units->count() }}</td>
                        <td>
                            {{ $complex->photos->count() }} / {{ \Auth::user()->photo_limit() }}
                        </td>
                        <td>{{ ucwords($complex->status) }}</td>
                        <td>
                            <a href="{{ route('complexes.show', $complex->id) }}" class="mr-2"><i class="fas fa-eye fa-lg"></i></a>
                            @if (\Auth::user()->canUpdateComplexes())
                                <a href="{{ route('complexes.edit', $complex->id) }}" class="mr-2"><i class="fas fa-edit fa-lg"></i></a>
                            @endif
                            @if (\Auth::user()->canDeleteComplexes())
                                <a href="{{ route('complexes.delete', $complex->id) }}" onclick="return conf();"><i class="fas fa-trash-alt fa-lg"></i></a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    @else
        <p>There are no complexes to display.</p>
    @endif

@endsection

@section('scripts')

    <script>
    $(function(){
        $('.search-light').on('click', function(e){
            e.preventDefault()
            $('#search-form').animate({
                height: "100%"
            }, 5000)
        })
    })
    function conf()
    {
        if(confirm('Are you sure? This will also delete any units attached to this complex, and this can\'t be undone.') === false)
        {
            return false;
        }

        return true;
    }
    </script>

@endsection
