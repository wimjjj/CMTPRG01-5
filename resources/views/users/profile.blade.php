@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1>Profile</h1>
            @if($user->id == Auth::id())
                <a href="{{ Route('profile.edit') }}" class="btn btn-default pull-right">
                    edit
                </a>
            @endif

            <p><b>name:</b> {{ $user->name }}</p>
            <p><b>email:</b> {{ $user->email }}</p>
        </div>
    </div>
@endsection