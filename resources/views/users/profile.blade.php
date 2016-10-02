@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Profile</div>
                <div class="panel-body">
                	@if($user->id == Auth::id())
			        	<a href="{{ url('/profile/edit') }}" class="btn btn-default pull-right">
							edit
						</a>
					@endif
					
					<b>name:</b> {{{ $user->name }}}<br>
					<b>email:</b> {{{ $user->email }}}
				</div>
			</div>
        </div>
    </div>
</div>
@endsection