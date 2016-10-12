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
                        <th>name</th>
                        <th>owner</th>
                        <th>delete</th>
                    </thead>
                    <tbody>
            		    @foreach($parties as $party)
                            <tr>
                                <td>
                                    {{{ $party->name }}}
                                </td>
                                <td>
                                    <a href="{{ route('profile', ['id' => $party->owner->id]) }}"> 
                                        {{{ $party->owner->name }}}
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
            </div>
        </div>
    </div>
</div>
@endsection