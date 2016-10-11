@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
            	<div class="panel-heading">Users</div>
            	<div class="panel-body">
                    <table class="table">
                    <thead>
                        <th>name</th>
                        <th>email</th>
                        <th>status</th>
                        <td>ban</td>
                    </thead>
                    <tbody>
            		    @foreach($users as $user)
                            <tr>
                                <td>{{{ $user->name }}}</td>
                                <td>{{{ $user->email }}}</td>
                                <td>not banned</td>
                                <td><a href="#">ban</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
                    {{ $users->links() }}
            	</div>
            </div>
        </div>
    </div>
</div>
@endsection