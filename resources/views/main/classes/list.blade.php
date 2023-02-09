@extends('main.layout')

@section('content')
    <div class="card">
        <div class="card-header">
            <p class="card-text fw-bold">Classes</p>
        </div>
        <div class="card-body">
            @foreach($classes as $subClassKey => $subClass)
                <b class="d-flex align-items-center">{{ $subClassKey }} <span class="badge badge-sm bg-primary ms-2">{{ $subClass->students_count }}</span></b>
                <div class="list-group mb-2">
                    @foreach($subClass as $c)
                        <a class="list-group-item list-group-item-action"
                           href="{{ route('classes.students', $c->id) }}">
                            {{ $c->name }}
                            <span class="badge badge-sm bg-success">{{ $c->students_count }}</span>
                        </a>
                    @endforeach
                </div>
            @endforeach
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
