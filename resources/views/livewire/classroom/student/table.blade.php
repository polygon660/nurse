<div>
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">ตรวจสอบการกรอกข้อมูลรายห้อง
                    <span class="d-block text-muted pt-2 font-size-sm">ตรวจสอบการกรอกข้อมูลรายห้อง</span>
                </h3>
            </div>

        </div>
        <div class="card-body">

            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            @if (session()->has('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="row mt-5">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th title="Field #1"> รหัสนศ.</th>
                                <th title="Field #2"> ชื่อ-นามสกุล</th>
                                <th title="Field #3"> เพศ</th>
                                <th title="Field #4"> สถานะ</th>
                                <th title="Field #5"> ตัวเลือก</th>
                            </tr>
                            </thead>
                            <tbody>

                           จำนวนผู้ชาย {{ $studentscountm }} คน / จำนวนผู้หญิง {{ $studentscountf }} คน


                            @if($students->isEmpty())
                                <tr>
                                    <td colspan="5" align="center">ไม่พบข้อมูล</td>
                                </tr>
                            @else

                                @foreach ($students as $student)

                                    <tr>
                                        <td align="center">{{ $student->student_id }}</td>
                                        <td align="left">{{ $student->national->fullname }}</td>
                                        <td align="center">{{ $student->national->gender_th }}</td>
                                        {{-- <td align="center">
                                            <button
                                                class="btn btn-sm btn-{{ $student->ratio_product_status->value }}">
                                                {{ $student->ratio_product_status->message }}
                                            </button>
                                        </td> --}}
                                        <td align="center">
                                            <a href="{{ route('classroom.student.show', [request()->route('classroom'), $student->register_id]) }}">
                                                <button class="btn btn-primary">ดูข้อมูล</button>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach

                            @endif
                            </tbody>
                        </table>

                        {{ $students->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
