<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenderTeam extends Model
{
    use HasFactory;

    protected $fillable = [
        'tender_calender_id',
        'name',
        'position',
        'phone',
        'pass'
    ];

    public function tenderCalender()
    {
        return $this->belongsTo(TenderCalender::class, 'tender_calender_id');
    }
}
