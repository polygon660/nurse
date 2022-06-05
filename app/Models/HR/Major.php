<?php

namespace App\Models\HR;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    use HasFactory;

    protected $connection = '024920';

    protected $table = 'hr_major';

    protected $primaryKey = 'major_id';

    public function major_leader()
    {
        return $this->hasOne(Position::class, 'major_id')->where('level', 4)
            ->where('status', 'Active');
    }
}
