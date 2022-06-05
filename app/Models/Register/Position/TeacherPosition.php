<?php

namespace App\Models\Register\Position;

use App\Models\Register\NationalIDCard;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherPosition extends Model
{
    use HasFactory;
    
    protected $connection = '024920';

    protected $table = '024920.reg_register_teacher_position';

    protected $primaryKey = 'register_teacher_position';

    public function national()
    {
        return $this->belongsTo(NationalIDCard::class, 'teacher_card_id');
    }

}
