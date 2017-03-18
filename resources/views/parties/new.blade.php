@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1>Add party</h1>
            <form class="form-horizontal" role="form" method="POST" action="{{ Route('party.store') }}">
                {{ csrf_field() }}

                <div class="col-sm-6">
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="control-label">name</label>

                        <input id="name" type="text" class="form-control" name="name" required
                               value="{{{ old('name') }}}">

                        @if ($errors->has('name'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                        <label for="description" class="control-label">description</label>

                        <textarea id="name" class="form-control" name="description" required
                                  rows="9">{{ old('description') }}</textarea>

                        @if ($errors->has('description'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
@endsection