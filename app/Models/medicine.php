<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class medicine extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'medicines';

    protected $primaryKey = 'id';

    protected $guarded = [];

    public function history()
    {
        return $this->hasMany(history::class);
    }
}
