<?php

namespace App\Http\Livewire\Workspace;

use App\Models\guest;
use App\Models\history;
use Livewire\Component;

class Show extends Component
{
    public $search = '';

    public $select_id, $guest_id, $symptom, $medical, $medicine;

    protected $rules = [
        'guest_id' => 'required',
        'symptom' => 'required',
        'medical' => 'required',
        'medicine' => 'required',
    ];

    public function show($id)
    {
        $key = guest::findOrFail($id);
        $this->guest_id = $key->id;
        $this->guest_type = $key->guest_type->name;
        $this->guest_name = $key->fullname;
        $this->guest_gender = $key->gender->name;
        $this->guest_level = $key->level->name;
        $this->guest_room = $key->room->name;
        $this->guest_program = $key->program->name;
    }

    public function save()
    {
        $this->validate();

        try {
            history::create();
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
                'select' => guest::all()
            ]
        );
    }
}
