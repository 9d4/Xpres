@extends('main.layout')

@section('content')
    <div class="card">
        <div class="card-header">
            <p class="card-text fw-bold">Select Class</p>
        </div>
        <div class="card-body">
            <div class="list-group">
                @foreach($classes as $c)
                    <a href="{{ route('logs.show.students', [$logPool->id, $c->id]) }}"
                       class="list-group-item list-group-item-action">{{ $c->name }}</a>
                @endforeach
            </div>
        </div>
    </div>
@endsection
