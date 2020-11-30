<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class porducts extends Model
{
    use softDeletes;
    function getCategories(){
       return $this->belongsTo('App\category' , 'CatId');

    }
    function getSubCat(){
        return $this->belongsTo('App\subCategory' , 'SubCatId');
    }
    protected $fillable = [
    'CatId',
    'SubCatId',
    'ProductName',
    'ProductSummary',
    'ProductDescription',
    'ProductPrice',
    'ProductQuantity',
    'ProductThambnail',

    ];
}
