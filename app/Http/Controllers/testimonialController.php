<?php

namespace App\Http\Controllers;

use App\testimonial;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;

class testimonialController extends Controller
{
    function testimonialAdd(){
        return view('backend.testimonial.testimonialAdd');
    }
    function testimonialPost(Request $data){
        $data->validate([
            'name' => ['required'],
            'role' => ['required'],
            'quote' => ['required'],
            'image' => ['required'],
        ]);
        $img = $data->file('image');
        $ext = $img->getClientOriginalExtension();
        $title = str_replace(' ', '_', $data->name);
        $imgName = $title.'.'.$ext;
        $check = testimonial::where('image', $imgName)->count();
        if($check>0){
            $imgName = $title.time().'.'.$ext;
        }
        Image::make($img)->resize(138, 107)->save(public_path('img/testimonial'.'/'.$imgName));

        testimonial::insert([
            'name' => $data->name,
            'role' => $data->role,
            'quote' => $data->quote,
            'image' => $imgName,
            'created_at' => Carbon::now(),
        ]);
        return back()->with('msg', 'Successfully add Testimonial');
    }
    function testimonialView(){
          $testimonial = testimonial::orderBy('created_at', 'desc')->paginate(8);
          return view('backend.testimonial.testimonialView', compact('testimonial'));
      }
    function testimonialUpdate($id){
          $testimonial = testimonial::findOrFail($id);
          return view('backend.testimonial.testimonialUpdate', compact('testimonial'));
      }
    function testimonialUpdatePost(Request $data){
        $data->validate([
            'name' => ['required'],
            'role' => ['required'],
            'quote' => ['required'],
        ]);
        $testimonial = testimonial::findOrFail($data->id);
        $imgName = $testimonial->image;
        if($data->hasFile('image')){
            if(file_exists(public_path('img/testimonial'.'/'.$testimonial->image))){
                unlink(public_path('img/testimonial'.'/'.$testimonial->image));
            }
            $img = $data->file('image');
            $ext = $img->getClientOriginalExtension();
            $title = str_replace(' ', '_', $data->name);
            $imgName = $title.'.'.$ext;
            $check = testimonial::where('image', $imgName)->count();
            if($check>0){
                $imgName = $title.time().'.'.$ext;
            }
            Image::make($img)->resize(138, 107)->save(public_path('img/testimonial'.'/'.$imgName));
        }
        $testimonial->update([
            'name' => $data->name,
            'role' => $data->role,
            'quote' => $data->quote,
            'image' => $imgName,
        ]);
        return back()->with('msg', 'Successfully Updated Testimonial');
    }
    function testimonialDelete($id){
        $testimonial = testimonial::findOrFail($id);
        if(file_exists(public_path('img/testimonial/'.$testimonial->image))){
            unlink(public_path('img/testimonial/'.$testimonial->image));
        }
        $testimonial->delete();
        return back()->with('msg', 'Testimonial is successfully deleted');

    }

}
