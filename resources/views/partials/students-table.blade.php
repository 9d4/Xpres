<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
        <tr>
            <td>#</td>
            <td>Num</td>
            <td width="100%">Name</td>
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
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
