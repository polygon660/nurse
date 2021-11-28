<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class medical extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'medicals';

    protected $primaryKey = 'id';

    protected $guarded = [];


}
