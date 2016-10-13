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
                        <th>ban</th>
                    </thead>
                    <tbody>
            		    @foreach($users as $user)
                            <tr>
                                <td>{{{ $user->name }}}</td>
                                <td>{{{ $user->email }}}</td>
                                <td>
                                    {{ $user->isBanned() ? 'banned' : 'not banned' }}
                                </td>
                                <td style="width: 200px;">
                                    <form method="post" action="{{ route('admin.ban') }}">
                                        <input type="hidden" name="user" value="{{ $user->id }}">
                                        {{ csrf_field() }}
                                        <input type="submit" 
                                            value="{{ $user->isBanned() ? 'grand access' : 'ban' }}"
                                            class="btn btn-danger">
                                    </form>
                                </td>
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