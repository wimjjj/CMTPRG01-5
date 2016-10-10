@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                	Invite users to: <em>{{{ $party->name }}}</em>
					
					<a class="pull-right" href="{{ url('party/' . $party->id) }}">
						party
					</a>
                </div>
				<div class="panel-body">
					<form class="form-horizontal" role="form" method="POST" action="{{ url('/party/' . $party->id . '/invite') }}">
		                {{ csrf_field() }}
						
						<div class="form-group{{ $errors->has('keyword') ? ' has-error' : '' }}">
		                    <label for="keyword" class="col-md-4 control-label">search</label>
		  
		                    <div class="col-md-6">
		                        <input id="keyword" type="text" class="form-control" name="keyword" required value="{{{ isset($keyword) ? $keyword : old('keyword') }}}">

		                        @if ($errors->has('keyword'))
		                            <span class="help-block">
		                                <strong>{{ $errors->first('keyword') }}</strong>
		                            </span>
		                        @endif
		                    </div>
		                </div>

		                <div class="form-group">
		                    <div class="col-md-6 col-md-offset-4">
		                        <button type="submit" class="btn btn-primary">
		                            search
		                        </button>
		                    </div>
		                </div>
		            </form>
				</div>
			</div>
			@if(isset($users))
				<div class="panel panel-default">
			        <div class="panel-heading">results</div>
			        <div class="panel-body">
			           	@foreach($users as $user)
			            	<a href="{{ url('/party/' . $party->id . '/invite/' . $user->id) }}">
				          		<p><b>name:</b> {{{ $user->name }}} <br>
				          		<b>email:</b> {{{ $user->email }}}</p>
				          	</a>
			          	@endforeach
					</div>
			    </div>
		    @endif
		</div>
	</div>
</div>
@endsection