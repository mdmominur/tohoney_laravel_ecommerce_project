<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class countdownl extends Model
{
    protected $fillable = [
        'Title',
        'description',
        'day',
        'month',
        'year',
    ];
}
