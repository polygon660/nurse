<?php

namespace App\Http\Livewire\Classroom\Student;

use App\Models\RatiosProducts;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\CmChefs;
use App\Models\CmLongshirt;
use App\Models\CmLongshirtsmls;
use App\Models\CmProgram;
use App\Models\CmShirt;
use App\Models\CmShirtfm;
use App\Models\CmSkirt;
use App\Models\CmTrouserChefs;
use App\Models\CmShoeChefs;
use App\Models\CmTrousers;


class Form extends Component
{
    public $classroom;
    public $student;
    public $classname;
    public $major;

    public $updateMode = null;

    public $ratios = [
        'student_id' => null,
        'gender' => null,
        'suit' => null,
        'suit_keepwaist' => null,
        'suit_fronthubcut' => null,
        'top_longshirt' => null,
        'top_longarm' => null,
        'top_forearm' => null,
        'top_chest' => null,
        'top_shoulder' => null,
        'top_backshoulder' => null,
        'top_upperarm' => null,
        'top_broadshoulder' => null,
        'top_waistline' => null,
        'top_hip' => null,
        'top_neck' => null,
        'shirt_shorts' => null,
        'shirt_longs' => null,
        'trousers' => null,
        'trousers_keepwaist' => null,
        'trousers_hip' => null,
        'trousers_target' => null,
        'trousers_long' => null,
        'trousers_aroundthigh' => null,
        'trousers_tipleg' => null,
        'trousers_calf' => null,
        'skirts' => null,
        'skirts_keepwaist' => null,
        'skirts_hip' => null,
        'skirts_target' => null,
        'skirts_long' => null,
        'skirts_aroundthigh' => null,
        'skirts_tipleg' => null,
        'skirts_calf' => null,
        'neckties' => 1,
        'belt_buckle' => 1,
        'belt' => null,
        'shirt_freshys' => null,
        'shirt_programs' => null,
        'shirt_chefs' => null,
        'trouser_chefs' => null,
        'shoe_chefs' => null,
        'note' => null,
        'status_products' => null,
        'status_checks' => null,
        'eduyear' => null
    ];

    public function rules()
    {
        return [
            'ratios.student_id' => 'required|unique:App\Models\RatiosProducts,student_id,' . $this->updateMode,
            'ratios.gender' => 'required|in:"ชาย","หญิง"',
            'ratios.suit' => 'nullable',
            'ratios.suit_keepwaist' => 'nullable',
            'ratios.suit_fronthubcut' => 'nullable',
            'ratios.top_longshirt' => 'nullable',
            'ratios.top_longarm' => 'nullable',
            'ratios.top_forearm' => 'nullable',
            'ratios.top_chest' => 'nullable',
            'ratios.top_shoulder' => 'nullable',
            'ratios.top_backshoulder' => 'nullable',
            'ratios.top_upperarm' => 'nullable',
            'ratios.top_broadshoulder' => 'nullable',
            'ratios.top_waistline' => 'nullable',
            'ratios.top_hip' => 'nullable',
            'ratios.top_neck' => 'nullable',
            'ratios.shirt_shorts' => 'nullable',
            'ratios.shirt_longs' => 'nullable',
            'ratios.trousers' => 'nullable',
            'ratios.trousers_hip' => 'nullable',
            'ratios.trousers_target' => 'nullable',
            'ratios.trousers_long' => 'nullable',
            'ratios.trousers_aroundthigh' => 'nullable',
            'ratios.trousers_keepwaist' => 'nullable',
            'ratios.trousers_tipleg' => 'nullable',
            'ratios.trousers_calf' => 'nullable',
            'ratios.skirts' => 'nullable',
            'ratios.skirts_keepwaist' => 'nullable',
            'ratios.skirts_hip' => 'nullable',
            'ratios.skirts_target' => 'nullable',
            'ratios.skirts_long' => 'nullable',
            'ratios.skirts_aroundthigh' => 'nullable',
            'ratios.skirts_tipleg' => 'nullable',
            'ratios.skirts_calf' => 'nullable',
            'ratios.neckties' => 'nullable',
            'ratios.belt_buckle' => 'nullable',
            'ratios.belt' => 'nullable',
            'ratios.shirt_freshys' => 'nullable',
            'ratios.shirt_programs' => 'nullable',
            'ratios.shirt_chefs' => 'nullable',
            'ratios.trouser_chefs' => 'nullable',
            'ratios.shoe_chefs' => 'nullable',
            'ratios.note' => 'nullable',
            'ratios.status_products' => 'required|in:1,2,3',
            'ratios.status_checks' => 'nullable',
            'ratios.eduyear' => 'required',
        ];
    }

    protected $messages = [
        'ratios.student_id.required' => 'ดึงข้อมูลรหัสนักเรียนไม่สำเร็จ',
        'ratios.student_id.unique' => 'รหัสนักเรียนซ้ำ',
        'ratios.gender.required' => 'กรุณาเลือกช่องนี้',
        'ratios.gender.in' => 'ข้อมูลไม่ถูกต้อง',
        'ratios.status_products.required' => 'กรุณาเลือกช่องนี้',
        'ratios.status_products.in' => 'ข้อมูลไม่ถูกต้อง',
        'ratios.eduyear.required' => 'ดึงข้อมูลปีการศึกษานักเรียนไม่สำเร็จ',
    ];

    public function mount()
    {
        if ($this->student->student_id === null && $this->student->classroom_id === null) {
            $this->classname = 'ยังไม่ทราบ';
            $this->major = '';
        }
        $ratios = RatiosProducts::where('student_id', $this->student->register_id)->first();

        if ($ratios) {
            $this->updateMode = $ratios->id;
            $this->ratios = collect($ratios)->toArray();
            $this->ratios['eduyear'] = $this->student->classroom->eduyear;
        } else {
            $this->ratios['student_id'] = $this->student->register_id;
            $this->ratios['gender'] = $this->student->national->gender_th;
            $this->ratios['eduyear'] = $this->student->classroom->eduyear;
        }
    }

    public function render()
    {
        $shirtm = CmShirt::orderBy('orderlist')->get();
        $shirtfm = CmShirtfm::orderBy('orderlist')->get();
        $longshirtm = CmLongshirtsmls::orderBy('orderlist')->get();
        $longshirtfm = CmLongshirt::orderBy('orderlist')->get();
        $trouser = CmTrousers::orderBy('orderlist')->get();
        $skirt = CmSkirt::orderBy('orderlist')->get();
        $program = CmProgram::orderBy('orderlist')->get()->unique('size');
        $chef = CmChefs::orderBy('orderlist')->get();
        $trouserchef = CmTrouserChefs::orderBy('orderlist')->get();
        $shoechefs = CmShoeChefs::orderBy('orderlist')->get();


        return view('livewire.classroom.student.form', [
            'student' => $this->student
                    ])
             ->with(compact('shirtm',
                     'shirtfm',
                     'longshirtm',
                     'longshirtfm',
                     'trouser',
                     'skirt',
                     'program',
                     'chef',
                     'trouserchef',
                     'shoechefs'  ));
    }

    public function save()
    {

        $this->resetErrorBag();
        $validated = $this->validate();

        RatiosProducts::updateOrCreate([
            'id' => $this->updateMode
        ], $validated['ratios']);

        session()->flash('success', 'บันทึกข้อมูลสำเร็จ');
        return redirect()->route('classroom.student.index', $this->classroom->classroom_id);
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
}
