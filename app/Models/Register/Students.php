<?php

namespace App\Models\Register;

use App\Models\guest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\RatiosProducts;
use App\Models\Track;




class Students extends Model
{
    use HasFactory;

    protected $connection = '024920';

    protected $table = '024920.reg_register_student';

    protected $primaryKey = 'register_id';


    public function RatiosProducts()
    {

        return $this->hasOne(RatiosProducts::class, 'student_id', 'register_id')
            ->withDefault(['status_product' => null]);

    }

    public function guest()
    {

        return $this->hasOne(guest::class, 'code', 'register_id');

    }

    // public function Track()
    // {

    //     return $this->hasOne(Track::class, 'student_id', 'register_id')
    //     ->orderByRaw("year Desc, team Desc, created_at Desc")
    //     ->withDefault(['status' => null]);


        
    // }
    


    // public function getTrackStatusAttribute()
    // {
    //     $status = [
    //         "value" => "danger",
    //         "message" => "ยังไม่ดำเนินการ"
    //     ];

    //     $track = (int)$this->Track->status;

    //     if ($this->classroom_id) {
    //         $classroom = (int)$this->classroom->classno;
    //     }else{
    //         $classroom = 1;
    //     }

    //     if($this->Track->status !== null)
    //     {
    //         $status['value'] = "warning";
    //         $status['message'] = 'กำลังดำเนินการ';
    //     }

    //     if ($track === $classroom) {
    //         $status['value'] = "success";
    //         $status['message'] = 'เพิ่ม Track ครั้งที่ '.$classroom;
    //     }

    //     return (object)$status;
    // }



    // public function getRatioProductStatusAttribute()
    // {
    //     $status = [
    //         "value" => "danger",
    //         "message" => "ยังไม่ดำเนินการ"
    //     ];

    //     $ratios = (int)$this->RatiosProducts->status_products;

    //     if ($this->classroom_id) {
    //         $classroom = (int)$this->classroom->classno;
    //     }else{
    //         $classroom = 1;
    //     }

    //     if($this->RatiosProducts->status_products !== null or $this->RatiosProducts->created_at !== null)
    //     {
    //         $status['value'] = "warning";
    //         $status['message'] = 'กำลังดำเนินการ';
    //     }

    //     if ($ratios === $classroom) {
    //         $status['value'] = "success";
    //         $status['message'] = 'ได้รับของแล้วตอนปี '.$classroom;
    //     }

    //     return (object)$status;
    // }

    public function user()
    {
        return $this->hasOne('App\Models\User', 'username', 'student_id');
    }

    public function classroom()
    {
        return $this->belongsTo('App\Models\Education\Classroom', 'classroom_id');
    }

    public function national()
    {
        return $this->belongsTo('App\Models\Register\NationalIDCard', 'student_card_id');
    }

    public function courseOpen()
    {
        return $this->hasOneThrough(
            'App\Models\Education\CourseOpen',
            'App\Models\Education\Classroom',
            'classroom_id',
            'course_open_id',
            'classroom_id',
            'course_open_id'
        )
            ->where('edu_course_open.status', 'Active')
            ->orderByDesc('edu_course_open.course_open_id');
    }

    public function registerCourseOpen()
    {
        return $this->hasOneThrough(
            'App\Models\Education\CourseOpen',
            'App\Models\Education\RegisterCourseOpen',
            'register_id',
            'course_open_id',
            'register_id',
            'course_open_id'
        )->orderByDesc('register_course_open_id');
    }
}
