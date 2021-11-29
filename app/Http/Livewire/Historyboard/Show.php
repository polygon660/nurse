<?php

namespace App\Http\Livewire\Historyboard;

use App\Models\guest;
use App\Models\history;
use Livewire\Component;
use Livewire\WithPagination;

class Show extends Component
{

    use WithPagination;

    public $history_data, $guest_id, $history_id, $guest_type, $code, $prefix, $name, $surname, $gender, $level, $room, $program, $weight, $height;

    public function view($id)
    {
        // dd($id);
        // GuestInfo
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

        // HistoryInfo
        // $datahistry = history::where('guest_id', $this->guest_id)->paginate(10);
        // $this->history = history::where('guest_id', $this->guest_id)->paginate(10);
        // $this->history_data = history::all();
        // $this->history_data->all();
        // dd($this->history_data);
    }

    public function render()
    {
        return view('livewire.historyboard.show')->with([
            'data' => history::paginate(10),
            'datahistry' => history::where('guest_id', $this->guest_id)->paginate(10)
        ]);
    }
}
