@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
            	<div class="panel-heading">Parties</div>
            	<div class="panel-body">
                    <table class="table">
                    <thead>
                        <th>description</th>
                        <th>owner</th>
                        <td>delete</td>
                    </thead>
                    <tbody>
            		    @foreach($parties as $party)
                            <tr>
                                <td>{{{ $party->description }}}</td>
                                <td>{{{ $party->owner->name }}}</td>
                                <td><a href="#">delete</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
                    {{ $parties->links() }}
            	</div>
            </div>
        </div>
    </div>
</div>
@endsection