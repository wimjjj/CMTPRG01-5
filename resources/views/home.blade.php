@extends('layouts.app')

@section('content')
<div class="container">
    {{-- Organised by me section --}}
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Organised by me
    
                    <p class="pull-right">
                        <a href="{{ Route('party.new') }}" >new</a>
                         |
                        <a href="{{ ROute('party.owned') }}">all</a>
                    </p>
                </div>
                <div class="panel-body">
                    @foreach($ownedParties as $party)
                        <div>
                            <a href="{{ Route('party.show', ['id' => $party->id]) }}">
                                <h3>{{{ $party->name }}}</h3>
                            </a>
                            <p>{{{ $party->description}}}</p>
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    
    {{-- Attended by me section --}}
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Attended by me

                    <a href="{{ Route('party.attended') }}" class="pull-right">all</a>
                </div>
                <div class="panel-body">
                    @foreach($attendedParties as $party)
                        <div>
                            <a href="{{ Route('party.show', ['id' => $party->id]) }}">
                                <h3>{{{ $party->name }}}</h3>
                            </a>
                            <p>{{{ $party->description}}}</p>
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Invitations</div>
                <div class="panel-body">
                    @foreach($invitedParties as $party)
                        <div>   
                            <div class="pull-right">
                                <form method="post" class="pull-right" action="{{ Route('party.accept') }}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="partyid" value="{{ $party->id }}">
                                    <input type="submit" value="accept" class="btn btn-default">
                                </form>
                                <a href="{{ Route('party.leave', ['id' => $party->id]) }}" class="btn btn-danger pull-right">delete</a>
                            </div>
                            <h3>{{{ $party->name }}}</h3>
                            <p>{{{ $party->description}}}</p>
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
