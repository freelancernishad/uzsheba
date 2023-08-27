<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenderWorkOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'memorial_no',
        'date',
        'formula',
        'order_description',
        'bank_name',
        'bank_account_no',
        'copy_details',
        'tender_list_id',
    ];

    public function tenderList()
    {
        return $this->belongsTo(TenderList::class, 'tender_list_id');
    }
}
