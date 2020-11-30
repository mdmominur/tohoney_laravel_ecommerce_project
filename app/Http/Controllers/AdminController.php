<?php

namespace App\Http\Controllers;

use App\User;
use App\user_details;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;

class AdminController extends Controller
{
    function index(){
        return redirect('home');
    }
    function adminAccount(){
        return view('backend.adminAccount');
    }
    function adminAccountPost(Request $data){
        $auth_user = Auth::user();
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
        return back()->with('msg', 'successfully updated your profile');
    }
}
