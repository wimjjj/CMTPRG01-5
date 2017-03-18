@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="pull-right">
                <a href="{{ Route('party.tasks', ['id' => $party->id]) }}" class="btn btn-link">
                    TASKS
                </a>
                @if($party->owner->id == Auth::id())
                    <a href="{{ Route('party.invite', ['id' => $party->id]) }}" class="btn btn-link">
                        INVITATIONS
                    </a>
                    <a href="{{ Route('party.tasks.new', ['id' => $party->id]) }}" class="btn btn-link">
                        ADD TASK
                    </a>
                @endif
                @if($party->attendees->contains(Auth::id()))
                    <a href="{{ Route('party.leave', ['id' => $party->id]) }}" class="btn btn-link" style="color: red">
                        LEAVE
                    </a>
                @endif
            </div>

            <h1>{{ $party->name }}</h1>

            <b>Description</b>
            <p>{{ $party->description }}</p>
            <hr>
            <p><a href="{{ Route('party.attendees', ['id' => $party->id]) }}" class="btn btn-link">ATTENDEES</a></p>

            <em>organised by <a href="{{ Route('profile', ['id' => $party->owner->id]) }}">
                    {{ $party->owner->name }} </a></em>
        </div>
    </div>
    </div>
@endsection