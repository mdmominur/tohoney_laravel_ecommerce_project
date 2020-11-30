<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class wish extends Model
{
    function get_products(){
        return $this->belongsTo('App\porducts', 'product_id');
    }
}
