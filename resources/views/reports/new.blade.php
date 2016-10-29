@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Report {{{ $party->name }}}</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ Route('report.store') }}">
                        <input type="hidden" name="party_id" value="{{ $party->id }}">

                        {{ csrf_field() }}
                        
                        <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                            <label for="message" class="col-md-4 control-label">message</label>
          
                            <div class="col-md-6">
                                <input id="message" type="text" class="form-control" name="message" required" value="{{{ old('message') }}}">

                                @if ($errors->has('message'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('message') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Report
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