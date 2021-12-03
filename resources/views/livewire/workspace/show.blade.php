<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="form-group">
                            <!-- <label>ค้นหา</label> -->
                            <input type="text" class="form-control" placeholder="ค้นหาชื่อ - นามสกุล, รหัส" wire:model="search">
                            
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @if(!$search)
                        <div class="callout callout-success">
                            <h5>I am a success callout!</h5>

                            <p>Follow the steps to continue to payment.</p>
                        </div>
                        @elseif($search = '')
                        <div class="callout callout-danger">
                            <h5>I am a danger callout!</h5>

                            <p>Follow the steps to continue to payment.</p>
                        </div>
                        @else
                        <div class="callout callout-info">
                            <h5>I am an info callout!</h5>

                            <p>Follow the steps to continue to payment.</p>
                        </div>
                        @endif
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.form-group -->
            </div>

        </div>
    </div>
</div>