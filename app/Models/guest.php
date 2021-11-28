<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class guest extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'guests';

    protected $primaryKey = 'id';

    protected $guarded = [];



    public function guest_type()
    {
        return $this->belongsTo(guest_type::class);
    }

    public function gender()
    {
        return $this->belongsTo(gender::class);
    }

    public function prefix()
    {
        return $this->belongsTo(prefix::class);
    }

    public function history(){
        return  $this->hasMany(history::class, 'guest_id');
    }

    public function level()
    {
        return $this->belongsTo(level::class);
    }

    public function room()
    {
        return $this->belongsTo(room::class);
    }

    public function program()
    {
        return $this->belongsTo(program::class);
    }

    // public function role()
    // {
    //     return $this->hasOne(role::class);
    // }

}
