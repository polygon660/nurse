<?php

namespace App\Models\Education;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Round extends Model
{

    use HasFactory, SoftDeletes;

    protected $connection = '024920';

    protected $table = '024920.edu_round';

    protected $primaryKey = 'round_id';
}
