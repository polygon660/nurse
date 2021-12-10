<?php

namespace App\Http\Livewire\Workspace;

use App\Models\guest;
use App\Models\guest_type;
use App\Models\history;
use App\Models\prefix;
use Livewire\Component;
use Livewire\WithPagination;

class Show extends Component
{
    use WithPagination;

    public $search = '';

    public $history_data, $history_id, $guest_type, $code, $prefix, $name, $surname, $gender, $level, $room, $program, $weight, $height;

    public $select_id, $guest_id, $symptom, $medical, $medicine;

    protected $rules = [
        'guest_id' => 'required',
        'symptom' => 'required',
        'medical' => 'required',
        'medicine' => 'required',
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

    public function save()
    {
        $validated = $this->validate();

        try {
            history::create($validated);
            session()->flash('message', 'created!!');
        } catch (\Exception $e) {
            session()->flash('message', 'fail' . $e);
        }
    }

    public function render()
    {
        return view(
            'livewire.workspace.show',
            [
                // 'select' => guest::all(),
                'guest' => guest::with(['guest_type','prefix'])->when($this->search, function ($query) {
                    return $query->where('name', 'like', '%' . $this->search . '%')
                        ->orwhere('surname', 'like', '%' . $this->search . '%')
                        ->orwhere('code', 'like', '%' . $this->search . '%');
                })->paginate(10),
                'datahistry' => history::where('guest_id', $this->guest_id)->paginate(10)
            ]
        );
    }
}
