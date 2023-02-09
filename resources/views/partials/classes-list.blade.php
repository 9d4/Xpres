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
                       href="{{ $c->href }}">
                        {{ $c->name }}
                        <span class="badge badge-sm bg-success">{{ $c->students_count }}</span>
                    </a>
                @endforeach
            </div>
        @endforeach
    </div>
</div>
