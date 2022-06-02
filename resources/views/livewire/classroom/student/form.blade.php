<div class="card card-custom">
    <form class="form" wire:submit.prevent="save">
        <div class="card-body">

            <div class="form-group row mt-3">
                <div class="col-lg-4 mb-4 text-xl">
                    <strong>ชื่อ-นามสกุล:</strong>
                    {{ $student->national->fullname }}
                </div>
                <div class="col-lg-2 mb-4 text-xl">
                    <strong>เพศ:</strong>
                    {{ $student->national->gender_th }}
                </div>
                <div class="col-lg-2 mb-4 text-xl">
                    <strong>ชั้น:</strong>
                    {{ $student->classroom->classname }}
                </div>
                <div class="col-lg-2 mb-4 text-xl">
                    <strong>สาขา:</strong>
                    {{ $student->courseOpen->subMajor->sub_major_short_name }}
                    <!-- <button type="button" wire:click="test">Test</button> -->
                </div>


                <div class="row">
                    <div class="col-xl-2"></div>
                    <div class="col-xl-8">
                        <div class="my-5">
                            <h3 class="text-center">รายการ:</h3>

                            <div class="form-group row mt-4">
                                <label class="col-3">สถานะ</label>
                                <div class="col-9">
                                    <select class="form-control" wire:model="ratios.status_products">
                                        <option>เลือกสถานะครั้งที่ได้รับล่าสุด</option>
                                        <option value="1">ได้รับของแล้วตอนปี 1</option>
                                        <option value="2">ได้รับของแล้วตอนปี 2</option>
                                        <option value="3">ได้รับของแล้วตอนปี 3</option>
                                  </select>
                                    @error('ratios.status_products') <span
                                        class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <input wire:model="ratios.gender" type="hidden" class="form-control" />

                            <!-- <div class="form-group row mt-4">
                                <label class="col-3">ประเภทของสูท</label>
                                <div class="col-9">
                                    <select class="form-control" wire:model="ratios.gender">
                                        <option>เลือกประเภทของสูท</option>
                                        <option value="ชาย">ชาย</option>
                                        <option value="หญิง">หญิง</option>
                                    </select>
                                    @error('ratios.gender') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div> -->


                            <div class="form-group row mt-4">
                                <label class="col-3">สูท 1 ตัว</label>
                                <div class="col-9">
                                    <input wire:model="ratios.suit" type="text" class="form-control"  placeholder="เช่น 44"/>
                                    @error('ratios.suit') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                 @if ($student->national->gender_th == 'ชาย')
                               
                          <div class="form-group row">
                                    <label class="col-3">เสื้อแขนสั้น 1 ตัว</label>
                                    <div class="col-9">
                         <select class="form-control" wire:model="ratios.shirt_shorts">
                                            <option>เลือกไซต์เสื้อแขนสั้นชาย</option>
                                     @foreach ( $shirtm as $item )
                                            <option value="{{ $item->size }}">{{ $item->size }}</option>
                                     @endforeach
                                        <option value="วัดตัว">วัดตัว</option>
                          </select>
                                        @error('ratios.shirt_shorts') <span
                                            class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-3">เสื้อแขนยาว</label>
                                    <div class="col-9">
                                        <select class="form-control" wire:model="ratios.shirt_longs">
                                    <option value="0">เลือกไซต์เสื้อแขนยาวชาย</option>
                                         @foreach ($longshirtm as $item)
                                           <option value="{{$item->size}}">{{$item->size}}</option>
                                        @endforeach
                                            <option value="วัดตัว">วัดตัว</option>
                                        </select>
                                        @error('ratios.shirt_longs') <span
                                            class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-3">กางเกง</label>
                                    <div class="col-9">
                                        <select class="form-control" wire:model="ratios.trousers">
                                            <option value="">เลือกไซต์กางเกง</option>
                                       @foreach ( $trouser as $item )
                                           <option value="{{$item->size}}">{{$item->size}}</option>
                                      @endforeach
                                            <option value="วัดตัว">วัดตัว</option>
                                        </select>
                                        @error('ratios.trousers') <span
                                            class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                @elseif ($student->national->gender_th == 'หญิง')

                                <div class="form-group row">
                                    <label class="col-3">เสื้อแขนสั้นหญิง</label>
                                    <div class="col-9">
                                        <select class="form-control" wire:model="ratios.shirt_shorts">
                                     <option value="">เลือกไซต์เสื้อแขนสั้นหญิง</option>
                                        @foreach ( $shirtfm as $item)
                                            <option value="{{ $item->size }}">{{ $item->size }}</option>
                                        @endforeach
                                            <option value="วัดตัว">วัดตัว</option>
                                        </select>
                                        @error('ratios.shirt_shorts') <span
                                            class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3">เสื้อแขนยาวหญิง</label>
                                    <div class="col-9">
                                        <select class="form-control" wire:model="ratios.shirt_longs">
                                            <option value="">เลือกไซต์เสื้อแขนยาวหญิง</option>
                                      @foreach ( $longshirtfm as $item )
                                        <option value="{{ $item->size }}">{{ $item->size }}</option>
                                      @endforeach
                                            <option value="วัดตัว">วัดตัว</option>
                                        </select>
                                        @error('ratios.shirt_longs') <span
                                            class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3">กระโปรง</label>
                                    <div class="col-9">
                                        <select class="form-control" wire:model="ratios.skirts">
                                            <option value="">เลือกไซต์กระโปรง</option>
                                       @foreach ( $skirt as $item )
                                        <option value="{{ $item->size }}">{{ $item->size }}</option>
                                        @endforeach
                                            <option value="วัดตัว">วัดตัว</option>
                                        </select>
                                        @error('ratios.skirts') <span
                                            class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            @endif

                            <div class="form-group row">
                                <label class="col-3">เข็มขัด</label>
                                <div class="col-9">
                                    <input wire:model="ratios.belt" type="text" class="form-control"
                                           placeholder="เช่น 34"/>
                                    @error('ratios.belt') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                 @if ($student->classroom->classno == '1')
                                <div class="form-group row">
                                    <label class="col-3">เสื้อ Freshy</label>
                                    <div class="col-9">
                                        <select class="form-control" wire:model="ratios.shirt_freshys">
                                            <option value="0">เลือกไซต์เสื้อ Freshy</option>
                                            <option value="SSS">SSS</option>
                                            <option value="SS">SS</option>
                                            <option value="SSS">S</option>
                                            <option value="M">M</option>
                                            <option value="L">L</option>
                                            <option value="XL">XL</option>
                                            <option value="2XL">2XL</option>
                                            <option value="3XL">3XL</option>
                                            <option value="4XL">4XL</option>
                                            <option value="5XL">5XL</option>
                                            <option value="6XL">6XL</option>
                                            <option value="วัดตัว">วัดตัว</option>
                                        </select>
                                        @error('ratios.shirt_freshys') <span
                                            class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                 @endif

                            <div class="form-group row">
                                <label class="col-3">เสื้อสาขา</label>
                                <div class="col-9">
                                    <select class="form-control" wire:model="ratios.shirt_programs">
                                        <option value="0">เลือกไซต์เสื้อสาขา</option>
                                        <option value="SSS">SSS</option>
                                        <option value="SS">SS</option>
                                        <option value="SSS">S</option>
                                        <option value="M">M</option>
                                        <option value="L">L</option>
                                        <option value="XL">XL</option>
                                        <option value="2XL">2XL</option>
                                        <option value="3XL">3XL</option>
                                        <option value="4XL">4XL</option>
                                        <option value="5XL">5XL</option>
                                        <option value="6XL">6XL</option>
                                        <option value="วัดตัว">วัดตัว</option>
                                    </select>
                                    @error('ratios.shirt_programs') <span
                                        class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

             @if ($student->courseOpen->subMajor->sub_major_short_name == 'FOOD')

                                <div class="form-group row">
                                    <label class="col-3">เสื้อเชฟ</label>
                                    <div class="col-9">
                                        <select class="form-control" wire:model="ratios.shirt_chefs">
                                            <option value="0">เลือกไซต์เสื้อเชฟ</option>
                                       @foreach ( $chef as $item )
                                        <option value="{{ $item->size }}">{{ $item->size }}</option>
                                        @endforeach
                                            <option value="วัดตัว">วัดตัว</option>
                                        </select>
                                        @error('ratios.shirt_chefs') <span
                                            class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-3">กางเกงเชฟ</label>
                                    <div class="col-9">
                                        <select class="form-control" wire:model="ratios.trouser_chefs">
                                            <option value="0">เลือกไซต์กางเกงเชฟ</option>
                                        @foreach ( $trouserchef as $item )
                                        <option value="{{ $item->size }}">{{ $item->size }}</option>
                                        @endforeach
                                            <option value="วัดตัว">วัดตัว</option>
                                        </select>
                                        @error('ratios.trouser_chefs') <span
                                            class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-3">รองเท้าเชฟ</label>
                                    <div class="col-9">
                                        <select class="form-control" wire:model="ratios.shoe_chefs">
                                            <option value="0">เลือกไซต์รองเท้าเชฟ</option>
                                        @foreach ( $shoechefs as $item )
                                        <option value="{{ $item->size }}">{{ $item->size }}</option>
                                        @endforeach
                                            <option value="วัดรองเท้า">วัดรองเท้า</option>
                                        </select>
                                        @error('ratios.shoe_chefs') <span
                                            class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                              
                                
    


                                
                 @endif
                 <div class="form-group row mt-4">
                                <label class="col-3">หมายเหตุ(สำคัญ)</label>
                                <div class="col-9">
                  <textarea class="form-control" wire:model="ratios.note"> </textarea>
                 </div>
              </div>



                        </div>
                    </div>
                    <!--Start_สัดส่วนเพิ่มเติมสำหรับไซต์ปกติ -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card-title">
                                <h3 class="card-label text-center">
                                    วัดเพิ่มเติมในส่วนของสูท และของไซต์พิเศษ
                                </h3>

                            </div>
                        </div>
                        <label class="col-lg-1 col-form-label text-lg-right mb-4">เก็บเอว :</label>
                        <div class="col-lg-3">
                            <input wire:model="ratios.suit_keepwaist" type="text" class="form-control" placeholder="0"/>
                            @error('ratios.suit_keepwaist') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <label class="col-lg-1 col-form-label text-lg-right mb-4">ตัดดุมหน้า :</label>
                        <div class="col-lg-3">
                            <input wire:model="ratios.suit_fronthubcut" type="text" class="form-control"
                                   placeholder="0"/>
                            @error('ratios.suit_fronthubcut') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <label class="col-lg-1 col-form-label text-lg-right mb-4">เสื้อยาว :</label>
                        <div class="col-lg-3">
                            <input wire:model="ratios.top_longshirt" type="text" class="form-control" placeholder="0"/>
                            @error('ratios.top_longshirt') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <label class="col-lg-1 col-form-label text-lg-right mb-4">แขนยาว :</label>
                        <div class="col-lg-3">
                            <input wire:model="ratios.top_longarm" type="text" class="form-control" placeholder="0"/>
                            @error('ratios.top_longarm') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <label class="col-lg-1 col-form-label text-lg-right mb-4">ปลายแขน :</label>
                        <div class="col-lg-3">
                            <input wire:model="ratios.top_forearm" type="text" class="form-control" placeholder="0"/>
                            @error('ratios.top_forearm') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <label class="col-lg-1 col-form-label text-lg-right mb-4">รอบอก :</label>
                        <div class="col-lg-3">
                            <input wire:model="ratios.top_chest" type="text" class="form-control" placeholder="0"/>
                            @error('ratios.top_chest') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <label class="col-lg-1 col-form-label text-lg-right mb-4">บ่าหน้า :</label>
                        <div class="col-lg-3">
                            <input wire:model="ratios.top_shoulder" type="text" class="form-control" placeholder="0"/>
                            @error('ratios.top_shoulder') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <label class="col-lg-1 col-form-label text-lg-right mb-4">บ่าหลัง :</label>
                        <div class="col-lg-3">
                            <input wire:model="ratios.top_backshoulder" type="text" class="form-control"
                                   placeholder="0"/>
                            @error('ratios.top_backshoulder') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <label class="col-lg-1 col-form-label text-lg-right mb-4">ต้นแขน :</label>
                        <div class="col-lg-3">
                            <input wire:model="ratios.top_upperarm" type="text" class="form-control" placeholder="0"/>
                            @error('ratios.top_upperarm') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <label class="col-lg-1 col-form-label text-lg-right mb-4">ไหล่กว้าง :</label>
                        <div class="col-lg-3">
                            <input wire:model="ratios.top_broadshoulder" type="text" class="form-control"
                                   placeholder="0"/>
                            @error('ratios.top_broadshoulder') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <label class="col-lg-1 col-form-label text-lg-right mb-4">รอบเอวส่วนบน :</label>
                        <div class="col-lg-3">
                            <input wire:model="ratios.top_waistline" type="text" class="form-control" placeholder="0"/>
                            @error('ratios.top_waistline') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <label class="col-lg-1 col-form-label text-lg-right mb-4">สะโพกส่วนบน :</label>
                        <div class="col-lg-3">
                            <input wire:model="ratios.top_hip" type="text" class="form-control" placeholder="0"/>
                            @error('ratios.top_hip') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <label class="col-lg-1 col-form-label text-lg-right mb-4">รอบคอ :</label>
                        <div class="col-lg-3">
                            <input wire:model="ratios.top_neck" type="text" class="form-control" placeholder="0"/>
                            @error('ratios.top_neck') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <br>
                        @if ($student->national->gender_th == 'ชาย')


                            <label class="col-lg-1 col-form-label text-lg-right mb-4">รอบเอวกางเกง :</label>
                            <div class="col-lg-3">
                                <input wire:model="ratios.trousers_keepwaist" type="text" class="form-control"
                                       placeholder="0"/>
                                @error('ratios.trousers_keepwaist') <span
                                    class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <label class="col-lg-1 col-form-label text-lg-right mb-4">สะโพกกางเกง :</label>
                            <div class="col-lg-3">
                                <input wire:model="ratios.trousers_hip" type="text" class="form-control"
                                       placeholder="0"/>
                                @error('ratios.trousers_hip') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <label class="col-lg-1 col-form-label text-lg-right mb-4">เป้ากางเกง :</label>
                            <div class="col-lg-3">
                                <input wire:model="ratios.trousers_target" type="text" class="form-control"
                                       placeholder="0"/>
                                @error('ratios.trousers_target') <span
                                    class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <label class="col-lg-1 col-form-label text-lg-right mb-4">กางเกงยาว :</label>
                            <div class="col-lg-3">
                                <input wire:model="ratios.trousers_long" type="text" class="form-control"
                                       placeholder="0"/>
                                @error('ratios.trousers_long') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <label class="col-lg-1 col-form-label text-lg-right mb-4">รอบต้นขากางเกง :</label>
                            <div class="col-lg-3">
                                <input wire:model="ratios.trousers_aroundthigh" type="text" class="form-control"
                                       placeholder="0"/>
                                @error('ratios.trousers_aroundthigh') <span
                                    class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <label class="col-lg-1 col-form-label text-lg-right mb-4">ปลายขากางเกง :</label>
                            <div class="col-lg-3">
                                <input wire:model="ratios.trousers_tipleg" type="text" class="form-control"
                                       placeholder="0"/>
                                @error('ratios.trousers_tipleg') <span
                                    class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <label class="col-lg-1 col-form-label text-lg-right mb-4">น่องกางเกง :</label>
                            <div class="col-lg-3">
                                <input wire:model="ratios.trousers_calf" type="text" class="form-control"
                                       placeholder="0"/>
                                @error('ratios.trousers_calf') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                     @elseif ($student->national->gender_th == 'หญิง')

                            <label class="col-lg-1 col-form-label text-lg-right mb-4">รอบเอวกระโปรง:</label>
                            <div class="col-lg-3">
                                <input wire:model="ratios.skirts_keepwaist" type="text" class="form-control"
                                       placeholder="0"/>
                                @error('ratios.skirts_keepwaist') <span
                                    class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <label class="col-lg-1 col-form-label text-lg-right mb-4">สะโพกกระโปรง :</label>
                            <div class="col-lg-3">
                                <input wire:model="ratios.skirts_hip" type="text" class="form-control"
                                       placeholder="0"/>
                                @error('ratios.skirts_hip') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <label class="col-lg-1 col-form-label text-lg-right mb-4">เป้ากระโปรง :</label>
                            <div class="col-lg-3">
                                <input wire:model="ratios.skirts_target" type="text" class="form-control"
                                       placeholder="0"/>
                                @error('ratios.skirts_target') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <label class="col-lg-1 col-form-label text-lg-right mb-4">กระโปรงยาว :</label>
                            <div class="col-lg-3">
                                <input wire:model="ratios.skirts_long" type="text" class="form-control"
                                       placeholder="0"/>
                                @error('ratios.skirts_long') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <label class="col-lg-1 col-form-label text-lg-right mb-4">รอบต้นขากระโปรง :</label>
                            <div class="col-lg-3">
                                <input wire:model="ratios.skirts_aroundthigh" type="text" class="form-control"
                                       placeholder="0"/>
                                @error('ratios.skirts_aroundthigh') <span
                                    class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <label class="col-lg-1 col-form-label text-lg-right mb-4">ปลายขากระโปรง :</label>
                            <div class="col-lg-3">
                                <input wire:model="ratios.skirts_tipleg" type="text" class="form-control"
                                       placeholder="0"/>
                                @error('ratios.skirts_tipleg') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <label class="col-lg-1 col-form-label text-lg-right mb-4">น่องกระโปรง :</label>
                            <div class="col-lg-3">
                                <input wire:model="ratios.skirts_calf" type="text" class="form-control"
                                       placeholder="0"/>
                                @error('ratios.skirts_calf') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                 @endif


                    </div>
                </div>
            </div>

            <!--End_สัดส่วนเพิ่มเติมสำหรับไซต์ปกติ -->

            <div class="card-footer">
                <div class="grid grid-cols-2">
                    @if($classroom)
                        <div>
                            <a href="{{ route('classroom.student.index', $classroom->classroom_id) }}">
                                <button type="button" class="btn btn-secondary mr-2">
                                    {{ __('ย้อนกลับ') }}
                                </button>
                            </a>
                        </div>
                    @else
                        <div>
                            <a href="{{ route('non-register.student.index') }}">
                                <button type="button" class="btn btn-secondary mr-2">
                                    {{ __('ย้อนกลับ') }}
                                </button>
                            </a>
                        </div>
                    @endif
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary mr-2">บันทึก</button>
                    </div>
                </div>

                <div class="mt-2 mr-2 text-right text-success">
                    @if (session()->has('success'))
                        {{ session('success') }}
                    @endif
                </div>
            </div>
        </div>

    </form>

</div>
