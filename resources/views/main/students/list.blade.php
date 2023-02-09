@extends('main.layout')

@section('content')
<div class="card">
    <div class="card-header">
        <p class="card-text fw-bold">Students @isset($class->name)
                of {{ $class->name }}
            @endisset</p>
    </div>
    <div class="card-body">
        @include('partials.students-table')
    </div>
</div>

<div class="card mt-4">
    <div class="card-header">
        <b>Import</b>
        <a href="{{ route('download.exampleimport') }}" class="badge bg-success text-decoration-none ms-2" role="button">Get Example</a>
    </div>
    <div class="card-body">
        @error('studentsFile')
        <div class="alert alert-warning">{{ $message }}</div>
        @enderror
        @if(session('upload_success'))
        <div class="alert alert-success">Uploaded!</div>
        @endif
        <form method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="formFileCsv" class="form-label">Upload here</label>
                <input class="form-control form-control-sm" name="studentsFile" id="formFileCsv" type="file">
            </div>
            <button class="btn btn-primary btn-sm">Upload</button>
        </form>
    </div>
</div>


<div class="card mt-4">
    <div class="card-header fw-bold">Change Class Name</div>
    <div class="card-body">
        @if(session('change_name_success'))
            <div class="alert alert-success">Changed!</div>
        @endif
        <form action="{{ route('classes.update', $class->id) }}" method="post">
            @csrf
            @method('PUT')
            <input type="text" class="form-control form-control-sm mb-3" name="className" value="{{ $class->name }}">
            <button class="btn btn-sm btn-primary">Change</button>
        </form>
    </div>
</div>
@endsection
