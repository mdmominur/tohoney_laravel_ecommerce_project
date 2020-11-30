<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class review extends Model
{
    function get_user(){
        return $this->belongsTo('App\User', 'email');
    }
    protected $fillable = ['product_id'];
}
