<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <input type="text" class="form-control mb-3" wire:model="search"
                            placeholder="ค้นหาชื่อ, นามสกุล, รหัสประจำตัว">

                        @if ($search)
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        {{-- <th class="text-center">ประเภทผู้เข้าใช้</th> --}}
                                        <th class="text-center">รหัส</th>
                                        <th class="text-center">ชื่อ-สกุล</th>
                                        {{-- <th class="text-center">ระดับชั้น</th>
                                    <th class="text-center">ห้อง</th>
                                    <th class="text-center">สาขา</th> --}}
                                        <th class="text-center">จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td title="Field #1"> {{ $item->student_id }}</td>
                                            <td title="Field #1"> {{ $item->national->fullname }}</td>

                                            {{-- <td>{{ $item->guest_type->name }}</td>
                                        <td>{{ $item->code ?? '' }}</td>
                                        <td>{{ $item->fullname }}</td> --}}
                                            {{-- <td>{{ $item->level->name ?? '' }}</td>
                                        <td>{{ $item->room->name ?? '' }}</td>
                                        <td>{{ $item->program->name ?? '' }}</td> --}}
                                            <td>
                                                <button wire:click="view({{ $item->register_id }})"
                                                    class="btn btn-block btn-info" s data-toggle="modal"
                                                    data-target="#modal-xl">
                                                    <i class="fas fa-file-alt"></i>
                                                </button>

                                                <div wire:ignore.self class="modal fade" id="modal-xl">
                                                    <div class="modal-dialog modal-xl">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">แสดงข้อมูลผู้เข้าใช้</h4>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-body">
                                                                    <div class="form-group">
                                                                        <div class="row">
                                                                            {{-- <div class="col-3">
                                                                                <label>ประเภทผู้เข้าใช้</label>
                                                                                <u
                                                                                    class="ml-2">{{ $guest_type }}</u>
                                                                            </div> --}}
                                                                            <div class="col-2">
                                                                                <label>รหัส</label>
                                                                                <u
                                                                                    class="ml-2">{{ $code }}</u>
                                                                            </div>

                                                                            <div class="col-3">
                                                                                <label>ชื่อ-นามสกุล</label>
                                                                                <u
                                                                                    class="ml-2">{{ $item->national->fullname }}</u>
                                                                            </div>
                                                                            <div class="col-2">
                                                                                <label>เพศ</label>
                                                                                <u
                                                                                    class="ml-2">{{ $item->national->gender_th }}</u>

                                                                            </div>
                                                                            <div class="col-2">
                                                                                <label>ระดับชั้น</label>
                                                                                <u
                                                                                    class="ml-2">{{ $item->classroom->classname }}</u>

                                                                            </div>
                                                                            {{-- <div class="col-2">
                                                                                <label>ห้อง</label>
                                                                                <u
                                                                                    class="ml-2">{{ $room }}</u>

                                                                            </div> --}}

                                                                            <div class="col-2">
                                                                                <label>สาขา</label>
                                                                                <u
                                                                                    class="ml-2">{{ $item->courseOpen->subMajor->sub_major_short_name }}</u>

                                                                            </div>

                                                                            <div class="col-3">
                                                                                {{-- <label>น้ำหนัก</label> --}}
                                                                                {{-- <u
                                                                                    class="ml-2">{{ $weight }}</u> --}}
                                                                                {{-- <input wire:model="input_weight"
                                                                                    type="text" class="form-control"
                                                                                    placeholder="กรอกน้ำหนัก"> --}}
                                                                                <div class="row mb-2">
                                                                                    <label for="colFormLabelSm"
                                                                                        class="col-sm-4 col-form-label col-form-label-sm">น้ำหนัก</label>
                                                                                    <div class="col-sm-4">
                                                                                        <input type="number"
                                                                                            wire:model="input_weight"
                                                                                            class="form-control form-control-sm"
                                                                                           >
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-3">
                                                                                {{-- <label>ส่วนสูง</label>
                                                                                <u
                                                                                    class="ml-2">{{ $height }}</u>
                                                                                <input wire:model="input_height"
                                                                                    type="text" class="form-control"
                                                                                    placeholder="กรอกส่วนสูง"> --}}
                                                                                <div class="row mb-2">
                                                                                    <label for="colFormLabelSm"
                                                                                        class="col-sm-4 col-form-label col-form-label-sm">ส่วนสูง</label>
                                                                                    <div class="col-sm-4">
                                                                                        <input type="number"
                                                                                            wire:model="input_height"
                                                                                            class="form-control form-control-sm"
                                                                                           >
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-2">
                                                                                <label>ค่า BMI</label>
                                                                                @php
                                                                                    $h = $input_height / 100;
                                                                                    $h1 = $h ^ 2;
                                                                                    $i = $input_weight / $h1;
                                                                                @endphp
                                                                                <u
                                                                                    class="ml-2">{{ $i }}</u>

                                                                            </div>

                                                                            <div class="col-4">
                                                                                <label>อยู่ในเกณท์</label>
                                                                                @if ($i < 18.5)
                                                                                    <u
                                                                                        class="ml-2">น้ำหนักต่ำกว่าปกติ</u>
                                                                                @elseif($i >= 18.5)
                                                                                    <u class="ml-2">สมส่วน</u>
                                                                                @elseif($i >= 23)
                                                                                    <u
                                                                                        class="ml-2">น้ำหนักเกิน</u>
                                                                                @elseif($i >= 25)
                                                                                    <u
                                                                                        class="ml-2">โรคอ้วน</u>
                                                                                @elseif($i >= 30)
                                                                                    <u
                                                                                        class="ml-2">โรคอ้วนอันตราย</u>
                                                                                @else
                                                                                    <u
                                                                                        class="ml-2">ไม่สามารถคำนวนได้</u>
                                                                                @endif

                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-header">
                                                                            <h4>กรอกประวัติ</h4>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            <div class="form-group">
                                                                                <div class="row">
                                                                                    @include('livewire.workspace.form')
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    {{-- ส่วนตาราง --}}
                                                                    <table class="table table-bordered">
                                                                        <thead>
                                                                            <tr>
                                                                                <th style="width: 10px">#</th>
                                                                                <th>อาการ</th>
                                                                                <th>การปฐมพยาบาล</th>
                                                                                <th>ยา</th>
                                                                                <th>บันทึกเมื่อ</th>
                                                                                <th>หมายเหตุ</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($datahistry as $item)
                                                                                <tr>
                                                                                    <td>{{ $loop->iteration ?? '' }}
                                                                                    </td>
                                                                                    <td>{{ $item->symptom ?? '' }}
                                                                                    </td>
                                                                                    {{-- <td>{{ $item->medical ?? '' }}</td> --}}
                                                                                    <td>
                                                                                        @foreach ($item->medical as $items)
                                                                                            {{ $items }}
                                                                                        @endforeach
                                                                                    </td>
                                                                                    <td>{{ $item->medicine ?? '' }}
                                                                                    </td>
                                                                                    <td>{{ $item->created_at ?? '' }}
                                                                                    </td>
                                                                                    <td>{{ $item->note ?? '' }}</td>
                                                                                </tr>
                                                                            @endforeach

                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                                <button type="button" class="btn btn-default"
                                                                    data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>
                                                {{-- <form wire:submit.prevent="save">
                                                            <div class="modal-body">
                                                                <div class="card-body">
                                                                    <div class="form-group">
                                                                        <div class="row">


                                                                            <div class="col-4">
                                                                                <label>รหัส</label>
                                                                                <input wire:model="guest_id" type="text" class="form-control"
                                                                                    placeholder="กรอกรหัสประจำตัว">
                                                                                @error('guest_id')<p class="text-danger">{{$message}}</p>
                                                                                @enderror

                                                                            </div>

                                                                            <div class="col-4">
                                                                                <label>อาการ</label>
                                                                                <input wire:model="symptom" type="text" class="form-control"
                                                                                    placeholder="กรอกอาการ">
                                                                                @error('symptom')<p class="text-danger">{{$message}}</p>
                                                                                @enderror

                                                                            </div>
                                                                            <div class="col-4">
                                                                                <label>การปฐมพยาบาล</label>
                                                                                <input wire:model="medical" type="text"
                                                                                    class="form-control" placeholder="กรอกการปฐมพยาบาล">
                                                                                @error('medical')<p class="text-danger">{{$message}}</p>
                                                                                @enderror

                                                                            </div>
                                                                            <div class="col-4">
                                                                                <label>กรอกยาที่ใช้</label>
                                                                                <input wire:model="medicine" type="text"
                                                                                    class="form-control" placeholder="กรอกกรอกยาที่ใช้">
                                                                                @error('medicine')<p class="text-danger">{{$message}}</p>
                                                                                @enderror

                                                                            </div>
                                                                            <div class="col-4">
                                                                                <label>หมายเหตุ</label>
                                                                                <input wire:model="note" type="text"
                                                                                    class="form-control" placeholder="กรอกหมายเหตุ">
                                                                                @error('note')<p class="text-danger">{{$message}}</p>
                                                                                @enderror

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- /.card-body -->

                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                                <button type="button" class="btn btn-default"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                                            </div>
                                                </form> --}}
                                            </td>
                                        </tr>
                                    @empty




                                        <td>ไม่พบข้อมูล</td>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="mt-3">
                                {{ $guest->links() }}
                            </div>
                        @else
                        @endif

                    </div>
                </div>
                <!-- /.form-group -->
            </div>

        </div>
    </div>
</div>
