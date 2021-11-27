<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class program extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'programs';

    protected $primaryKey = 'id';

    protected $guarded = [];

    public function guest()
    {
        return $this->hasMany(guest::class);
    }
}
