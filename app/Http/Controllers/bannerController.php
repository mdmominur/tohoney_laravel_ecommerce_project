<?php

namespace App\Http\Controllers;

use App\banner;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;

class bannerController extends Controller
{
    function bannerAdd(){
        return view('backend.banner.bannerAdd');
    }
    function bannerPost(Request $data){
        $data->validate([
            'title' => ['required'],
            'description' => ['required'],
            'bannerImg' => ['required'],
        ]);
         $img = $data->file('bannerImg');
         $ext = $img->getClientOriginalExtension();
         $title = str_replace(' ', '_', $data->title);
         $imgName = $title.'.'.$ext;
         $check = banner::where('bannerImg', $imgName)->count();
         if($check>0){
             $imgName = $title.time().'.'.$ext;
         }
         Image::make($img)->resize(1920, 1000)->save(public_path('img/banner/'.$imgName));

         banner::insert([
             'title' => $data->title,
             'description' => $data->description,
             'bannerImg' => $imgName,
             'created_at' => Carbon::now(),
         ]);
         return back()->with('msg', 'Successfully add your banner');

    }
    function bannerView(){
        $banner = banner::orderBy('title', 'asc')->paginate(4);
        return view('backend.banner.bannerView', compact('banner'));
    }
    function bannerDelete($id){
        $banner = banner::findOrFail($id);
        if(file_exists(public_path('img/banner/'.$banner->bannerImg))){
            unlink(public_path('img/banner/'.$banner->bannerImg));
        }
        $banner->delete();
        return back()->with('msg', 'Banner is successfully deleted');

    }

}
