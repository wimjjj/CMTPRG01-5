@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div>
            <form action="{{ Route('admin.users.search') }}" method="get">
                <div class="col-sm-3 ">
                    <label for="status">status</label>
                    <select class="form-control" id="status" name="status">
                        @if(isset($status))
                            <option value="{{{ $status }}}">{{{ $status }}}</option>
                            @if($status != 'all')
                                <option value="all">all</option>
                            @endif
                            @if($status != 'banned')
                                <option value="banned">banned</option>
                            @endif
                            @if($status != 'access')
                                <option value="access">access</option>
                            @endif
                            @if($status != 'admin')
                                <option value="admin">admin</option>
                            @endif
                        @else
                            <option value="all">all</option>
                            <option value="banned">banned</option>
                            <option value="access">access</option>
                            <option value="admin">admin</option>
                        @endif
                    </select>
                </div>
                <div class="col-sm-5">
                    <label for="ex3">keyword</label>
                    <input class="form-control" id="ex3" type="text" name="keyword" value="{{{ isset($keyword) ? $keyword : '' }}}">
                </div>
                <div class="col-sm-2">
                    <label for="ex3">&#8203;</label>
                    <input class="form-control btn btn-default" id="ex3" type="submit" value="search">
                </div>
                <div class="col-sm-2">
                    <label for="ex3">&#8203;</label>
                    <a href="{{ Route('admin.users') }}" class="form-control btn btn-default">reset</a>
                </div>
            </form>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="">
            <div class="panel panel-default">
            	<div class="panel-heading">Users</div>
            	<div class="panel-body">
                    <table class="table">
                    <thead>
                        <th>name</th>
                        <th>email</th>
                        <th>organised</th>
                        <th>attended</th>
                        <th>ban</th>
                        <th>role</th>
                        <th>reset password</th>
                    </thead>
                    <tbody>
            		    @foreach($users as $user)
                            <tr>
                                <td>{{{ $user->name }}}</td>
                                <td>{{{ $user->email }}}</td>
                                <td>{{{ $user->own_parties_count }}}</td>
                                <td>{{{ $user->attended_parties_count }}}</td>
                                <td>
                                    <form method="post" action="{{ route('admin.ban') }}">
                                        <input type="hidden" name="user" value="{{ $user->id }}">
                                        {{ csrf_field() }}
                                        <input type="submit" 
                                            value="{{ $user->isBanned() ? 'banned' : 'ban' }}"
                                            class="btn {{ $user->isBanned() ? 'btn-danger' : 'btn-default' }}"
                                            @if($user->id == Auth::id())
                                                disabled
                                            @endif
                                            >
                                    </form>
                                </td>
                                <td>
                                    <form method="post" action="{{ route('admin.admin') }}">
                                        <input type="hidden" name="user" value="{{ $user->id }}">
                                        {{ csrf_field() }}
                                        <input type="submit" 
                                            value="{{ $user->isAdmin() ? 'admin' : 'user' }}"
                                            class="btn {{ $user->isAdmin() ? 'btn-primary' : 'btn-default' }}"
                                            @if($user->id == Auth::id())
                                                disabled
                                            @endif
                                            >
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