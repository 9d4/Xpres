@extends('main.layout')

@section('content')
    <div class="card">
        <div class="card-header">
            <p class="card-text fw-bold">Students log of {{ $class->name }}</p>
        </div>
        <div class="card-body">
            @if(session('saved'))
                <div class="alert alert-primary">Saved!</div>
            @endif
            <form method="post">
                @csrf
                <table class="table table-bordered">
                    <thead class="sticky-top bg-light" style="top: 80px">
                    <tr>
                        <th>#</th>
                        <th>Num</th>
                        <th width="100%">Name</th>
                        <th>Available
                            <a class="fw-normal" id="checkAllAvailable">all</a>
                        </th>
                        <th>Bottle
                            <a class="fw-normal" id="checkAllBottle">all</a>
                        </th>
                        <th>Warming
                            <a class="fw-normal" id="checkAllWarming">all</a>
                        </th>
                        <th>Wearpack
                            <a class="fw-normal" id="checkAllWearpack">all</a>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <p>Total: {{ count($students) }}</p>
                    @php $counter = 0; @endphp
                    @foreach($students as $s)
                        <tr>
                            <td>{{ ++$counter }}</td>
                            <td>{{ $s->num }}</td>
                            <td>{{ $s->name }}</td>
                            <td>
                                <input class="form-check-input p-2 mx-auto d-flex" type="checkbox"
                                       name="available[{{ $s->id }}]"
                                       @isset($s->log) @if($s->log->available) checked @endif @endisset>
                            </td>
                            <td>
                                <input class="form-check-input p-2 mx-auto d-flex" type="checkbox"
                                       name="bottle[{{ $s->id }}]"
                                       @isset($s->log) @if($s->log->bottle) checked @endif @endisset>
                            </td>
                            <td>
                                <input class="form-check-input p-2 mx-auto d-flex" type="checkbox"
                                       name="warming[{{ $s->id }}]"
                                       @isset($s->log) @if($s->log->warming) checked @endif @endisset>
                            </td>
                            <td>
                                <input class="form-check-input p-2 mx-auto d-flex" type="checkbox"
                                       name="wearpack[{{ $s->id }}]"
                                       @isset($s->log) @if($s->log->wearpack) checked @endif @endisset>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <button class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
    <script>
        function checkAllContains(what) {
            let inputs = document.querySelectorAll('input[type=checkbox]');
            inputs.forEach((inp) => {
                let name = inp.name;
                if (name.includes(what)) {
                    inp.setAttribute('checked', 1);
                }
            })
        }

        document.getElementById('checkAllAvailable').onclick = () => checkAllContains('available');
        document.getElementById('checkAllBottle').onclick = () => checkAllContains('bottle');
        document.getElementById('checkAllWarming').onclick = () => checkAllContains('warming');
        document.getElementById('checkAllWearpack').onclick = () => checkAllContains('wearpack');
    </script>
@endsection
