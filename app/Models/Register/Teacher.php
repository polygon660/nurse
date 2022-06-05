<?php

namespace App\Models\Register;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Teacher extends Model
{
    use HasFactory;
    protected $connection = '024920';

    protected $table = '024920.reg_register_teacher';

    protected $primaryKey = 'register_id';

    protected static function booted()
    {
        static::addGlobalScope('ancient', function (Builder $builder) {
            $builder->where('status', 'Active');
        });
    }

    public function HrPosition()
    {
        return $this->belongsTo('App\Models\HR\Position', 'position_id');
    }

    public function TeacherHrPosition()
    {
        return $this->hasManyThrough(
            'App\Models\HR\Position',
            'App\Models\Register\Position\TeacherPosition',
            'register_teacher_id',
            'position_id',
            'register_id',
            'position_id'
        )
            ->where('reg_register_teacher_position.status_position', 'Active')
            ->whereNotNull('reg_register_teacher_position.position_id')
            ->orderBy('hr_position.level', 'DESC');
    }


    public function TeacherHrPositionMajor()
    {
        return $this->hasOneThrough(
            'App\Models\HR\Position',
            'App\Models\Register\Position\TeacherPosition',
            'register_teacher_id',
            'position_id',
            'register_id',
            'position_id'
        )
            ->where('reg_register_teacher_position.status_position', 'Active')
            ->whereNotNull('reg_register_teacher_position.position_id')
            ->whereNotNull('hr_position.major_id')
            ->orderBy('hr_position.level', 'DESC');
    }

    public function national()
    {
        return $this->belongsTo(NationalIDCard::class, 'teacher_card_id');
    }

    public function admin()
    {
        return $this->hasOne(Admin::class, 'teacher_id', 'teacher_id');
    }

}
