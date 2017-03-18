@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1>Update Profile</h1>
            <form class="form-horizontal col-sm-6" role="form" method="POST" action="{{ Route('profile.me') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="control-label">name</label>

                    <input id="email" type="text" class="form-control" name="name" required
                           value="{{ old('name') != null ? old('name') : $user->name  }}">

                    @if ($errors->has('name'))
                        <span class="help-block">
		                                <strong>{{ $errors->first('name') }}</strong>
		                            </span>
                    @endif
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection