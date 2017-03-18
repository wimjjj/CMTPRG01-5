@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1>Attended by me</h1>
            @foreach($parties as $party)
                <div class="party-item">
                    <hr>
                    <a href="{{ Route('party.show', ['id' => $party->id]) }}">
                        <h3>{{ $party->name}}</h3>
                    </a>
                    <p>{{ $party->description}}</p>
                </div>
            @endforeach

            {{ $parties->links() }}
        </div>
    </div>
@endsection