<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class subCategory extends Model
{
    use SoftDeletes;

    function getCategories(){
       return $this->belongsTo('App\category', 'catId');
    }

    protected $fillable = ['subCategory', 'catId'];
}
