@extends('main.layout')

@section('content')
    <div class="card">
        <div class="card-header">
            <p class="card-text fw-bold">Classes</p>
        </div>
        <div class="card-body">
            <div class="table-responsive p-1">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Name</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($classes as $c)
                        <tr>
                            <td>
                                <a href="{{ route('classes.students', $c->id) }}">{{ $c->name }}</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
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
