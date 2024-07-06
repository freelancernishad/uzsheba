<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenderCalenderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'tender_calender_id',
        'index_no',
        'union_name',
        'hat_name',
        'ijara_price',
        'previous_ijara_price',
        'six_percent_bitti'
    ];

    public function tenderCalender()
    {
        return $this->belongsTo(TenderCalender::class, 'tender_calender_id');
    }
}
