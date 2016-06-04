@extends('app')

@section('content')

    <form action="/home/sync">
        <div class="row">
            <div class="col-md-6">
                <ol>
                    @foreach ($sourceNotebooks as $notebook)
                        <li>
                            <label><input checked name="notebook" value="{{$notebook['guid']}}" type="checkbox">&nbsp;{{ $notebook['name'] }}</label>
                        </li>
                    @endforeach
                </ol>
            </div>
            <div class="col-md-6">
                <ol>
                    @foreach ($distNotebooks as $notebook)
                        <li>
                            <label>{{ $notebook['name'] }}</label>
                        </li>
                    @endforeach
                </ol>
            </div>
        </div>

        <button type="button" class="btn btn-primary btn-lg">同步</button>
    </form>
@endsection
