@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <form action="{{ Route('admin.users.search') }}" method="get">
                <div class="col-xs-3">
                    <label for="status">status</label>
                    <select class="form-control" id="status" name="status">
                        <option value="all">all</option>
                        <option value="banned">banned</option>
                        <option value="access">access</option>
                        <option value="admin">admin</option>
                    </select>
                </div>
                <div class="col-xs-7">
                    <label for="ex3">keyword</label>
                    <input class="form-control" id="ex3" type="text" name="keyword">
                </div>
                <div class="col-xs-2">
                    <label for="ex3">&#8203;</label>
                    <input class="form-control btn btn-default" id="ex3" type="submit" value="search">
                </div>
            </form>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
            	<div class="panel-heading">Users</div>
            	<div class="panel-body">
                    <table class="table">
                    <thead>
                        <th>name</th>
                        <th>email</th>
                        <th>ban</th>
                        <th>admin</th>
                        <th>reset password</th>
                    </thead>
                    <tbody>
            		    @foreach($users as $user)
                            <tr>
                                <td>{{{ $user->name }}}</td>
                                <td>{{{ $user->email }}}</td>
                                <td>
                                    <form method="post" action="{{ route('admin.ban') }}">
                                        <input type="hidden" name="user" value="{{ $user->id }}">
                                        {{ csrf_field() }}
                                        <input type="submit" 
                                            value="{{ $user->isBanned() ? 'banned' : 'ban' }}"
                                            class="btn {{ $user->isBanned() ? 'btn-danger' : 'btn-default' }}">
                                    </form>
                                </td>
                                <td>
                                    <form method="post" action="{{ route('admin.admin') }}">
                                        <input type="hidden" name="user" value="{{ $user->id }}">
                                        {{ csrf_field() }}
                                        <input type="submit" 
                                            value="{{ $user->isAdmin() ? 'admin' : 'user' }}"
                                            class="btn {{ $user->isAdmin() ? 'btn-primary' : 'btn-default' }}">
                                    </form>
                                </td>
                                <td>
                                    <form method="post" action="{{ Route('admin.resetpassword') }}">
                                        <input type="hidden" name="userid" value="{{ $user->id }}">
                                        {{ csrf_field() }}
                                        <input type="submit" value="reset password" class="btn btn-warning">
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