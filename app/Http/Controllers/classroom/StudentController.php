<?php

namespace App\Http\Controllers\classroom;

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
        return view('pages.classroom.student.index', compact('classroom'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Classroom $classroom, Students $student)
    {

        return view('pages.classroom.student.show', compact('classroom', 'student'));
    }
}
