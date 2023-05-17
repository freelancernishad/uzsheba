<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class application_repprt extends Model
{
    use HasFactory;

    protected $fillable = [

'license_id',
'appicant_name',
'applicant_father_name',
'village',
'union',
'mouja_name',
'JL_No',
'khotiyan_no',
'dag_NO',
'save_water_Condition',
'helpfull_area',
'home_and_other_benefite',
'right_area',
'distanceTo',
'hand_map',
'reporter_name',
'reporter_signature',
'reporter_id',
'land_length',
'ayoton',
'paperTrueOrNot',
'mapBNNCCode',
'Supervision_Engineer',
'posibleFalse',
'note',
    ];


}
