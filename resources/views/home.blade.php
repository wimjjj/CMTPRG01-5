@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add party</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/party') }}">
                        {{ csrf_field() }}
                        
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">name</label>
          
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" required" value="{{{ old('name') }}}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">description</label>
          
                            <div class="col-md-6">
                                <textarea id="name" type="text" class="form-control" name="description" required" rows="9">{{{ old('description') }}}</textarea>

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
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

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Organised by me</div>
                <div class="panel-body">
                @foreach($parties as $party)
                    <div>
                        <a href="{{ url('/party/' . $party->id) }}">
                            <h3>{{{ $party->name }}}</h3>
                        </a>
                        <p>{{{ $party->description}}}</p>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
