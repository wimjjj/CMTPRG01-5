@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1>Update Password</h1>
            <form class="form-horizontal col-sm-6" role="form" method="POST" action="{{ url('/password') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="control-label">Old Password</label>

                    <input id="password" type="password" class="form-control" name="password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('new_password') ? ' has-error' : '' }}">
                    <label for="password" class="control-label">New Password</label>

                    <input id="new_password" type="password" class="form-control" name="new_password" required>

                    @if ($errors->has('new_password'))
                        <span class="help-block">
                                <strong>{{ $errors->first('new_password') }}</strong>
                      	    </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('new_password_confirmation') ? ' has-error' : '' }}">
                    <label for="password-confirm" class="control-label">Confirm New Password</label>

                    <input id="new_password_confirmation" type="password" class="form-control"
                           name="new_password_confirmation" required>

                    @if ($errors->has('new_password_confirmation'))
                        <span class="help-block">
                                <strong>{{ $errors->first('new_password_confirmation') }}</strong>
                            </span>
                    @endif
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        Chance Password
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection