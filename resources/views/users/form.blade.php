@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
        <div class="col-md-8 col-md-offset-2">
        	<div class="panel panel-default">
                <div class="panel-heading">Update Profile</div>
                <div class="panel-body">
		    		<form class="form-horizontal" role="form" method="POST" action="{{ Route('profile.me') }}">
		                {{ csrf_field() }}
						
						<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
		                    <label for="name" class="col-md-4 control-label">name</label>
		  
		                    <div class="col-md-6">
		                        <input id="email" type="text" class="form-control" name="name" required value="{{{ old('name') != null ? old('name') : $user->name  }}}">

		                        @if ($errors->has('name'))
		                            <span class="help-block">
		                                <strong>{{ $errors->first('name') }}</strong>
		                            </span>
		                        @endif
		                    </div>
		                </div>

		                <div class="form-group">
		                    <div class="col-md-6 col-md-offset-4">
		                        <button type="submit" class="btn btn-primary">
		                            Save
		                        </button>
		                    </div>
		                </div>
		            </form>
		        </div>
		    </div>
        </div>
    </div>
</div>
@endsection