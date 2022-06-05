<?php

namespace App\Http\Livewire\Workspace;

use App\Exports\HistoryExport;
use App\Models\Education\Classroom;
use App\Models\guest;
use App\Models\guest_type;
use App\Models\history;
use App\Models\medical;
use App\Models\prefix;
use App\Models\Register\Students;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Show extends Component
{
    use WithPagination;

    public $search = '';

    public $history_data, $history_id, $guest_type, $code, $prefix, $name, $surname, $gender,  $room, $program, $weight, $height;
    public $guest_type_id;
    public $select_id, $guest_id, $symptom, $medicine, $note;
    public $input_height,$input_weight;
    public $general_id;


    public $medical = [];

    public $year = '';
    public $level = '';
    public $round = '';
    public $major = '';
    // public $search = '';
    public $term = '';

    protected $rules = [
        'guest_id' => 'required',
        'symptom' => 'required',
        'medical' => 'required',
        'medicine' => 'required',
        'note' => ''
    ];

    public function view($id)
    {

        $key = Students::findOrfail($id);
        $this->code = $key->student_id;
        if ($key->student_id) {
            $this->guest_type_id = 3;
        }
        $this->general_id = $key->register_id;
        // $key = guest::findOrfail($id);
        // $this->guest_id = $key->id;
        // $this->guest_type = $key->guest_type->name;
        // $this->code = $key->code;
        // $this->prefix = $key->prefix->name;
        // $this->name = $key->name;
        // $this->surname = $key->surname;
        // $this->gender = $key->gender->name ?? '';
        // $this->level = $key->level->name ?? '';
        // $this->room = $key->room->name ?? '';
        // $this->program = $key->program->name ?? '';
        // $this->input_weight = $key->weight;
        // $this->input_height = $key->height;
        // ---------------------------------------  //

        $guest = guest::where('code',$id)->first();
        $this->input_weight = $guest->weight;
        $this->input_height = $guest->height;
        // dd($guest->weight);


    }

    public function export()
    {
        return Excel::download(new HistoryExport, 'invoices.xlsx');
    }

    public function save()
    {

        // $this->validate();

        try {

                $guest = guest::where('code', $this->general_id)->first();
                $this->guest_id = $guest->id;

                history::create([
                    'guest_id' => $this->guest_id,
                    'symptom' => $this->symptom,
                    'medical' => $this->medical,
                    'medicine' => $this->medicine,
                    'note' => $this->note,

                ]);
                session()->flash('message', 'created!!');
           
        } catch (\Throwable $th) {

           $his = guest::create([
                'guest_type_id' => $this->guest_type_id,
                'code' => $this->general_id,
                // 'prefix_id' =>  $this->input_prefix,
                // 'name' =>  $this->input_name,
                // 'surname' => $this->input_surname,
                // 'gender_id' => $this->input_gender,
                // 'level_id' => $this->input_level,
                // 'room_id' => $this->input_room,
                // 'program_id' => $this->input_program,
                'weight' => $this->input_weight,
                'height' => $this->input_height,
            ]);
            $guest = guest::where('code', $this->general_id)->first();
            $this->guest_id = $guest->id;
                history::create([
                    'guest_id' => $this->guest_id,
                    'symptom' => $this->symptom,
                    'medical' => $this->medical,
                    'medicine' => $this->medicine,
                    'note' => $this->note,

                ]);
                
        }

        // $guest = guest::where('code',$this->general_id)->get();

        // dd($guest->code);

        // try {


        //     history::create([
        //         'guest_id' => $this->guest_id,
        //         'symptom' => $this->symptom,
        //         'medical' => $this->medical,
        //         'medicine' => $this->medicine,
        //         'note' => $this->note,

        //     ]);
        //     $this->reset(['symptom', 'medical', 'medicine', 'note']);
        //     session()->flash('message', 'created!!');
        // } catch (\Exception $e) {
        //     // alert($e);
        //     session()->flash('message', 'fail' . $e);
        // }
    }

    public function cancel()
    {
        // $this->update = false;
        $this->reset();
    }

    public function mount()
    {

        $year = Classroom::max('eduyear');
        $term = Classroom::where('eduyear', $year)->max('edu_term');
        $this->year = $year;
        $this->term = $term;
    }


    public function render()
    {
        return view(
            'livewire.workspace.show',
            [
                // 'select' => guest::all(),

                // 'guest' => guest::when($this->search, function ($query) {
                //     return $query->where('name', 'like', '%' . $this->search . '%')
                //         ->orwhere('surname', 'like', '%' . $this->search . '%')
                //         ->orwhere('code', 'like', '%' . $this->search . '%');
                // })->paginate(10),
                'guest' => guest::with(['guest_type', 'prefix', 'level', 'room', 'program'])->where('name', 'like', '%' . $this->search . '%')
                    ->orwhere('surname', 'like', '%' . $this->search . '%')
                    ->orwhere('code', 'like', '%' . $this->search . '%')
                    ->paginate(30),
                'data' =>
                Students::query()
                    // ->where('start_year', $this->year)
                    ->whereNotNull('run_no')
                    ->whereNotNull('student_id')
                    ->whereNotNull('classroom_id')
                    // ->where('classroom_id', $this->classroom->classroom_id)
                    ->where('status1', 'normal')
                    ->where('status2', 0)
                    ->when($this->search, function ($query) {
                        return $query
                            ->whereHas('national', function ($query) {
                                return $query->where('student_id', 'LIKE', '%' . $this->search . '%')
                                    ->orwhere('national_id', 'LIKE', '%' . $this->search . '%')
                                    ->orWhere('fname', 'LIKE', '%' . $this->search . '%')
                                    ->orWhere('sname', 'LIKE', '%' . $this->search . '%');
                            });
                    })
                    ->with('national')
                    ->orderBy('student_id')
                    ->take(10)
                    ->get(),
                'datahistry' => history::where('guest_id', $this->guest_id)->paginate(10),
                'medicals' => medical::all()
            ]
        );
    }
}
