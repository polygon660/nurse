<form wire:submit.prevent="save">
    <div class="modal-body">
        <div class="card-body">
            <div class="form-group">
                <div class="row">



                    {{-- <label>รหัส</label> --}}
                    <input wire:model="guest_id" type="hidden" class="form-control" placeholder="กรอกรหัสประจำตัว">
                    {{-- @error('guest_id')<p class="text-danger">{{$message}}</p>
                        @enderror --}}



                    <div class="col-4">
                        <label>อาการ</label>
                        <input wire:model="symptom" type="text" class="form-control" placeholder="กรอกอาการ">
                        @error('symptom')
                            <p class="text-danger">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>
                    <div class="col-4">
                        <label>การปฐมพยาบาล</label>
                        {{-- <input wire:model="medical" type="text"
                            class="form-control" placeholder="กรอกการปฐมพยาบาล"> --}}

                        {{-- <input type="checkbox" wire:model="medical" value=""> --}}

                        @foreach ($medicals as $item)
                            <div class="form-check">
                                <input class="form-check-input" wire:model="medical" type="checkbox" value="{{ $item->name }}" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    {{ $item->name }}
                                </label>
                            </div>
                        @endforeach
                        @error('medical')
                            <p class="text-danger">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>
                    <div class="col-4">
                        <label>กรอกยาที่ใช้</label>
                        <input wire:model="medicine" type="text" class="form-control" placeholder="กรอกกรอกยาที่ใช้">
                        @error('medicine')
                            <p class="text-danger">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>
                    <div class="col-4">
                        <label>หมายเหตุ</label>
                        <input wire:model="note" type="text" class="form-control" placeholder="กรอกหมายเหตุ">
                        @error('note')
                            <p class="text-danger">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->

    </div>
    <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save
            changes</button>
    </div>
</form>
