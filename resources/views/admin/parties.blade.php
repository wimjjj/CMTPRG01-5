@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1>Parties</h1>
            <table class="table">
                <thead>
                <th>name</th>
                <th>owner</th>
                <th>reports</th>
                <th>delete</th>
                </thead>
                <tbody>
                @foreach($parties as $party)
                    <tr>
                        <td>
                            {{ $party->name }}
                        </td>
                        <td>
                            <a href="{{ route('profile', ['id' => $party->owner->id]) }}">
                                {{ $party->owner->name }}
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('admin.parties.reports', ['partyid' => $party->id]) }}">
                                {{ $party->reports_count }}
                            </a>
                        </td>
                        <td>
                            <form method="post" action="{{ route('admin.parties.delete') }}">
                                <input type="hidden" name="party" value="{{ $party->id }}">
                                {{ csrf_field() }}
                                <input type="submit" value="delete" class="btn btn-danger">
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        {{ $parties->links() }}
    </div>
@endsection