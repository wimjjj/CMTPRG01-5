@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1>Report {{ $party->name }}</h1>

            <form class="form-horizontal col-sm-6" role="form" method="POST" action="{{ Route('report.store') }}">
                <input type="hidden" name="party_id" value="{{ $party->id }}">

                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                    <label for="message" class="control-label">message</label>

                    <input id="message" type="text" class="form-control" name="message" required
                           value="{{ old('message') }}">

                    @if ($errors->has('message'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('message') }}</strong>
                                    </span>
                    @endif
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        Report
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection