<?php

namespace App\Http\Controllers;

use App\about;
use App\banner;
use App\bestSeller;
use App\billing;
use App\blog;
use App\Cart;
use App\category;
use App\comments;
use App\contact;
use App\countdownl;
use App\faq;
use App\newsLetter;
use App\porducts;
use App\review;
use App\sale;
use App\siteSettings;
use App\testimonial;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\productGallery;
use Illuminate\Pagination\Paginator;

class FrontendController extends Controller
{
    function frontpage(){
        $product = porducts::orderBy('id', 'desc')->get();
        $banner = banner::all();
        $catAll = category::all();
        $bestSell = bestSeller::orderBy('sale_time', 'desc')->limit(4)->get();
        $testimonial = testimonial::orderBy('created_at', 'desc')->get();
        $countDown = countdownl::first();
        return view('frontend.main' , compact('product', 'banner', 'bestSell', 'catAll','testimonial', 'countDown'));
    }
    function SingleProduct($slug){
        $pro = porducts::where('Slug', $slug)->first();
        $Releted_product = porducts::where('CatId', $pro->CatId)->limit(4)->inRandomOrder()->get();
        $pro_gallery = productGallery::where('product_id', $pro->id)->get();
        $faqs = faq::all();
        return view('frontend.SingleProduct', compact('pro', 'pro_gallery', 'Releted_product', 'faqs'));
    }
    function shop(){
        $product = porducts::all();
        $cat = category::all();
        return view('frontend.shop', compact('product', 'cat'));
    }
    function singleCart($slug){
        $ip_address = $_SERVER['REMOTE_ADDR'];
        $pro = porducts::where('Slug', $slug)->first();
         $pro_id = $pro->id;
         if(Cart::where('Product_id' , $pro_id)->where('Ip_address', $ip_address)->exists()){
             Cart::where('Product_id' , $pro_id)->where('Ip_address', $ip_address)->increment('quantity');
         }else{
             Cart::insert([
                 'Product_id' => $pro_id,
                 'Ip_address' => $ip_address,
                 'created_at' => Carbon::now(),
             ]);
         }
        return back();
    }
    function review(Request $data){
        $data->validate([
            'stars' => 'required',
            'name' => 'required',
            'email' => 'required | email',
            'review' => 'required',
        ]);
        $user_id = User::where('email', $data->email)->first()->id;
        if(billing::where('user_id', $user_id)->where('product_id', $data->product_id)->exists()){
            review::insert([
                'product_id' => $data->product_id,
                'stars' => $data->stars,
                'name' => $data->name,
                'email' => $data->email,
                'review' => $data->review,
                'created_at' =>date('Y-m-d H:i:s'),
            ]);
        }
        return back();
    }
    function blog(){
        $blogs = blog::orderBy('created_at', 'desc')->paginate(6);
        return view('frontend.blog', compact('blogs'));
    }
    function singleBlog($slug){
       $blog = blog::where('blog_slug',$slug)->first();
       $next_blog = blog::where('blog_slug','>',$slug)->first();
       $cat = category::all();
       $comments = comments::where('post_id' , $blog->id)->get();
       $recent_post = blog::orderBy('created_at', 'desc')->limit(4)->get();
       return view('frontend.singleBlog', compact('blog', 'cat', 'recent_post', 'next_blog', 'comments'));
    }
    function categoryBlog($id){
        $blogs = blog::where('category_id', $id)->orderBy('created_at', 'desc')->paginate(6);
        $category_name = category::findOrFail($id)->Category_name;

        return view('frontend.categoryBlog', compact('blogs','category_name'));
    }
    function blogComments(Request $data){
         $data->validate([
            'name' => 'required',
            'email' => 'required | email',
            'comment' => 'required',
        ]);
        comments::insert([
            'name' => $data->name,
            'email' => $data->email,
            'post_id' => $data->post_id,
            'comment' => $data->comment,
            'created_at' => Carbon::now(),
        ]);
        return back();
    }
    function contact(){
        $siteAll = siteSettings::first();
        return view('frontend.contact', compact('siteAll'));
    }
    function contactPost(Request $data){
        $data->validate([
            'name' => 'required',
            'email' => 'required | email',
            'subject' => 'required',
            'msg' => 'required',
        ]);
        contact::insert([
            'name' => $data->name,
            'email' => $data->email,
            'subject' => $data->subject,
            'msg' => $data->msg,
            'created_at' => Carbon::now(),
        ]);
        return back()->with('msg', 'Your Message is successfully sent');
    }
    function about(){
        $bestSell = bestSeller::orderBy('sale_time', 'desc')->limit(4)->get();
        $about = about::first();
        return view('frontend.about', compact('bestSell', 'about'));
    }
    function categoryProduct($name){
        $cat = category::where('Category_name', $name)->first();
        $product = porducts::where('CatId', $cat->id)->get();
        $catName = $name;
        return view('frontend.categoryProduct',compact('cat','product','catName'));
    }
    function faq(){
        $faqs = faq::all();
        return view('frontend.faq', compact('faqs'));
    }
    function addFaq(){
        return view('backend.faq.addFaq');
    }
    function faqPost(Request $data){
         $data->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        faq::insert([
            'title' => $data->title,
            'description' => $data->description,
            'created_at' => Carbon::now(),
        ]);
        return back()->with('msg', 'Successfully added your Faq');
    }
    function viewFaq(){
        $faqs = faq::orderBy('created_at', 'desc')->paginate(8);
        return view('backend.faq.viewFaq', compact('faqs'));
    }
    function faqEdit($id){
        $faq = faq::FindOrFail($id);
        return view('backend.faq.faqEdit', compact('faq'));
    }
    function faqEditPost(Request $data){
        faq::FindOrFail($data->id)->update([
            'title' => $data->title,
            'description' => $data->description,
        ]);
        return redirect('viewFaq')->with('msg', 'successfully Updated your Faq');
    }
    function faqDelete($id){
        faq::findOrFail($id)->delete();
        return back()->with('delete', 'Faq is successfully deleted');
    }
    function search(Request $data){
        $product = porducts::where('ProductName', 'like', "%{$data->search}%")->get();
        $search = $data->search;
        return view('frontend.search', compact('product', 'search'));
    }
    function deleteReview($id){
        review::findOrFail($id)->delete();
        return back();
    }
    function newsLetter(Request $data){
             $data->validate([
                 'email' => 'required | email',
             ]);
             if(!newsLetter::where('email', $data->email)->exists()){
                 newsLetter::insert([
                     'email' => $data->email,
                     'created_at' => Carbon::now()
                 ]);
             }

             return back()->with('msg', 'Subscription successfull');
    }



}
