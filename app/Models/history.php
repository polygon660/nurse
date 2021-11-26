<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class history extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'histories';

    protected $primaryKey = 'id';

    protected $guarded = [];

}
