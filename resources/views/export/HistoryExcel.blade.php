<table>

    <thead>
        <tr>
            <th>ลำดับ</th>
            <th>ประเภทบุคคล</th>
            <th>รหัสประจำตัว</th>
            <th>ชื่อ - นามสกุล</th>
            <th>อาการ</th>
            <th>การรักษา</th>
            <th>ยา</th>
            <th>เข้าใช้เมื่อ</th>
        </tr>
    </thead>


    @foreach ($data as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->guest->guest_type->name }}</td>
            <td>{{ $item->guest->code ?? '-' }}</td>
            {{-- <td>{{ $item->guest->full_name }}</td> --}}
            <td>
                @if ($item->guest->guest_type->name == 'นักเรียน/นักศึกษา')
                    {{ $item->guest->student->national->fullname ?? '' }}
                @else
                    {{ $item->prefix->name . '' . $item->name . ' ' . $item->surname }}
                @endif
            </td>

            <td>{{ $item->symptom }}</td>
            {{-- <td>{{ $item->medical }}</td> --}}
            <td>
                @foreach ($item->medical as $items)
                    {{ $items }}
                @endforeach
            </td>
            <td>{{ $item->medicine }}</td>
            <td>{{ $item->DateThai($item->created_at) }}</td>
            {{-- <td class="text-center">{{ date('d-M-Y H:i:s', strtotime($item->created_at)) }}</td> --}}
            {{-- <td class="text-center">{{ date('H:i:s', strtotime($item->created_at)) }}</td> --}}
        </tr>
    @endforeach


</table>
