<div>
    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">เพิ่มผู้เข้าใช้</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <!-- /.card-header -->
            <!-- form start -->
            <form wire:submit.prevent="save">
                <div class="card-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-2">
                                <label>ประเภทผู้เข้าใช้</label>
                                <select class="form-control" wire:model="input_type">
                                    <option selected >กรุณาเลือกประเภท</option>
                                    @foreach ( $type as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach

                                </select>
                                @error('input_type')<p class="text-danger">{{$message}}</p>@enderror

                            </div>
                            
                            
                            <div class="col-2">
                                <label>คำนำหน้า</label>
                                <select wire:model="input_prefix" class="form-control">
                                    <option selected >กรุณาเลือกคำนำหน้า</option>
                                    @foreach ( $prefix as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('input_prefix')<p class="text-danger">{{$message}}</p>@enderror

                            </div>
                            <div class="col-3">
                                <label>ชื่อจริง</label>
                                <input wire:model="input_name" type="text" class="form-control"
                                    placeholder="กรอกชื่อจริง">
                                @error('input_name')<p class="text-danger">{{$message}}</p>@enderror

                            </div>
                            <div class="col-3">
                                <label>นามสกุล</label>
                                <input wire:model="input_surname" type="text" class="form-control"
                                    placeholder="กรอกนามสกุล">
                                @error('input_surname')<p class="text-danger">{{$message}}</p>@enderror

                            </div>
                            <div class="col-2">
                                <label>เพศ</label>
                                <select wire:model="input_gender" class="form-control">
                                    <option selected >กรุณาเลือกเพศ</option>
                                    @foreach ( $gender as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('input_gender')<p class="text-danger">{{$message}}</p>@enderror

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
                            
                            <div class="col-2">
                                <label>รหัส</label>
                                <input wire:model="input_code" type="text" class="form-control"
                                    placeholder="กรอกรหัสประจำตัว">
                                @error('input_code')<p class="text-danger">{{$message}}</p>@enderror

                            </div>
                            <div class="col-2">
                                <label>คำนำหน้า</label>
                                <select wire:model="input_prefix" class="form-control">
                                    <option selected >กรุณาเลือกคำนำหน้า</option>
                                    @foreach ( $prefix as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('input_prefix')<p class="text-danger">{{$message}}</p>@enderror

                            </div>
                            <div class="col-3">
                                <label>ชื่อจริง</label>
                                <input wire:model="input_name" type="text" class="form-control"
                                    placeholder="กรอกชื่อจริง">
                                @error('input_name')<p class="text-danger">{{$message}}</p>@enderror

                            </div>
                            <div class="col-3">
                                <label>นามสกุล</label>
                                <input wire:model="input_surname" type="text" class="form-control"
                                    placeholder="กรอกนามสกุล">
                                @error('input_surname')<p class="text-danger">{{$message}}</p>@enderror

                            </div>
                            <div class="col-2">
                                <label>เพศ</label>
                                <select wire:model="input_gender" class="form-control">
                                    <option selected >กรุณาเลือกเพศ</option>
                                    @foreach ( $gender as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('input_gender')<p class="text-danger">{{$message}}</p>@enderror


                            </div>
                            <div class="col-2">
                                <label>ระดับชั้น</label>
                                <select wire:model="input_level" class="form-control">
                                    <option selected value="">กรุณาเลือกระดับชั้น</option>
                                    @foreach ( $level as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="col-2">
                                <label>ห้อง</label>
                                <select wire:model="input_room" class="form-control">
                                    <option selected value="">กรุณาเลือกห้อง</option>
                                    @foreach ( $room as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="col-2">
                                <label>สาขา</label>
                                <select wire:model="input_program" class="form-control">
                                    <option selected value="">กรุณาเลือกสาขา</option>
                                    @foreach ( $program as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>

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
                            
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
