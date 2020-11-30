<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\category;
use Carbon\Carbon;
use Image;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;

class CategoryController extends Controller
{

    function category()
    {
        return view('backend.category');
    }
    function categoryPost(Request $data){
        $data->validate([
            'Category_name' => ['required', 'unique:categories'],
            'img' => ['required']
        ]);
        if($data->hasFile('img')){
            $image = $data->file('img');
            $ext = $image->getClientOriginalExtension();
            $image_name = $data->Category_name.'.'.$ext;
            Image::make($image)->resize(350, 274)->save('img/category'.'/'.$image_name);
        }
        category::insert([
            'category_name'=>$data->Category_name,
            'img' => $image_name,
            'created_at' => Carbon::now(),
        ]);
        return back()->with('msg', 'successfully add categroy');

    }
    function categoryUpdate($id){
        $cat = category::findOrFail($id);
        return view('backend.categoryUpdate', compact('cat'));
    }
    function categoryUpdatePost(Request $data){
        $cat = category::findOrFail($data->id);
        $img_name = $cat->img;
        if($data->hasFile('img')){
            if(file_exists(public_path('img/category'.'/'.$cat->img)) && $cat->img != null){
                unlink(public_path('img/category'.'/'.$cat->img));
            }
            $img = $data->file('img');
            $ext = $img->getClientOriginalExtension();
            $img_name = $data->Category_name.'.'.$ext;
            Image::make($img)->resize(350, 274)->save('img/category'.'/'.$img_name);
        }
        $cat->update([
            'Category_name' => $data->Category_name,
            'img' => $img_name,
        ]);
        return back()->with('msg', 'Your Catagory is updated');

    }
    function categoryView(){
      $cat = category::orderBy('category_name', 'asc')->paginate(8);
      return view('/backend/categoryView', compact('cat'));
    }
    function categoryDelete($id){
     $cat = category::findOrFail($id);
     if(file_exists(public_path('img/category'.'/'.$cat->img))){
         unlink(public_path('img/category'.'/'.$cat->img));
     }
     $cat->delete();
      return back()->with('msg', 'Your Catagory is deleted');
    }


}
