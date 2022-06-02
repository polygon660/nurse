<?php

namespace App\Http\Livewire\Workspace;

use App\Exports\HistoryExport;
use App\Models\guest;
use App\Models\guest_type;
use App\Models\history;
use App\Models\medical;
use App\Models\prefix;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Show extends Component
{
    use WithPagination;

    public $search = '';

    public $history_data, $history_id, $guest_type, $code, $prefix, $name, $surname, $gender, $level, $room, $program, $weight, $height;

    public $select_id, $guest_id, $symptom, $medicine, $note;

    public $medical = [];

    protected $rules = [
        'guest_id' => 'required',
        'symptom' => 'required',
        'medical' => 'required',
        'medicine' => 'required',
        'note' => ''
    ];

    public function view($id)
    {
        $key = guest::findOrfail($id);
        $this->guest_id = $key->id;
        $this->guest_type = $key->guest_type->name;
        $this->code = $key->code;
        $this->prefix = $key->prefix->name;
        $this->name = $key->name;
        $this->surname = $key->surname;
        $this->gender = $key->gender->name ?? '';
        $this->level = $key->level->name ?? '';
        $this->room = $key->room->name ?? '';
        $this->program = $key->program->name ?? '';
        $this->weight = $key->weight;
        $this->height = $key->height;
    }

    public function export()
    {
        return Excel::download(new HistoryExport, 'invoices.xlsx');
    }

    public function save()
    {
        // dd($this->medical);

        $this->validate();

        try {
            history::create([
                'guest_id' => $this->guest_id,
                'symptom' => $this->symptom,
                'medical' => $this->medical,
                'medicine' => $this->medicine,
                'note' => $this->note,

            ]);
            $this->reset(['symptom', 'medical', 'medicine', 'note']);
            session()->flash('message', 'created!!');
        } catch (\Exception $e) {
            // alert($e);
            session()->flash('message', 'fail' . $e);
        }
    }

    public function cancel()
    {
        // $this->update = false;
        $this->reset();
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

                'datahistry' => history::where('guest_id', $this->guest_id)->paginate(10),
                'medicals' => medical::all()
            ]
        );
    }
}
