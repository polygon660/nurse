<?php

namespace App\Models\Education;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Major extends Model
{
    use HasFactory,SoftDeletes;
    
    protected $connection = '024920';

    protected $table = 'edu_major';

    protected $primaryKey = 'edu_major_id';
}
