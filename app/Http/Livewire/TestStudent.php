<?php

namespace App\Http\Livewire;

use App\Models\Register\Students;
use Livewire\Component;

class TestStudent extends Component
{
    public $search = '';

    public function render()
    {
        return view('livewire.test-student', [

            'data' => Students::query()
                // ->where('classroom_id', $this->classroom->classroom_id)
                ->where('status1', 'normal')
                ->where('status2', 0)
                ->when($this->search, function ($query) {
                        return $query->where('student_id', 'LIKE', $this->search . '%');
                    })
                ->with('national')
                ->orderBy('student_id')
                ->take(1)
                ->get()

        ]);
    }
}
