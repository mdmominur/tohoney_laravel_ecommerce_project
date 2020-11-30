<?php

namespace App\Http\Controllers;

use App\siteSettings;
use Illuminate\Http\Request;
use Image;

class siteSettingsController extends Controller
{
    function siteUpdate(){
        $siteAll = siteSettings::first();
        return view('backend.siteSettings.updateSite', compact('siteAll'));
    }
    function siteUpdatePost(Request $data){
        $data->validate([
            'site_name' => 'required',
            'address' => 'required',
            'phone1' => 'required',
            'phone2' => 'required',
            'email1' => 'required | email',
            'email2' => 'required | email',
            'footer_Description' => 'required',
            'facebook_link' => 'required',
            'twitter_link' => 'required',
            'linkedin_link' => 'required',
            'google_plus_link' => 'required',
            'copyright' => 'required',
        ]);

        if($data->hasFile('logo')){
           $site = siteSettings::findOrFail($data->id);
           if(file_exists(public_path('img'.'/'.$site->logo))){
               unlink(public_path('img'.'/'.$site->logo));
           }
           $img = $data->file('logo');
           $ext = $img->getClientOriginalExtension();
           $img_name = $data->site_name.'.'.$ext;
           Image::make($img)->resize(125, 35)->save('img'.'/'.$img_name);
        }
        siteSettings::findOrFail($data->id)->update([
            'site_name' =>$data->site_name,
            'address' =>$data->address,
            'phone1' =>$data->phone1,
            'phone2' =>$data->phone2,
            'email1' =>$data->email1,
            'email2' =>$data->email2,
            'footer_Description' =>$data->footer_Description,
            'facebook_link' =>$data->facebook_link,
            'twitter_link' =>$data->twitter_link,
            'linkedin_link' =>$data->linkedin_link,
            'google_plus_link' =>$data->google_plus_link,
            'copyright' =>$data->copyright,
            'logo' =>$img_name,
        ]);
        return back()->with('msg', 'Update successfull');
    }
}
