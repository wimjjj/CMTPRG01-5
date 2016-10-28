@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
            	<div class="panel-heading">Reports for {{{ $party->name }}}</div>
            	<div class="panel-body">
            		@foreach($reports as $report)
            			<div>
            				<form class="pull-right" action="{{ route('admin.report.delete') }}" method="post">
            					<input type="hidden" name="reportid" value="{{ $report->id }}">
            					{{ csrf_field() }}
            					<input type="submit" value="delete" class="btn btn-danger">
            				</form>
            				<p>
            					<b>User:</b> <a href="{{ route('profile', ['id' => $report->user->id]) }}">
            							  {{{ $report->user->name }}}
            						  </a>
            				</p>
            				<p>{{{ $report->message }}}</p>
            				<hr>
            			</div>
            		@endforeach
            	</div>
            </div>
        </div>
    </div>
</div>
@endsection