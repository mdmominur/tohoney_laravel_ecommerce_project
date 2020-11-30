<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user_details extends Model
{
    protected $fillable = [
        'companyName',
        'phone',
        'country_id',
        'address',
        'state_id',
        'postcode',
        'city_id',
    ];
}
