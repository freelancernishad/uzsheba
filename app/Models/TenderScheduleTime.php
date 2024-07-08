<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenderScheduleTime extends Model
{
    use HasFactory;

    protected $fillable = [
        'tender_calender_id',
        'stage_of_tender',
        'form_buy_start',
        'form_buy_end',
        'tender_start',
        'tender_end',
        'tender_open'
    ];

    public function tenderCalender()
    {
        return $this->belongsTo(TenderCalender::class, 'tender_calender_id');
    }
}
