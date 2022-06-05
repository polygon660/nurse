<?php

namespace App\Models\Education;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RegisterCourseOpen extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = '024920';

    protected $table = '024920.edu_register_course_open';

    protected $primaryKey = 'register_course_open_id';

    public function courseOpen()
    {
        return $this->belongsTo('App\Models\Education\CourseOpen', 'course_open_id');
    }
}
