<?php

namespace App\Models\Register;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Religion extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = "024920";

    protected $table = "reg_religion";

    protected $primaryKey = "religion_id";
}
