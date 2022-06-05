<?php

namespace App\Models\HR;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\HR\Major;


class Position extends Model
{
    use HasFactory;
    
    protected $connection = '024920';

    protected $table = '024920.hr_position';

    protected $primaryKey = 'position_id';

    public function major()
    {
        return $this->hasOne(Major::class, 'major_id', 'major_id');
    }
}
