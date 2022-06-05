<?php

namespace App\Http\Livewire\NonRegister\Student;

use App\Models\Education\SubMajor;
use App\Models\Register\Students;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    public $year;
    public $major;
    public $status = 'danger';
    public $search;
    public $majors = [];

    public function mount()
    {
        $this->year = Students::max('start_year');

        $this->majors = collect(SubMajor::all())
            ->where('sub_major_short_name', '!=', "")
            ->unique('sub_major_short_name');
    }

    public function render()
    {
        $students = Students::query()
            ->where('start_year', $this->year)
            ->whereNotNull('run_no')
            ->whereNull('student_id')
            ->whereNull('classroom_id')
            ->where('status1', 'normal')
            ->where('status2', 0)
            ->when($this->major, function ($query) {
                return $query->whereHas('registerCourseOpen.subMajor', function ($query) {
                    return $query->where('sub_major_short_name', $this->major);
                });
            })
            ->when($this->status, function ($query) {
                if ($this->status = 'danger') {
                    return $query->whereDoesntHave('RatiosProducts');
                } elseif ($this->status = 'warning') {
                    return $query->whereHas('RatiosProducts', function ($query) {
                        return $query->where('status_products', 0);
                    });
                } else {
                    return $query->whereHas('RatiosProducts', function ($query) {
                        return $query->where('status_products', 1);
                    });
                }
            })
            ->when($this->search, function ($query) {
                return $query->whereHas('national', function ($query) {
                    return $query->where('national_id', 'LIKE', '%' . $this->search . '%')
                        ->orWhere('fname', 'LIKE', '%' . $this->search . '%')
                        ->orWhere('sname', 'LIKE', '%' . $this->search . '%');
                });
            })
            ->paginate(20);



        return view('livewire.non-register.student.table', compact(['students']));
    }
}
