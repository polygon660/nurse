<div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">ตารางแสดงเพศ</h3>
                    </div>
                    <!-- /.card-header -->
                    <div wire:ignore class="card-body">
                        <table id="gender" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">เพศ</th>
                                    <th class="text-center">จัดการ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($gender as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td class="text-center">

                                        <button class="btn btn-info btn-sm" wire:click="edit({{ $item->id }})">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Edit
                                        </button>
                                        <a class="btn btn-danger btn-sm" wire:click="confirmDelete({{ $item->id }})">
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
                                    <th class="text-center">เพศ</th>
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
                        <h3 class="card-title">เพิ่มเพศ</h3>
                    </div>
                    <!-- form start -->
                    @if(Session::has('message'))
                    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                    @endif
                    <form wire:submit.prevent="save">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">เพศ</label>
                                <input type="hidden" class="form-control" wire:model="gender_id" placeholder="ใส่เพศ">
                                <input type="text" class="form-control" wire:model="name" placeholder="ใส่เพศ">
                                @error('name')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            @if ($update)

                                <a type=""  wire:click="cancel" class="btn btn-secondary">Cancel</a>

                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>