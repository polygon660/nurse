<div>

    <input type="text" wire:model="search">


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
                @foreach ($data as $item)
                    <tr align="center">
                        <td title="Field #1"> {{$item->national->fullname}}</td>
                        <td title="Field #2"> รอบ</td>
                        <td title="Field #3"> สาขา</td>
                        <!-- <td title="Field #4"> สถานะ</td> -->
                        <td title="Field #4"> ข้อมูลนักเรียน</td>
                        <td title="Field #5"> เทมเพตนักเรียน</td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>
