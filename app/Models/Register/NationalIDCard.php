<?php

namespace App\Models\Register;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class NationalIDCard extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = '024920';

    protected $table = '024920.reg_national_id_card';

    protected $primaryKey = 'card_id';

    public function getFullnameAttribute()
    {
        $full_name = '';
        $full_name.= $this->prefixs ? $this->prefixs->prefix_name : '';
        $full_name.= $this->fname;
        $full_name.= ' '.$this->sname;
        return $full_name;
    }

    public function getBirthdateAttribute()
    {
        $strYear = date("Y",strtotime($this->date_of_birth))+543;
        $strMonth= date("n",strtotime($this->date_of_birth));
        $strDay= date("d",strtotime($this->date_of_birth));
        $strMonthCut = ["","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค."];
        $strMonthThai=$strMonthCut[$strMonth];
        return $strDay." ".$strMonthThai." พ.ศ. ".$strYear;
    }

    public function getAgeAttribute()
    {
        return Carbon::parse($this->date_of_birth)->age;
    }

    public function getGenderThAttribute()
    {
        $gender = "ไม่ระบุ";

        if($this->gender === "M"){
            $gender = "ชาย";
        }elseif($this->gender === "F"){
            $gender = "หญิง";
        }
        return $gender;
    }

    public function user(){
        return $this->hasMany('App\Models\User', 'card_id');
    }

    public function prefixs(){
        return $this->hasOne('App\Models\Register\Prefix', 'prefix_id', 'prefix');
    }

    public function religion(){
        return $this->hasOne('App\Models\Register\Religion', 'religion_id', 'religion_id');
    }

    public function home_address(){
        return $this->hasOne('App\Models\Register\Address', 'address_id', 'address_id');
    }

    public function current_address(){
        return $this->hasOne('App\Models\Register\Address', 'address_id', 'address_current_id');
    }
}
