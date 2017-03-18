@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1>Parties</h1>
            <a href="{{ Route('party.new') }}" class="btn btn-default pull-right pull-up">new</a>
        </div>
        {{-- Organised by me section --}}
        <div class="row dashboard-section">
            <h2>Organised by me</h2>
            <div class="btn-group">

            </div>
            @foreach($ownedParties as $party)
                <hr>
                <a href="{{ Route('party.show', ['id' => $party->id]) }}">
                    <div class="party-item">
                        <h3>{{ $party->name }}</h3>
                        <p>{{ $party->description}}}</p>
                    </div>
                </a>
            @endforeach

            <hr>
            <a href="{{ ROute('party.owned') }}" class="btn btn-link">ALL</a>
        </div>

        {{-- Attended by me section --}}
        <div class="row dashboard-section">
            <h2>Attended by me</h2>


            @foreach($attendedParties as $party)
                <hr>
                <a href="{{ Route('party.show', ['id' => $party->id]) }}">
                    <div class="party-item">
                        <h3>{{ $party->name }}</h3>
                        <p>{{ $party->description}}</p>
                    </div>
                </a>
            @endforeach

            <hr>
            <a href="{{ Route('party.attended') }}" class="btn btn-link">ALL</a>
        </div>

        <div class="row dashboard-section">
            <h2>Invitations</h2>
            @foreach($invitedParties as $party)
                <div>
                    <div class="pull-right">
                        <form method="post" class="pull-right" action="{{ Route('party.accept') }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="partyid" value="{{ $party->id }}">
                            <input type="submit" value="accept" class="btn btn-default">
                        </form>
                        <a href="{{ Route('party.leave', ['id' => $party->id]) }}"
                           class="btn btn-danger pull-right">delete</a>
                        <a href="{{ route('report.new', ['partyid' => $party->id]) }}" class="btn btn-danger">
                            report
                        </a>
                    </div>
                    <h3>{{ $party->name }}</h3>
                    <p>{{ $party->description }}</p>
                </div>
            @endforeach
        </div>
    </div>
@endsection
