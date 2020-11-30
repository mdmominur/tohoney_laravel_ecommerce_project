<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bestSeller extends Model
{
    protected $fillable = ['sale_time'];
    function getProducts(){
        return $this->belongsTo('App\porducts', 'product_id');
    }
}
