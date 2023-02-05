@extends('main.layout')

@section('content')
<div class="card">
    <div class="card-header">
        <p class="card-text fw-bold">Log Pool</p>
    </div>
    <div class="card-body">
        <form action="" method="get">
            <select class="form-select" aria-label="Log Pool" name="pool">
                <option disabled selected>Pool list</option>
                @foreach($pools as $p)
                    <option value="{{ $p->id }}">{{ $p->date }}</option>
                @endforeach
            </select>
        </form>
    </div>
</div>

<div class="card mt-3">
    <div class="card-header">
        <p class="card-text fw-bold">Create</p>
    </div>
    <div class="card-body">
        @error('poolDate')
        <div class="alert alert-warning">{{ $message }}</div>
        @enderror
        @if(session('create_failed'))
        <div class="alert alert-warning">Failed!</div>
        @endif
        @if(session('create_success'))
            <div class="alert alert-success">Created!</div>
        @endif
        <form action="" method="post">
            @csrf
            <div class="mb-3 row">
                <label for="poolDate" class="col-sm-2 col-form-label">Date</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" id="poolDate" name="poolDate">
                </div>
            </div>
            <button class="btn btn-primary btn-sm">Create</button>
        </form>
    </div>
</div>
@endsection
