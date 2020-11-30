<?php

namespace App\Http\Controllers;

use App\blog;
use App\category;
use App\comments;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;

class blogController extends Controller
{
    function blogadd(){
        $cat = category::all();
        return view('backend.blog.blogadd',compact('cat'));
    }
    function blogPost(Request $data){
        $data->validate([
            'title'=> 'required',
            'category_id'=> 'required',
            'description'=> 'required',
            'blog_image'=> 'required',
        ]);
         $slug = str_replace(' ', '_', $data->title);
         $slug = strtolower($slug);
         if(blog::where('blog_slug',$slug)->exists()){
             $slug = $slug.time();
         }
        if($data->hasFile('blog_image')){
           $img = $data->file('blog_image');
           $ext = $img->getClientOriginalExtension();
           $img_name = $slug.'.'.$ext;
           Image::make($img)->resize(500, 364)->save(public_path('img/blog'.'/'.$img_name));
        }
        blog::insert([
                'title' => $data->title,
                'user_name' => $data->user_name,
                'category_id' => $data->category_id,
                'description' => $data->description,
                'blog_image' => $img_name,
                'blog_slug' => $slug,
                'created_at' => Carbon::now(),
        ]);
        return back()->with('msg', 'Your blog has been published');

    }
    function blogVeiw(){
        $blogs = blog::orderBy('created_at', 'desc')->paginate(10);
        return view('backend.blog.blogVeiw', compact('blogs'));
    }
    function blogUpdate($id){
        $blog = blog::findOrFail($id);
        $cat = category::all();
        return view('backend.blog.blogUpdate', compact('blog', 'cat'));
    }
    function blogUpdatePost(Request $data){
        if($data->hasFile('blog_image')){
            $blog = blog::findOrFail($data->id);
            if(file_exists(public_path('img/blog'.'/'.$blog->blog_image))){
                unlink(public_path('img/blog'.'/'.$blog->blog_image));
                $img = $data->file('blog_image');
                $ext = $img->getClientOriginalExtension();
                $img_name = $blog->blog_slug.'.'.$ext;
                Image::make($img)->resize(500,364)->save(public_path('img/blog'.'/'.$img_name));
            }
        }
        blog::findOrFail($data->id)->update([
            'title' => $data->title,
            'category_id' => $data->category_id,
            'description' => $data->description,
        ]);

        return back()->with('msg', 'Blog is successfully updated');
    }
    function blogComments(){
       $comments = comments::orderBy('created_at', 'desc')->paginate(8);
       return view('backend.blog.blogComments', compact('comments'));
    }
    function commentToBlog($id){
        $comments = comments::findOrFail($id);
        if($comments->status == 1){
            $comments->increment('status');
        }
        $post_slug = $comments->get_post->blog_slug;
        return redirect('singleBlog/'.$post_slug.'#'.$id);
    }
    function deleteComments($id){
        comments::findOrFail($id)->delete();
        return back();
    }
    function blogDelete($id){
        $blog = blog::findOrFail($id);
        if(file_exists(public_path('img/blog'.'/'.$blog->blog_image))){
            unlink(public_path('img/blog'.'/'.$blog->blog_image));
        }
        $blog->delete();
        return back()->with('msg', 'Blog has been deleted');

    }


}
