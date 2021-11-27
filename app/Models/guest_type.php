<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class guest_type extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'guest_types';

    protected $primaryKey = 'id';

    protected $guarded = [];

    public function guest()
    {
        return $this->hasMany(guest::class);
    }

}
