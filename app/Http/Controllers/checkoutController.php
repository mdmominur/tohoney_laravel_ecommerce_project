<?php

namespace App\Http\Controllers;

use App\City;
use App\Country;
use App\State;
use App\user_details;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class checkoutController extends Controller
{
    function checkoutView(){
        $auth_user = Auth::user();
        $country = Country::orderBy('name', 'asc')->get();
        $user_details = user_details::where('email', Auth::user()->email)->first();
        return view('frontend.checkout', compact('auth_user', 'country','user_details'));
    }
    function stateList($country_id){
        $states = State::where('country_id', $country_id)->get();
        return response()->json($states);
    }
    function cityList($state_id){
        $cityList = City::where('state_id', $state_id)->get();
        return response()->json($cityList);
    }
}
