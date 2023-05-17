<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sonod extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'id_no',
        'registrationDate',
        'name',
        'pregnant_woman_nid',
        'husband_name',
        'husband_name_nid',
        'division',
        'district',
        'upazila',
        'union',
        'post_office',
        'word_number',
        'holding_no',
        'village',

        'divisionPer',
        'applicant_permanent_district',
        'applicant_permanent_Upazila',
        'applicant_permanent_union',
        'applicant_permanent_post_office',
        'applicant_permanent_word_number',
        'applicant_permanent_village',




        'date_of_last_menstrual_period',
        'probable_date_of_delivery',
        'how_many_wombs',
        'how_many_children',


        'date_of_birth',
        'childBirthNo',
        'mobile_no',
        'childbirth_type',
        'gender',
        'childs_name',
        'place_of_childbirth',
        'first_dose',
        'second_dose',
        'third_dose',
        'forth_dose',
        'status',
    ];
}
