<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    function getProduct(){
       return $this->belongsTo('App\porducts', 'Product_id');
    }
    protected $fillable = ['quantity'];
}
