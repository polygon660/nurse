<?php

namespace App\Models\Education;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubMajor extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = '024920';
    protected $table = '024920.edu_sub_major';
    protected $primaryKey = 'sub_major_id';
    public $timestamps = false;
}
