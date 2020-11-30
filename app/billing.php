<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class billing extends Model
{
   function get_product(){
       return $this->belongsTo('App\porducts', 'product_id');

   }
}
