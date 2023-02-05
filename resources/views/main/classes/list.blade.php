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
@endsection
