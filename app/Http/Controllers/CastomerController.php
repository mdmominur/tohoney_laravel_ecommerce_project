<?php

namespace App\Http\Controllers;

use App\City;
use App\Country;
use App\State;
use App\User;
use App\user_details;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;

class CastomerController extends Controller
{
    function index(){
        $auth_user = Auth::user();
        $details = user_details::where('email' , $auth_user->email)->first();
        $country = Country::orderBy('name', 'asc')->get();
        return view('frontend.castomerDashbord', compact('auth_user', 'country', 'details'));
    }

    function userUpdate(Request $data){
        $user_email = Auth::user()->email;
         $user = user_details::where('email', $user_email)->first();
         $auth_user = User::where('email', $user_email)->first();
        $img_name = $auth_user->avatar;
         if($data->hasFile('avatar')){
             $img = $data->file('avatar');
             $ext = $img->getClientOriginalExtension();
             $lower = strtolower($auth_user->name);
             $img_name = str_replace(' ', '_', $lower);
             $img_name = $img_name.time().$auth_user->id.'.'.$ext;
            if($auth_user->avatar != 'default.jpg'){
                if(file_exists(public_path('img/user'.'/'.$auth_user->avatar))){
                    unlink(public_path('img/user'.'/'.$auth_user->avatar));
                }
            }
            Image::make($img)->resize(200,200)->save(public_path('img/user'.'/'.$img_name));
         }
        User::where('email', $auth_user->email)->update([
            'name' => $data->name,
            'avatar' => $img_name,
        ]);

         if(user_details::where('email', $user_email)->exists()){
             $user->update([
                 'companyName' =>$data->companyName,
                 'phone' =>$data->phone,
                 'country_id' =>$data->country_id,
                 'address' =>$data->address,
                 'state_id' =>$data->state_id,
                 'postcode' =>$data->postcode,
                 'city_id' =>$data->city_id,
                 'created_at' => Carbon::now()
             ]);
         }
         else{
                user_details::insert([
                    'companyName' =>$data->companyName,
                    'email' =>Auth::user()->email,
                    'phone' =>$data->phone,
                    'country_id' =>$data->country_id,
                    'address' =>$data->address,
                    'state_id' =>$data->state_id,
                    'postcode' =>$data->postcode,
                    'city_id' =>$data->city_id,
                    'created_at' => Carbon::now()
                ]);

         }

         return back()->with('msg', 'successfully updated your profile');
    }



}
