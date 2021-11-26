<div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">ตารางแสดงหน้าที่</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="role" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">ผู้ใช้งาน</th>
                                    <th class="text-center">หน้าที่</th>
                                    <th class="text-center">จัดการ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($role as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>Internet Explorer 5.2</td>
                                    <td>{{ $item->name }}</td>
                                    <td class="text-center">

                                        <button class="btn btn-info btn-sm" wire:click="edit({{ $item->id }})" >
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Edit
                                        </button>
                                        <a class="btn btn-danger btn-sm" wire:click="destroy({{ $item->id }})" >
                                            <i class="fas fa-trash">
                                            </i>
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                                @empty

                                @endforelse


                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">ชื่อผู้ใช้งาน</th>
                                    <th class="text-center">หน้าที่</th>
                                    <th class="text-center">จัดการ</th>

                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.form-group -->
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">เพิ่มหน้าที่</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    @if(Session::has('message'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                    @endif
                    <form wire:submit.prevent="save">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">หน้าที่</label>
                                <input type="hidden" class="form-control" wire:model="role_id" placeholder="ใส่หน้าที่">
                                <input type="text" class="form-control" wire:model="name" placeholder="ใส่หน้าที่">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>