@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                	Task
                	
                	<p class="pull-right">
                		<a href="{{ Route('party.tasks', ['id' => $task->party->id]) }}">
							tasks
						</a>

						@if($task->party->owner->id == Auth::id() || !$task->user)
							 | 
						@endif

	                	@if($task->party->owner->id == Auth::id())
							<a href="{{ Route('task.edit', ['id' => $task->id]) }}">
								edit
							</a>
							 | 
							<a href="{{ Route('task.delete', ['id' => $task->id]) }}">
								delete
							</a>
						@endif
						
						@if($task->party->owner->id == Auth::id() && !$task->user)
							 | 
						@endif

						@if(!$task->user)
							<a href="{{ Route('task.claim', ['id' => $task->id]) }}">
								claim
							</a>
						@endif
					</p>
                </div>
                <div class="panel-body">
					<p><b>description:</b> {{{ $task->description }}}</p>
					<p><b>user:</b> 
						@if($task->user)
							<a href="{{ Route('profile', ['id' => $task->user->id]) }}">
								{{{ $task->user->name }}}
							</a>
						@else
							no one yet 
						@endif
					</p>
					<p><b>party:</b> <a href="{{ Route('party.show', ['id' => $task->party->id]) }}">
									{{{ $task->party->name }}}
								</a>
					</p>
				</div>
			</div>
        </div>
    </div>
</div>
@endsection