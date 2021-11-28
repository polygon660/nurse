<table class="table table-bordered">
    <thead>
        <tr>
            <th style="width: 10px">#</th>
            <th>อาการ</th>
            <th>การปฐมพยาบาล</th>
            <th>ยา</th>
            <th>เข้าใช้งานเมื่อ</th>
            <th>หมายเหตุ</th>
        </tr>
    </thead>
    <tbody>
        {{-- @foreach ( $history_data as $item )
        <tr>
            <td>{{ $loop->iteration ??''}}</td>
            <td>{{ $item->symptom ??''}}</td>
            <td>{{ $item->medical ??''}}</td>
            <td>{{ $item->medicine ??''}}</td>
            <td>{{ $item->note ??''}}</td>
            <td>{{ $item->create_at ??''}}</td>
        </tr>
        @endforeach --}}
    </tbody>
</table>