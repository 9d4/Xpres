@extends('main.layout')

@section('content')
<div class="card">
    <div class="card-header">
        <p class="card-text fw-bold">Students @isset($className)
                of {{ $className }}
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
@endsection
