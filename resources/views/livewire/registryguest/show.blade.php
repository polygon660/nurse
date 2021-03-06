<div class="card-body">
    @if (Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
    @endif

    <table id="history" class="table table-hover">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">ประเภทผู้เข้าใช้</th>
                <th class="text-center">รหัส</th>
                <th class="text-center">ชื่อ-สกุล</th>
                <th class="text-center">ระดับชั้น</th>
                {{-- <th class="text-center">ห้อง</th> --}}
                <th class="text-center">สาขา</th>
                <th class="text-center">บันทึกเมื่อ</th>
                <th class="text-center">จัดการ</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $item)
                <tr class="text-center">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->guest_type->name }}</td>
                    <td>
                        @if ($item->guest_type->name == 'นักเรียน/นักศึกษา')
                            {{ $item->student->student_id ?? '' }}
                        @else
                        {{ $item->code ?? ''}}
                        @endif
                    </td>
                    <td>
                        @if ($item->guest_type->name == 'นักเรียน/นักศึกษา')
                            {{ $item->student->national->fullname ?? '' }}
                        @else
                            {{ $item->prefix->name . '' . $item->name . ' ' . $item->surname }}
                        @endif

                    </td>
                    <td>{{ $item->student->classroom->classname  ?? '' }}</td>
                    {{-- <td>{{ $item->room->name ?? '' }}</td>--}}
                    <td>{{ $item->student->courseOpen->subMajor->sub_major_short_name?? '' }}</td> 
                    <td>{{ $item->updated_at ?? '' }}</td>
                    <td class="text-center">

                        {{-- <button type="button" class="btn btn-info btn-sm" wire:click="edit({{ $item->id }})"
                            data-toggle="modal" data-target="#modal-lg">
                            <i class="fas fa-pencil-alt">
                            </i>
                            Edit
                        </button> --}}

                        @if ($item->guest_type->name == 'บุคคลภายนอก')
                            <button wire:click="confirmDelete({{ $item->id }})" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash">
                                </i>
                                Delete
                            </button>
                        @endif

                    </td>
                </tr>
            @empty
            <td colspan="8">ไม่พบข้อมูล</td>
            @endforelse

            <!-- /.modal -->
            <div wire:ignore.self class="modal fade" id="modal-lg">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">แก้ไขข้อมูลผู้เข้าใช้</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="row">
                                        {{-- <u class="ml-2">{{ $guest_id }}</u> --}}

                                        <div class="col-3">
                                            <label>ประเภทผู้เข้าใช้</label>
                                            <u class="ml-2">{{ $guest_type }}</u>
                                        </div>
                                        @if ($guest_type == 'บุคคลภายนอก')

                                            <div class="col-2">
                                                <label>คำนำหน้า</label>
                                                <select wire:model="input_prefix" class="form-control">
                                                    <option selected>กรุณาเลือกคำนำหน้า</option>
                                                    @foreach ($prefix as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('input_prefix')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror

                                            </div>
                                            <div class="col-3">
                                                <label>ชื่อจริง</label>
                                                <input wire:model="input_name" type="text" class="form-control"
                                                    placeholder="กรอกชื่อจริง">
                                                @error('input_name')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror

                                            </div>
                                            <div class="col-3">
                                                <label>นามสกุล</label>
                                                <input wire:model="input_surname" type="text" class="form-control"
                                                    placeholder="กรอกนามสกุล">
                                                @error('input_surname')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror

                                            </div>
                                            <div class="col-2">
                                                <label>เพศ</label>
                                                <select wire:model="input_gender" class="form-control">
                                                    <option selected>กรุณาเลือกเพศ</option>
                                                    @foreach ($gender as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('input_gender')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror


                                            </div>

                                            <div class="col-2">
                                                <label>น้ำหนัก</label>
                                                <input wire:model="input_weight" type="number" class="form-control"
                                                    placeholder="กรอกน้ำหนัก">
                                            </div>
                                            <div class="col-2">
                                                <label>ส่วนสูง</label>
                                                <input wire:model="input_height" type="number" class="form-control"
                                                    placeholder="กรอกส่วนสูง">
                                            </div>
                                            {{-- <div class="col-3">
                                                <label>ชื่อจริง</label>
                                                <u class="ml-2">{{ $prefix . $name }}</u>
                                            </div>
                                            <div class="col-3">
                                                <label>นามสกุล</label>
                                                <u class="ml-2">{{ $surname }}</u>

                                            </div>
                                            <div class="col-2">
                                                <label>เพศ</label>
                                                <u class="ml-2">{{ $gender }}</u>

                                            </div>

                                            <div class="col-2">
                                                <label>น้ำหนัก</label>
                                                <u class="ml-2">{{ $weight }}</u>

                                            </div>
                                            <div class="col-2">
                                                <label>ส่วนสูง</label>
                                                <u class="ml-2">{{ $height }}</u>

                                            </div> --}}
                                        @else
                                            <div class="col-2">
                                                <label>รหัส</label>
                                                <u class="ml-2">{{ $code }}</u>
                                            </div>

                                            <div class="col-3">
                                                <label>ชื่อจริง</label>
                                                <u class="ml-2">{{ $prefix . $name }}</u>
                                            </div>
                                            <div class="col-3">
                                                <label>นามสกุล</label>
                                                <u class="ml-2">{{ $surname }}</u>

                                            </div>
                                            <div class="col-2">
                                                <label>เพศ</label>
                                                <u class="ml-2">{{ $gender }}</u>

                                            </div>
                                            {{-- <div class="col-2">
                                                <label>ระดับชั้น</label>
                                                <u class="ml-2">{{ $level }}</u>

                                            </div>
                                            <div class="col-2">
                                                <label>ห้อง</label>
                                                <u class="ml-2">{{ $room }}</u>

                                            </div>

                                            <div class="col-2">
                                                <label>สาขา</label>
                                                <u class="ml-2">{{ $program }}</u>

                                            </div> --}}

                                            <div class="col-2">
                                                <label>น้ำหนัก</label>
                                                <u class="ml-2">{{ $weight }}</u>

                                            </div>
                                            <div class="col-2">
                                                <label>ส่วนสูง</label>
                                                <u class="ml-2">{{ $height }}</u>

                                            </div>
                                        @endif

                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- /.modal-dialog -->
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
            </div>
            <!-- /.modal -->
        </tbody>
        <tfoot>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">ประเภทผู้เข้าใช้</th>
                <th class="text-center">รหัส</th>
                <th class="text-center">ชื่อ-สกุล</th>
               <th class="text-center">ระดับชั้น</th>
                 {{-- <th class="text-center">ห้อง</th>--}}
                <th class="text-center">สาขา</th> 
                <th class="text-center">บันทึกเมื่อ</th>
                <th class="text-center">จัดการ</th>
            </tr>
        </tfoot>
    </table>
</div>
