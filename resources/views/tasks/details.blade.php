@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                	Task
                	
                	<p class="pull-right">
	                	@if($task->party->owner->id == Auth::id())
							<a href="{{ url('/task/' . $task->id . '/edit') }}">
								edit
							</a>
							 | 
							<a href="{{ url('/task/' . $task->id . '/delete') }}">
								delete
							</a>
						@endif
						
						@if($task->party->owner->id == Auth::id() && !$task->user)
							 | 
						@endif

						@if(!$task->user)
							<a href="{{ url('task/' . $task->id . '/claim') }}">
								claim
							</a>
						@endif
					</p>
                </div>
                <div class="panel-body">
					<p><b>description:</b> {{{ $task->description }}}</p>
					<p><b>user:</b> 
						@if($task->user)
							<a href="{{ url('users/' . $task->user->id) }}">
								{{{ $task->user->name }}}
							</a>
						@else
							no one yet 
						@endif
					</p>
					<p><b>party:</b> <a href="{{ url('party/' . $task->party->id) }}">
									{{{ $task->party->name }}}
								</a>
					</p>
				</div>
			</div>
        </div>
    </div>
</div>
@endsection