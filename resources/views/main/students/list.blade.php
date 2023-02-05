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
    <div class="card-header"><b>Import</b></div>
    <div class="card-body">
        @error('studentsFile')
        <div class="alert alert-warning">{{ $message }}</div>
        @enderror
        @if(session('upload_success'))
        <div class="alert alert-success">Uploaded!</div>
        @endif
        <p class="card-text">Imported student will be in current class. Csv delimited with comma. See below example.</p>
        <pre><code>912831,Name 1
879697,Name 2</code></pre>
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
