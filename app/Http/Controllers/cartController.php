<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;

class cartController extends Controller
{
    function cart($coupon = ''){
        if($coupon == ''){
            $discount = 0;
            $ip_address = $_SERVER['REMOTE_ADDR'];
            $pro = Cart::where('Ip_address', $ip_address)->get();
            $subTotal = 0;
            foreach($pro as $item){
                $subTotal = $subTotal+($item->getProduct->ProductPrice * $item->quantity);
            }
            $grand_total = $subTotal;
            session(['grand_total' => $grand_total , 'subTotal' => $subTotal, 'discount' => $discount ]);
            return view('frontend.cart', compact('pro', 'coupon', 'discount' ,'subTotal', 'grand_total'));
        }
        else{
            if(Coupon::where('coupon_name', $coupon)->exists()){
                $coupon_data = Coupon::where('coupon_name', $coupon)->first();
                $validity = $coupon_data->validity;
                if(Carbon::now()->format('Y-m-d') <= $validity){
                    $discount = $coupon_data->discount;
                    $ip_address = $_SERVER['REMOTE_ADDR'];
                    $pro = Cart::where('Ip_address', $ip_address)->get();
                    $subTotal = 0;
                    foreach($pro as $item){
                        $subTotal = $subTotal+($item->getProduct->ProductPrice * $item->quantity);
                    }
                    $grand_total = $subTotal-(($subTotal*$discount)/100);
                     session(['grand_total' => $grand_total , 'subTotal' => $subTotal, 'discount' => $discount ]);
                    return view('frontend.cart', compact('pro', 'coupon', 'discount' ,'subTotal', 'grand_total'));
                }
                else{
                    return "Expired Coupon";
                }
            }
            else{
                return "Invalid coupon";
            }
        }

    }

    function singleCartDelete($id){
        Cart::findOrFail($id)->delete();
        return back()->with('msg', 'Cart removed successfully');
    }

    function cartUpdate(Request $data){
        foreach ($data->cart_id as $key => $item){
            Cart::findOrFail($item)->update([
                'quantity' => $data->quantity[$key],
                'updated_at' => Carbon::now(),
            ]);
        }
        return back();
    }

    function singleCartAdd(Request $data){
        $ipAddress = $_SERVER['REMOTE_ADDR'];
        if (Cart::where('Product_id', $data->Product_id)->where('Ip_address', $ipAddress)->exists()){
            Cart::where('Product_id', $data->Product_id)->where('Ip_address', $ipAddress)->increment('quantity', $data->quantity);
        }
        else{
            Cart::insert([
                'Product_id' => $data->Product_id,
                'quantity'=> $data->quantity,
                'Ip_address' => $ipAddress,
            ]);
        }
        return back();
    }
}
