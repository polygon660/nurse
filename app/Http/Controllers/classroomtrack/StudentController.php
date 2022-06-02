<?php

namespace App\Http\Controllers\classroomtrack;

use App\Http\Controllers\Controller;
use App\Models\Education\Classroom;
use App\Models\Register\Students;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Classroom $classroom)
    {
        return view('pages.track.student.index', compact('classroom'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
 
    // public function table(Classroom $classroom, Students $student)
    // {
    //     return view('pages.track.student.show', compact('classroom', 'student'));

    // }
 
     public function show(Classroom $classroom, Students $student)
    {
        return view('pages.track.student.table', compact('classroom', 'student'));

    }
}
