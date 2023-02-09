@extends('main.layout')

@section('content')
    <div class="card">
        <div class="card-header">
            <p class="card-text fw-bold">Classes</p>
        </div>
        <div class="card-body">
            <div class="list-group">
                @foreach($classes as $c)
                    <a class="list-group-item list-group-item-action"
                       href="{{ route('classes.students', $c->id) }}">
                        {{ $c->name }}
                        <span class="badge badge-sm bg-success">{{ $c->students_count }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            <p class="card-text fw-bold">Create Class</p>
        </div>
        <div class="card-body">
            <form action="" method="post">
                @csrf
                <input class="form-control mb-3" placeholder="Class Name" type="text" name="className" required>
                <button class="btn btn-primary btn-sm">Create</button>
            </form>
        </div>
    </div>
@endsection
