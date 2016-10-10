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
                        <a href="{{ url('/party/new') }}" >new</a>
                         |
                        <a href="#">all</a>
                    </p>
                </div>
                <div class="panel-body">
                    @foreach($ownedParties as $party)
                        <div>
                            <a href="{{ url('/party/' . $party->id) }}">
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

                    <a href="#" class="pull-right">all</a>
                </div>
                <div class="panel-body">
                    @foreach($attendedParties as $party)
                        <div>
                            <a href="{{ url('/party/' . $party->id) }}">
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
</div>
@endsection
