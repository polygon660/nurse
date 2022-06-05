<?php

namespace App\Models\Education;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Classroom extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = '024920';

    protected $table = '024920.edu_classroom';

    protected $primaryKey = 'classroom_id';


    public function student()
    {
        return $this->hasMany('App\Models\Register\Students', 'classroom_id')
            ->where('status1', 'normal')
            ->where('status2', 0)
            ->orderByDesc('student_id');
    }

    public function courseOpen()
    {
        return $this->belongsTo('App\Models\Education\CourseOpen', 'course_open_id');
    }

    public function round()
    {
        return $this->hasOneThrough(
            'App\Models\Education\Round',
            'App\Models\Education\CourseOpen',
            'course_open_id',
            'round_id',
            'course_open_id',
            'round_id'
        );
    }

    public function subMajor()
    {
        return $this->hasOneThrough(
            'App\Models\Education\SubMajor',
            'App\Models\Education\CourseOpen',
            'course_open_id',
            'sub_major_id',
            'course_open_id',
            'sub_major_id'
        );
    }

    public function RatiosProducts()
    {
        return $this->hasManyThrough(
            'App\Models\RatiosProducts',
            'App\Models\Register\Students',
            'classroom_id',
            'student_id',
            'classroom_id',
            'register_id'
        );
    }

    public function Track()
    {
        return $this->hasManyThrough(
            'App\Models\Track',
            'App\Models\Register\Students',
            'classroom_id',
            'student_id',
            'classroom_id',
            'register_id'
        );
    }

    public function getTrackStatusAttribute()
    {
        $status = [
            "value" => "danger",
            "message" => "ยังไม่ดำเนินการ"
        ];

        $track = collect($this->Track);

        $warning = $track->count();

        $success = $track->where('status', $this->classno)->count();

        $students = $this->student->count();

        if ($success === $students) {
            $status['value'] = "success";
            $status['message'] = 'เสร็จสิ้น';
        } elseif ($warning < $students && $warning !== 0) {
            $status['value'] = "warning";
            $status['message'] = 'กำลังดำเนินการ';
        }
        
        return (object) $status;
    }



    public function getRatioProductStatusAttribute()
    {
        $status = [
            "value" => "danger",
            "message" => "ยังไม่ดำเนินการ"
        ];

        $ratios = collect($this->RatiosProducts);

        $warning = $ratios->count();

        $success = $ratios->where('status_products', $this->classno)->count();

        $students = $this->student->count();

        if ($success === $students) {
            $status['value'] = "success";
            $status['message'] = 'เสร็จสิ้น';
        } elseif ($warning < $students && $warning !== 0) {
            $status['value'] = "warning";
            $status['message'] = 'กำลังดำเนินการ';
        }
        
        return (object) $status;
    }
}
