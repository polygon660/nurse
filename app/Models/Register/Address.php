<?php

namespace App\Models\Register;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Address extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = "024920";

    protected $table = "reg_address";

    protected $primaryKey = "address_id";

    public function getLocationAttribute()
    {
        $location = '';

        $location.= $this->house_number;
        if($this->moo && $this->moo != "-"){
            $location.= ' หมู่ '.$this->moo;
        }
        if($this->soi && $this->soi != "-"){
            $location.= ' ซอย '.$this->soi;
        }
        if($this->road && $this->road != "-"){
            $location.= ' ถนน '.$this->road;
        }
        $location.= ' '.$this->sub_district;
        $location.= ' '.$this->district;
        $location.= ' '.$this->province;
        $location.= ' '.$this->postal_code;
        return $location;
    }
}
