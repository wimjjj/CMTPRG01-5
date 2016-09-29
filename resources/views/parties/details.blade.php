@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                	{{{ $party->name }}}
                	@if(!$party->attendees->contains(Auth::user()))
	                	<a class="pull-right" href="{{{ url('party/' . $party->id . '/attend') }}}">
	                		join
	                	</a>
	                @endif
                </div>
                <div class="panel-body">
                <p>{{{ $party->description }}}</p>
				
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
                <em>organised by <a href="{{ url('users/' . $party->owner->id) }}">
           	     	{{{ $party->owner->name }}} </a></em>
           	</div>
        </div>
    </div>
</div>
@endsection