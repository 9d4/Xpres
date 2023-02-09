@extends('main.layout')

@section('content')
    @include('partials.classes-list')

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
