@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1>Admin</h1>
            <a href="{{ Route('admin.users') }}" class="btn btn-default">users</a>

            <a href="{{ Route('admin.parties') }}" class="btn btn-default">parties</a>
        </div>
    </div>
@endsection