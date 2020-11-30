<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class blog extends Model
{
    function get_categories(){
        return $this->belongsTo('App\category' , 'category_id');
    }

    protected $fillable = [
        'title',
        'category_id',
        'description',
    ];
}
