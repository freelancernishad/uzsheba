<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenderList extends Model
{
    use HasFactory;


    protected $fillable=[
       'union_name',
       'tender_id',
       'tender_type',
       'memorial_no',
       'tender_name',
       'description',
       'tender_word_no',
       'division',
       'district',
       'thana',
       'union',
       'govt_price',
       'form_price',
       'deposit_percent',
       'noticeDate',
       'form_buy_last_date',
       'form_buy_address',
       'tender_start',
       'tender_end',
       'tender_submit_role_address',
       'tender_open',
       'tender_open_address',
       'tender_product_title',
       'tender_product_Number_Quantity',
       'tender_roles',
       'status',
       'committe1name',
       'committe1position',
       'commette1phone',
       'commette1pass',
       'committe2name',
       'committe2position',
       'commette2phone',
       'commette2pass',
       'committe3name',
       'committe3position',
       'commette3phone',
       'commette3pass',
       'bankName',
       'bankCheck',
       'daysOfDepositeAmount',
       'permitDetials',
    ];

}
