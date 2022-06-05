<?php

namespace App\Models\Finance;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receivables extends Model
{
    use HasFactory;

    protected $connection = '024920';
    protected $table = '024920.fn_receivables';
    protected $primaryKey = 'receivables_id';
}
