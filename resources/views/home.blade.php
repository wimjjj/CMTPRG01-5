@extends('layouts.app')

@section('content')
<div class="container">
    {{-- Organised by me section --}}
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Organised by me
                    <a href="{{ url('/party/new') }}" class="pull-right">new</a>
                </div>
                <div class="panel-body">
                @foreach($ownedParties as $party)
                    <div>
                        <a href="{{ url('/party/' . $party->id) }}">
                            <h3>{{{ $party->name }}}</h3>
                        </a>
                        <p>{{{ $party->description}}}</p>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
    
    {{-- Attended by me section --}}
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Attended by me</div>
                <div class="panel-body">
                @foreach($attendedParties as $party)
                    <div>
                        <a href="{{ url('/party/' . $party->id) }}">
                            <h3>{{{ $party->name }}}</h3>
                        </a>
                        <p>{{{ $party->description}}}</p>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
