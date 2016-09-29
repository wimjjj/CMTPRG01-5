@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{{ $party->name }}}</div>
                <div class="panel-body">
                <p>{{{ $party->description }}}</p>

                <em>organised by <a href="{{ url('users/' . $party->owner->id) }}">
           	     	{{{ $party->owner->name }}} </a></em>
           	</div>
        </div>
    </div>
</div>
@endsection