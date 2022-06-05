<div>
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">ตรวจสอบการกรอกข้อมูลรายห้อง
                    <span class="d-block text-muted pt-2 font-size-sm">ตรวจสอบการกรอกข้อมูลรายห้อง</span>
                </h3>
            </div>
            <div class="card-toolbar mr-11">
                <h3 class="card-label text-lg-right"><i class="far fa-file-excel icon-xl"></i>
                    อัพโหลด Excel : </h3>
                <input type="file" wire:model="file" name="file" class="btn btn-success mr-5 ml-3">
                @if(!$file==null)
                <button type="button" wire:click="import_template" class="btn btn-secondary mr-5">นำเข้า
                </button>
                @endif
                <a href="{{ route('non-register.student.index') }}" class="btn btn-primary font-weight-bolder">
                    {{ __('กรอกข้อมูลเด็กใหม่ไม่มีรหัส') }}
                </a>
            </div>


        </div>

        {{-- <div class="card-header flex-wrap border-0 pt-6 pb-0">--}}
            {{-- <div class="card-title">--}}
                {{-- <h3 class="card-label">ชายปี 1 มี {{ $studentscountm1 }} คน / หญิงปี 1 มี {{ $studentscountf1 }}
                    คน--}}
                    {{-- </h3>--}}
                {{-- </div>--}}
            {{-- <div class="card-title">--}}
                {{-- <h3 class="card-label">ชายปี 1 มี {{ $studentscountm1 }} คน--}}
                    {{-- </h3>--}}
                {{-- </div>--}}
            {{-- <div class="card-title">--}}
                {{-- <h3 class="card-label">ชายปี 1 มี {{ $studentscountm1 }} คน--}}
                    {{-- </h3>--}}
                {{-- </div>--}}
            {{-- --}}

            {{-- </div>--}}

        <div class="card-body">
            <div class="row">
                <div class="col-4">
                    <p>ระดับชั้น</p>
                    <select wire:model="level" wire:change="firstPage" class="form-control" id="exampleSelect1">
                        <option value="0">ทั้งหมด</option>
                        <option value="1">ปวช.1</option>
                        <option value="2">ปวช.2</option>
                        <option value="3">ปวช.3</option>
                    </select>
                </div>

                <div class="col-4">
                    <p>สาขา</p>
                    <select wire:model="major" wire:change="firstPage" class="form-control" id="exampleSelect1">
                        <option value="">ทั้งหมด</option>
                        @foreach($majors as $mj)
                        <option value="{{ $mj->sub_major_short_name }}">{{ $mj->sub_major_short_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-4">
                    <p>ค้นหา</p>
                    <input type="text" class="form-control" wire:model="search" placeholder="รหัสนักเรียน 03XXXX">
                </div>
            </div>

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
                                <tr align="center">
                                    <th title="Field #1"> ห้อง</th>
                                    <th title="Field #2"> รอบ</th>
                                    <th title="Field #3"> สาขา</th>
                                    <!-- <th title="Field #4"> สถานะ</th> -->
                                    <th title="Field #4"> ข้อมูลนักเรียน</th>
                                    <th title="Field #5"> เทมเพตนักเรียน</th>
                                </tr>
                            </thead>
                            <tbody>

                                @if($classrooms->isEmpty())
                                <tr>
                                    <td colspan="5" align="center">ไม่พบข้อมูล</td>
                                </tr>
                                @else

                                @foreach ($classrooms as $classroom)

                                <tr>
                                    <td align="center"> {{ $classroom->classname }} </td>
                                    <td align="center"> {{ $classroom->round->round_name }} </td>
                                    <td align="center"> {{ $classroom->subMajor->sub_major_short_name }} </td>
                                    {{-- <td align="center">
                                            <button
                                                class="btn btn-sm btn-{{ $classroom->ratio_product_status->value }}">
                                                {{ $classroom->ratio_product_status->message }}
                                            </button>
                                        </td>  --}}
                                    <td align="center">
                                        <a href="{{ route('classroom.student.index', $classroom->classroom_id) }}">
                                            <button class="btn btn-primary">ดูข้อมูล</button>
                                        </a>
                                    </td>
                                    <td align="center">
                                        <button
                                            wire:click="export_template({{$classroom->classroom_id}},'{{$classroom->classname}}')"
                                            class="btn btn-success">
                                            <i class="far fa-file-excel icon-lg"></i> นำออก
                                        </button>
                                    </td>
                                </tr>
                                @endforeach

                                @endif
                            </tbody>
                        </table>

                        {{ $classrooms->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
