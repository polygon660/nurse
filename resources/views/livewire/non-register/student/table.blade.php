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

            <div class="row">
                <div class="col-4">
                    <p>สาขา</p>
                    <select wire:model="major" wire:change="firstPage" class="form-control">
                        <option value="">ทั้งหมด</option>
                        @foreach($majors as $mj)
                            <option value="{{ $mj->sub_major_short_name }}">{{ $mj->sub_major_short_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-4">
                    <p>สถานะ</p>
                    <select wire:model="status" wire:change="firstPage" class="form-control">
                        <option value="danger">ยังไม่ดำเนินการ</option>
                        <option value="warning">กำลังดำเนินการ</option>
                        <option value="success">เสร็จสิ้น</option>
                    </select>
                </div>
                <div class="col-4">
                    <p>ค้นหา</p>
                    <input type="text" class="form-control" wire:model="search" placeholder="เลขบัตรปชช. หรือชื่อ-นามสกุล">
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th title="Field #1"> เลขบัตรปชช.</th>
                                <th title="Field #2"> ชื่อ-นามสกุล</th>
                                <th title="Field #3"> สาขา</th>
                                <th title="Field #4"> สถานะ</th>
                                <th title="Field #5"> ตัวเลือก</th>
                            </tr>
                            </thead>
                            <tbody>


                            @if($students->isEmpty())
                                <tr>
                                    <td colspan="5" align="center">ไม่พบข้อมูล</td>
                                </tr>
                            @else

                                @foreach ($students as $student)

                                    <tr>
                                        <td align="center">{{ $student->register_id }}</td>
                                        <td align="left">{{ $student->national->fullname }}</td>
                                        {{-- <td align="center">{{ $student->registerCourseOpen->subMajor->sub_major_short_name }}</td> --}}
                                        {{-- <td align="center">
                                            <button
                                                class="btn btn-sm btn-{{ $student->ratio_product_status->value }}">
                                                {{ $student->ratio_product_status->message }}
                                            </button>
                                        </td> --}}
                                        <td align="center">
                                            <a href="{{ route('non-register.student.show', [$student->register_id]) }}">
                                                <button class="btn btn-primary">ดูข้อมูล</button>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach

                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
