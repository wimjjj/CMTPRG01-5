@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="pull-right">
                <a href="{{ Route('party.show', ['id' => $party->id]) }}" class="btn btn-link">
                    PARTY
                </a>
                @if($party->owner->id == Auth::id())
                    <a href="{{ Route('party.tasks.new', ['id' => $party->id]) }}" class="btn btn-link">
                        NEW
                    </a>
                @endif
            </div>
            <h1>Tasks for: {{ $party->name }}</h1>

            @foreach($tasks as $task)
                <hr>
                <a href="{{ Route('task.show', ['id' => $task->id]) }}">
                    <div class="task-item">
                        <p> {{ $task->description }} </p>
                        taken by: {{ $task->user ? $task->user->name : 'none one yet' }}
                    </div>
                </a>
            @endforeach

            {{ $tasks->links() }}
        </div>
    </div>
@endsection