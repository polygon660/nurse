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
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th class="text-center">ประเภทผู้เข้าใช้</th>
                                    <th class="text-center">รหัส</th>
                                    <th class="text-center">ชื่อ-สกุล</th>
                                    <th class="text-center">ระดับชั้น</th>
                                    <th class="text-center">ห้อง</th>
                                    <th class="text-center">สาขา</th>
                                    <th class="text-center">จัดการ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ( $guest as $item )
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->guest_type->name }}</td>
                                    <td>{{ $item->code ??''}}</td>
                                    <td>{{ $item->prefix->name.''.$item->name.' '.$item->surname }}</td>
                                    <td>{{ $item->level->name ??''}}</td>
                                    <td>{{ $item->room->name ??''}}</td>
                                    <td>{{ $item->program->name ??''}}</td>
                                    <td>
                                        <button wire:click="view({{ $item->guest_id }})" class="btn btn-block btn-info"
                                            s data-toggle="modal" data-target="#modal-xl">
                                            <i class="fas fa-file-alt"></i>
                                        </button>
                                        <div wire:ignore.self class="modal fade" id="modal-xl">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">แสดงข้อมูลผู้เข้าใช้</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card-body">
                                                            <div class="form-group">
                                                                <div class="row">
                                                                <u class="ml-2">{{ $guest_id }}</u>

                                                                    <div class="col-3">
                                                                        <label>ประเภทผู้เข้าใช้</label>
                                                                        <u class="ml-2">{{ $guest_type }}</u>
                                                                    </div>
                                                                    @if ( $guest_type == 'บุคคลภายนอก' )


                                                                    <div class="col-3">
                                                                        <label>ชื่อจริง</label>
                                                                        <u class="ml-2">{{ $prefix.$name }}</u>
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

                                                                    </div>

                                                                    @else
                                                                    <div class="col-2">
                                                                        <label>รหัส</label>
                                                                        <u class="ml-2">{{ $code }}</u>
                                                                    </div>

                                                                    <div class="col-3">
                                                                        <label>ชื่อจริง</label>
                                                                        <u class="ml-2">{{ $prefix.$name }}</u>
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

                                                                    </div>

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
                                                            {{-- ส่วนตาราง --}}
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
                                                                    @foreach ( $datahistry as $item )

                                                                    <tr>
                                                                        <td>{{ $loop->iteration ??''}}</td>
                                                                        <td>{{ $item->symptom ??''}}</td>
                                                                        <td>{{ $item->medical ??''}}</td>
                                                                        <td>{{ $item->medicine ??''}}</td>
                                                                        <td>{{ $item->created_at ??''}}</td>
                                                                        <td>{{ $item->note ??''}}</td>
                                                                    </tr>
                                                                    @endforeach

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                    </td>
                                </tr>
                                @empty


                                <p>ไม่พบข้อมูลประวัติ</p>


                                @endforelse
                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{ $guest->links() }}
                        </div>

                    </div>
                </div>
                <!-- /.form-group -->
            </div>

        </div>
    </div>
</div>
