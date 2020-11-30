<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comments extends Model
{
    function get_post(){
        return $this->belongsTo('App\blog', 'post_id');
    }
    function get_user(){
        return $this->belongsTo('App\User', 'email');
    }
    protected $fillable = ['status'];
}
