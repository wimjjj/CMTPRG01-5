@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                	{{{ $party->name }}}

	                <p class="pull-right">
	                	<a href="{{ url('party/' . $party->id . '/tasks') }}">
	                			tasks
	                	</a>
                		@if($party->owner->id == Auth::id())
                			 | 
	                		<a href="{{{ url('party/' . $party->id . '/invite') }}}">
	                			invite users
	                		</a>
	                		 |
	                		<a href="{{ url('party/' . $party->id . '/addtask') }}">
	                			add tasks
	                		</a>
	                	@endif
	                	@if($party->attendees->contains(Auth::id()))
	                		 | 
	                		<a href="{{ url('party/' . $party->id . '/dontattend') }}">
	                			leave
	                		</a>
	                	@endif
	                </p>
                </div>
                <div class="panel-body">
                <p>{{{ $party->description }}}</p>
				<hr>
				<h4>attendees</h4>
				<ul>
					@foreach($party->attendees as $user)
						<a href="{{ url('users/' . $user->id) }}">
							<li>
								{{{ $user->name }}}
							</li>
						</a>
					@endforeach
				</ul>
				<p><a href="#">all attendees</a></p>
                <em>organised by <a href="{{ url('users/' . $party->owner->id) }}">
           	     	{{{ $party->owner->name }}} </a></em>
           	</div>
        </div>
    </div>
</div>
@endsection