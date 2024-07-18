<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    use HasFactory;

    protected $table = 'data';
    protected $fillable = [
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
        'pad_inj',
        'des',
        'drunkness',
        'dl',
        'nic',
        'images',
        'remarks'
    ];
}
