@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
            	<div class="panel-heading">Admin</div>
            	<div class="panel-body">
            		<a href="{{ Route('admin.users') }}" class="btn btn-default">users</a>

            		<a href="{{ Route('admin.parties') }}" class="btn btn-default">parties</a>
            	</div>
            </div>
        </div>
    </div>
</div>
@endsection