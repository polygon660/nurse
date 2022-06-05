<?php

namespace App\Http\Livewire\Classroom;

use App\Models\Education\Classroom;
use App\Models\Education\SubMajor;
use App\Models\Register\Students;

use Livewire\Component;
use Livewire\WithPagination;


// use App\Exports\TemplateRatiosProductsExcel;
// use App\Imports\RatiosProductsImport;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class Table extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $year = '';
    public $level = '';
    public $round = '';
    public $major = '';
    public $search = '';
    public $term = '';
    public $file;


    public function mount()
    {
        $year = Classroom::max('eduyear');
        $term = Classroom::where('eduyear', $year)->max('edu_term');
        $this->year = $year;
        $this->term = $term;
    }

    public function render()
    {
        $classrooms = Classroom::query()
            ->where('eduyear', $this->year)
            ->where('edu_term', $this->term)
            ->where('status', 'normal')
            ->whereIn('classno', [1, 2, 3])
            ->whereHas('courseOpen', function ($query) {
                return $query->where('round_id', 2);
            })
            ->when($this->level, function ($query) {
                return $query->where("classno", $this->level);
            })
            ->when($this->major, function ($query) {
                return $query->whereHas('subMajor', function ($query) {
                    return $query->where('sub_major_short_name', strtoupper($this->major));
                });
            })
            ->when($this->search, function ($query) {
                return $query->whereHas('student', function ($query) {
                    return $query->where('student_id', 'LIKE', $this->search . '%');
                });
            })
            ->with('round', 'subMajor')
            ->orderBy('orderby', 'ASC')
            ->paginate(12);

        $majors = collect(SubMajor::all())
            ->where('sub_major_short_name', '!=', "")
            ->unique('sub_major_short_name');

        $studentscountm1 = Students::query() //ชายรอบเช้า
            ->where('status1', 'normal')
            ->where('status2', 0)
            ->whereHas('national', function ($query) {
                return $query->where('gender', 'M');
            })
            ->whereHas('courseOpen', function ($query) {
                return $query->where('round_id', 2);
            })
            ->whereHas('classroom', function ($query) {
                return $query->where('eduyear', $this->year)
                    ->where('edu_term', $this->term)
                    ->where('status', 'normal')
                    ->whereIn('classno', [1]);
            })
            ->with('national', 'classroom')
            ->count();

        $studentscountf1 = Students::query() //หญิงรอบเช้า
            ->where('status1', 'normal')
            ->where('status2', 0)
            ->whereHas('national', function ($query) {
                return $query->where('gender', 'F');
            })
            ->whereHas('courseOpen', function ($query) {
                return $query->where('round_id', 2);
            })
            ->whereHas('classroom', function ($query) {
                return $query->where('eduyear', $this->year)
                    ->where('edu_term', $this->term)
                    ->where('status', 'normal')
                    ->whereIn('classno', [1]);
            })
            ->with('national', 'classroom')
            ->count();


        return view('livewire.classroom.table', compact(
            'classrooms',
            'majors',
            'studentscountm1',
            'studentscountf1',
        ));
    }

    public function firstPage()
    {
        $this->page = 1;
    }

    // public function export_template($classroom_id, $name)
    // {
    //     $name = str_replace('/', '-', str_replace('ปวช.', '', $name)) . '.xlsx';
    //     return Excel::download(new TemplateRatiosProductsExcel($classroom_id), $name);
    // }
    // public function import_template()
    // {
    //     Excel::import(new RatiosProductsImport, $this->file);
    //     session()->flash('message', 'นำเข้าข้อมูลสำเร็จ');
    // }
}
