@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Tasks for {{{ $party->name }}}
                    <p class="pull-right">
                        <a href="{{ url('/party/' . $party->id) }}">
                            party
                        </a>
                        @if($party->owner->id == Auth::id())
                             |
                            <a href="{{ url('/party/' . $party->id . '/addtask') }}">
                                add task
                            </a>
                        @endif
                    </p>                  
                </div>
                <div class="panel-body">
                    @foreach($party->tasks as $tasks)
                            <p>
                                <a href="{{ url('/task/' . $tasks->id) }}">
                                    {{{ $tasks->description}}}
                                </a>
                            </p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection