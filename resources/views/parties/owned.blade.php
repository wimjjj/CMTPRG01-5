@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1>Organised by me</h1>
            @foreach($parties as $party)
                <hr>
                <div class="party-item">
                    <a href="{{ Route('party.show', ['id' => $party->id]) }}">
                        <h3>{{ $party->name }}</h3>
                    </a>
                    <p>{{ $party->description }}</p>
                </div>
            @endforeach

            {{ $parties->links() }}
        </div>
    </div>
@endsection