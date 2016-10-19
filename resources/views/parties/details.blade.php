@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                	{{{ $party->name }}}

	                <p class="pull-right">
	                	<a href="{{ Route('party.tasks', ['id' => $party->id]) }}">
	                			tasks
	                	</a>
                		@if($party->owner->id == Auth::id())
                			 | 
	                		<a href="{{ Route('party.invite', ['id' => $party->id]) }}">
	                			invite users
	                		</a>
	                		 |
	                		<a href="{{ Route('party.tasks.new', ['id' => $party->id]) }}">
	                			add tasks
	                		</a>
	                	@endif
	                	@if($party->attendees->contains(Auth::id()))
	                		 | 
	                		<a href="{{ Route('party.leave', ['id' => $party->id]) }}">
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
						<a href="{{ Route('profile', ['id' => $user->id]) }}">
							<li>
								{{{ $user->name }}}
							</li>
						</a>
					@endforeach
				</ul>
				<p><a href="#">all attendees</a></p>
                <em>organised by <a href="{{ Route('profile', ['id' => $party->owner->id]) }}">
           	     	{{{ $party->owner->name }}} </a></em>
           	</div>
        </div>
    </div>
</div>
@endsection