<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class prefix extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'prefixes';

    protected $primaryKey = 'id';

    protected $guarded = [];

    public function guest()
    {
        return $this->hasMany(guest::class);
    }
}
