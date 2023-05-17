<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TikaLog extends Model
{
    use HasFactory;


    protected $fillable = [
        'applicantId',
        'tikaname',
        'tikadose',
        'kendro_name',
        'kormir_name',
        'tikaDate',
        'nextTikaDate',
        'sms',
    ];

}
