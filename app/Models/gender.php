<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class gender extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'genders';

    protected $primaryKey = 'id';

    protected $guarded = [];

    public function guest()
    {
        return $this->hasMany(guest::class);
    }
}
