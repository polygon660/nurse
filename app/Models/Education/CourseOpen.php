<?php

namespace App\Models\Education;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseOpen extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = '024920';

    protected $table = '024920.edu_course_open';

    protected $primaryKey = 'course_open_id';

    public function classroom()
    {
        return $this->hasMany('App\Models\Education\Classroom', 'course_open_id')->where('status', 'active');
    }

    public function round()
    {
        return $this->belongsTo('App\Models\Education\Round', 'round_id');
    }

    public function subMajor()
    {
        return $this->belongsTo('App\Models\Education\SubMajor', 'sub_major_id');
    }

    public function receivables()
    {
        return $this->hasMany('App\Models\Finance\Receivables', 'course_open_id');
    }
}
