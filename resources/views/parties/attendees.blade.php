@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                	Attendees {{{ $party->name }}}
                </div>
                <div class="panel-body">
                	<table class="table">
                		<thead>
                			<th>name</th>
                			<th>email</th>
                			<th>tasks</th>
                		</thead>
						<tbody>
							@foreach($users as $user)
								<tr 
									@if($user->id == $party->owner->id)
										class="info"
									@endif
								>
									<td>{{{ $user->name }}}</td>
									<td>{{{ $user->email }}}</td>
									<td>{{ $user->tasks_count }}</td>
								</tr>
							@endforeach
						</tbody>
                	</table>
					
					@if(isset($page) && $page > 0)
                		<a href="{{ Route('party.attendees', ['id' => $party->id, 'page' => $page - 1]) }}">prevv</a>
                	@endif

                	@if(isset($page) && sizeof($users) > 1)
                		<a class="pull-right" href="{{ Route('party.attendees', ['id' => $party->id, 'page' => $page + 1]) }}">next</a>
                	@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection