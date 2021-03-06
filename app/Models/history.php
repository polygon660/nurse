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

    public function guest()
    {
        return $this->belongsTo(guest::class, 'guest_id');
    }
    public function GetFullNameAttribute()
    {

        return $this->prefix->name . '' . $this->name . ' ' . $this->surname;
    }

    public function DateThai($strDate)
    {
        $strYear = date("Y", strtotime($strDate)) + 543;
        $strMonth = date("n", strtotime($strDate));
        $strDay = date("d", strtotime($strDate));
        $strtime = date("h:i:s", strtotime($strDate));
        $strMonthCut = ["", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค."];
        $strMonthThai = $strMonthCut[$strMonth];
        return $strDay . " " . $strMonthThai . " " . $strYear . " เวลา " . $strtime;
    }

    protected $casts = [
        'medical' => 'array',
    ];
}
