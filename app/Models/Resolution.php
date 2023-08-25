<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resolution extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'memorial_no',
        'tender_list_id',
    ];

    public function tenderList()
    {
        return $this->belongsTo(TenderList::class);
    }

}
