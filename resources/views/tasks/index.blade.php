@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Tasks for: {{{ $party->name }}}
                    <p class="pull-right">
                        <a href="{{ Route('party.show', ['id' => $party->id]) }}">
                            party
                        </a>
                        @if($party->owner->id == Auth::id())
                             |
                            <a href="{{ Route('party.tasks.new', ['id' => $party->id]) }}">
                                add task
                            </a>
                        @endif
                    </p>                  
                </div>
                <div class="panel-body">
                    @foreach($tasks as $task)
                        <div>
                            <a class="pull-right" href="{{ Route('task.show', ['id' => $task->id]) }}">details</a>
                            <p> {{{ $task->description }}} </p>
                            taken by: 
                            @if($task->user)
                                {{{ $task->user->name }}}
                            @else
                                <a class="pull-right" href="{{ Route('task.claim', ['id' => $task->id])}}">
                                    claim
                                </a>
                                none one yet
                            @endif
                            <hr>
                        </div>
                    @endforeach
                    {{ $tasks->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection