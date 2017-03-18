@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1>Reports for {{ $party->name }}</h1>

            @foreach($reports as $report)
                <hr>
                <div class="report-item">
                    <form class="pull-right" action="{{ route('admin.report.delete') }}" method="post">
                        <input type="hidden" name="reportid" value="{{ $report->id }}">
                        {{ csrf_field() }}
                        <input type="submit" value="delete" class="btn btn-danger">
                    </form>
                    <p>
                        <b>User:</b> <a href="{{ route('profile', ['id' => $report->user->id]) }}">
                            {{ $report->user->name }}
                        </a>
                    </p>
                    <p>{{ $report->message }}</p>
                </div>
            @endforeach
        </div>
    </div>
@endsection