<?php

namespace App\Http\Controllers;

use App\porducts;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\wish;
use Illuminate\Support\Facades\Auth;

class wishController extends Controller
{
    function singleWish($slug){
            $ipAddress = $_SERVER['REMOTE_ADDR'];
            $pro = porducts::where('Slug', $slug)->first();
           if(wish::where('product_id', $pro->id)->where('user_id', Auth::user()->id)->exists()){
               wish::where('product_id', $pro->id)->where('user_id', Auth::user()->id)->increment('quantity');
           }
           else{
               wish::insert([
                   'user_id' =>Auth::user()->id,
                   'product_id'=> $pro->id,
                   'quantity'=> 1,
                   'ipAddress'=> $ipAddress,
                   'created_at' => Carbon::now(),
               ]);
           }
           return back();
    }
    function wishDelete($id){
        wish::findOrFail($id)->delete();
        return back();
    }
    function wishList(){
        $wish =wish::where('user_id', Auth::user()->id)->get();
        return view('frontend.wishList', compact('wish'));
    }
}
