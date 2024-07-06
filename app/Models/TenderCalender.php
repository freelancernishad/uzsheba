<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenderCalender extends Model
{
    use HasFactory;

    protected $fillable = [
        'sorok_no',
        'bn_year',
        'en_year',
        'calender_id',
        'union',
        'dc_name',
        'dc_signature',
        'status'
    ];

    public function items()
    {
        return $this->hasMany(TenderCalenderItem::class, 'tender_calender_id');
    }
}
