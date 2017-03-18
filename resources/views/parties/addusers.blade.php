@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <a href="{{ Route('party.show', ['id' => $party->id]) }}" class="pull-right btn btn-link">
                PARTY
            </a>

            <h1>Invite users to: {{ $party->name }}</h1>

            <div class="col-sm-7">
                <form class="form-horizontal" role="form" method="POST"
                      action="{{ Route('party.invite' , ['id' => $party->id])}}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('keyword') ? ' has-error' : '' }}">
                        <label for="keyword" class="control-label">search</label>

                        <input id="keyword" type="text" class="form-control" name="keyword" required
                               value="{{isset($keyword) ? $keyword : old('keyword') }}">

                        @if ($errors->has('keyword'))
                            <span class="help-block">
		                                <strong>{{ $errors->first('keyword') }}</strong>
		                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="search">
                    </div>
                </form>
            </div>

        </div>

        @if(isset($users))
            <div class="row">
                <h2>results</h2>
                @foreach($users as $user)
                    <hr>
                    <div class="user-item">
                        <div class="pull-right btn btn-link">INVITE</div>

                        <a href="{{ url('/party/' . $party->id . '/invite/' . $user->id) }}">
                            <p><b>name:</b> {{ $user->name }} <br>
                                <b>email:</b> {{ $user->email }}</p>

                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection