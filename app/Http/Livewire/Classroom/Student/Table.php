<?php

namespace App\Http\Livewire\Classroom\Student;

use App\Models\Register\Students;
use Livewire\Component;

class Table extends Component
{
    public $classroom;

    public function render()
    {
        $students = Students::query()
            ->where('classroom_id', $this->classroom->classroom_id)
            ->where('status1', 'normal')
            ->where('status2', 0)
            ->with('national')
            ->orderBy('student_id')
            ->paginate(50);

        $studentscountm = Students::query()
            ->where('classroom_id', $this->classroom->classroom_id)
            ->where('status1', 'normal')
            ->where('status2', 0)
            ->whereHas('national', function ($query) {
                return $query->where('gender', 'M');
            })
            ->with('national')
            ->count();


        $studentscountf = Students::query()
            ->where('classroom_id', $this->classroom->classroom_id)
            ->where('status1', 'normal')
            ->where('status2', 0)
            ->whereHas('national', function ($query) {
                return $query->where('gender', 'F');
            })
            ->with('national')
            ->count();



        return view(
            'livewire.classroom.student.table',
            compact(
                'students',
                'studentscountm',
                'studentscountf'
            )
        );
    }
}
