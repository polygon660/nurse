<div class="card-body">
    @if(Session::has('message'))
    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
    @endif
    <table id="history" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">ประเภทผู้เข้าใช้</th>
                <th class="text-center">รหัส</th>
                <th class="text-center">ชื่อ-สกุล</th>
                <th class="text-center">ระดับชั้น</th>
                <th class="text-center">ห้อง</th>
                <th class="text-center">สาขา</th>
                <th class="text-center">บันทึกเมื่อ</th>
                <th class="text-center">จัดการ</th>
            </tr>
        </thead>
        <tbody>
            @forelse ( $data as $item )
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->guest_type->name }}</td>
                <td>{{ $item->code ??''}}</td>
                <td>{{ $item->prefix->name.''.$item->name.' '.$item->surname }}</td>
                <td>{{ $item->level->name ??''}}</td>
                <td>{{ $item->room->name ??''}}</td>
                <td>{{ $item->program->name ??''}}</td>
                <td>{{ $item->updated_at ??''}}</td>
                <td class="text-center">

                    <button type="button" class="btn btn-info btn-sm" wire:click="edit({{$item->id}})"
                        data-toggle="modal" data-target="#modal-lg">
                        <i class="fas fa-pencil-alt">
                        </i>
                        Edit
                    </button>


                    <button wire:click="confirmDelete({{ $item->id }})" class="btn btn-danger btn-sm">
                        <i class="fas fa-trash">
                        </i>
                        Delete
                    </button>
                </td>
            </tr>
            @empty

            @endforelse

<!-- /.modal -->
<div class="modal fade" wire:ignore.self id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">แก้ไขผู้เข้าใช้</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form wire:submit.prevent="save">
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-4">
                                    <label>ประเภทผู้เข้าใช้</label>
                                    <select class="form-control" wire:model="input_type">
                                        <option selected value="">กรุณาเลือกประเภท</option>
                                        @foreach ( $type as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach

                                    </select>
                                    @error('input_type')<p class="text-danger">{{$message}}</p>
                                    @enderror

                                </div>

                                <div class="col-4">
                                    <label>รหัส</label>
                                    <input wire:model="input_code" type="text" class="form-control"
                                        placeholder="กรอกรหัสประจำตัว">
                                    @error('input_code')<p class="text-danger">{{$message}}</p>
                                    @enderror

                                </div>
                                <div class="col-4">
                                    <label>คำนำหน้า</label>
                                    <select wire:model="input_prefix" class="form-control">
                                        <option selected value="">กรุณาเลือกคำนำหน้า</option>
                                        @foreach ( $prefix as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('input_prefix')<p class="text-danger">{{$message}}</p>
                                    @enderror

                                </div>
                                <div class="col-4">
                                    <label>ชื่อจริง</label>
                                    <input wire:model="input_name" type="text" class="form-control"
                                        placeholder="กรอกชื่อจริง">
                                    @error('input_name')<p class="text-danger">{{$message}}</p>
                                    @enderror

                                </div>
                                <div class="col-4">
                                    <label>นามสกุล</label>
                                    <input wire:model="input_surname" type="text"
                                        class="form-control" placeholder="กรอกนามสกุล">
                                    @error('input_surname')<p class="text-danger">{{$message}}</p>
                                    @enderror

                                </div>
                                <div class="col-4">
                                    <label>เพศ</label>
                                    <select wire:model="input_gender" class="form-control">
                                        <option selected value="">กรุณาเลือกเพศ</option>
                                        @foreach ( $gender as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('input_gender')<p class="text-danger">{{$message}}</p>
                                    @enderror

                                </div>
                                <div class="col-4">
                                    <label>ระดับชั้น</label>
                                    <select wire:model="input_level" class="form-control">
                                        <option selected value="">กรุณาเลือกระดับชั้น</option>
                                        @foreach ( $level as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="col-4">
                                    <label>ห้อง</label>
                                    <select wire:model="input_room" class="form-control">
                                        <option selected value="">กรุณาเลือกห้อง</option>
                                        @foreach ( $room as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="col-4">
                                    <label>สาขา</label>
                                    <select wire:model="input_program" class="form-control">
                                        <option selected value="">กรุณาเลือกสาขา</option>
                                        @foreach ( $program as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="col-4">
                                    <label>น้ำหนัก</label>
                                    <input wire:model="input_weight" type="number"
                                        class="form-control" placeholder="กรอกน้ำหนัก">
                                </div>
                                <div class="col-4">
                                    <label>ส่วนสูง</label>
                                    <input wire:model="input_height" type="number"
                                        class="form-control" placeholder="กรอกส่วนสูง">
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
            </form>
        </div>
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
                <th class="text-center">ห้อง</th>
                <th class="text-center">สาขา</th>
                <th class="text-center">บันทึกเมื่อ</th>
                <th class="text-center">จัดการ</th>
            </tr>
        </tfoot>
    </table>
</div>
