@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Organised by me</div>
                <div class="panel-body">
                	@foreach($parties as $party)
                		<div>
                			<a href="{{ Route('party.show', ['id' => $party->id]) }}">
                				<h3>{{{ $party->name}}}</h3>
                			</a>
                			<p>{{{ $party->description}}}</p>
                			<hr>
                		</div>
                	@endforeach

                	{{ $parties->links() }}
                </div>
            </div>
        </div>
    </div>
</div
@endsection