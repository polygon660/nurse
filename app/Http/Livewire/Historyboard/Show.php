<?php

namespace App\Http\Livewire\Historyboard;

use App\Exports\HistoryExport;
use App\Models\guest;
use App\Models\history;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Show extends Component
{

    use WithPagination;

    public $search = '';

    public $history_data, $guest_id, $history_id, $guest_type, $code, $prefix, $name, $surname, $gender, $level, $room, $program, $weight, $height;

    public function show($id)
    {
        // dd($id);

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

    public function render()
    {
        return view('livewire.historyboard.show')->with([
            'data' => history::with(['guest'])
                ->when($this->search, function ($query) {
                    return $query->whereHas('guest', function ($query) {

                        return $query->where('name', 'like', '%' . $this->search . '%')
                            ->orwhere('surname', 'like', '%' . $this->search . '%')
                            ->orwhere('code', 'like', '%' . $this->search . '%');
                    });
                })
                ->orderBy('created_at','desc')
                ->paginate(10),
            'datahistry' => history::where('guest_id', $this->guest_id)->paginate(10)
        ]);
    }
}
