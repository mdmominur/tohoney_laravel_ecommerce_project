<?php

namespace App\Http\Controllers;

use App\bestSeller;
use App\billing;
use App\Cart;
use App\Mail\OrderShipped;
use App\porducts;
use App\sale;
use App\shipping;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use function GuzzleHttp\Psr7\_parse_request_uri;
use Illuminate\Support\Facades\Mail;

class paymentController extends Controller
{
    function payment(Request $data){
        $shipping_id = shipping::insertGetId([
            'user_id' => Auth::user()->id,
            'firstName' => $data->firstName,
            'lastName' => $data->lastName,
            'companyName' => $data->companyName,
            'email' => $data->email,
            'phone' => $data->phone,
            'address' => $data->address,
            'country_id' => $data->country_id,
            'state_id' => $data->state_id,
            'city_id' => $data->city_id,
            'postcode' => $data->postcode,
            'massage' => $data->massage,
            'payment_method' => $data->payment_method,
            'created_at' => Carbon::now()
        ]);

        $sale_id =  sale::insertGetId([
            'user_id'=> Auth::user()->id,
            'shipping_id'=> $shipping_id,
            'discount'=> session('discount'),
            'grand_total'=> session('grand_total'),
            'created_at' => Carbon::now(),
        ]);

        $ip_address = $_SERVER['REMOTE_ADDR'];
        $pro = Cart::where('Ip_address', $ip_address)->get();
        foreach ($pro as $item){
            if(bestSeller::where('product_id', $item->Product_id)->exists()){
                bestSeller::where('product_id', $item->Product_id)->increment('sale_time', $item->quantity);
            }
            else{
                bestSeller::insert([
                    'product_id' =>  $item->Product_id,
                    'sale_time' => $item->quantity,
                    'created_at' => Carbon::now(),
                ]);

            }
        }

        foreach ($pro as $item){
            billing::insert([
                'user_id' => Auth::user()->id,
                'sale_id'  => $sale_id,
                'product_id' => $item->Product_id,
                'product_price' => $item->getProduct->ProductPrice,
                'product_quantity' => $item->quantity,
                'created_at' => Carbon::now()
            ]);
            porducts::findOrFail($item->Product_id)->decrement('ProductQuantity', $item->quantity);
            $item->delete();
        }



       \Stripe\Stripe::setApiKey('sk_test_DWK5DuLL7Jp0YD3RTn4UAgmV00Oj6mwXh5');

        \Stripe\Charge::create([
            'amount' => (session('grand_total') * 100),
            'currency' => 'usd',
            'source' => $data->stripeToken,
        ]);

        $orderData = billing::where('sale_id', $sale_id)->get();
        Mail::to(Auth::user()->email)->send(new OrderShipped($orderData));
        return redirect('/');

    }


}
