<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    use HasFactory;

    protected $table = 'data';
    protected $fillable = [
        'user_id',
        'se_no',
        'lat',
        'lon',
        'date',
        'time',
        'acd_type',
        'severity',
        'vehicle_1',
        'vehicle_2',
        'vehicle_3',
        'pedest',
        'object',
        'with_con',
        'pas_inj',
        'male_passengers',
        'female_passengers',
        'ped_inj',
        'male_pedestrian',
        'female_pedestrian',
        'children_injured',
        'children_count',
        'des',
        'drunkness',
        'dl',
        'nic',
        'images',
        'remarks'
    ];
}
