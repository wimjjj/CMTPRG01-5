@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="pull-right">
                <a href="{{ Route('party.tasks', ['id' => $task->party->id]) }}" class="btn btn-link">
                    TASKS
                </a>

                @if($task->party->owner->id == Auth::id())
                    <a href="{{ Route('task.edit', ['id' => $task->id]) }}" class="btn btn-link">
                        EDIT
                    </a>
                    <a href="{{ Route('task.delete', ['id' => $task->id]) }}" class="btn btn-link">
                        DELETE
                    </a>
                @endif

                @if(!$task->user)
                    <a href="{{ Route('task.claim', ['id' => $task->id]) }}" class="btn btn-link">
                        CLAIM
                    </a>
                @endif
            </div>

            <h1>Task</h1>

            <hr>
            <p><b>description:</b> {{ $task->description }}</p>
            <p><b>user:</b>
                @if($task->user)
                    <a href="{{ Route('profile', ['id' => $task->user->id]) }}">
                        {{ $task->user->name }}
                    </a>
                @else
                    no one yet
                @endif
            </p>
            <p><b>party:</b> <a href="{{ Route('party.show', ['id' => $task->party->id]) }}" class="btn btn-link">
                    {{ $task->party->name }}
                </a>
            </p>
        </div>
    </div>
@endsection