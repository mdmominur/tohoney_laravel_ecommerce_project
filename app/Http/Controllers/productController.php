<?php

namespace App\Http\Controllers;

use App\category;
use App\subCategory;
use Illuminate\Http\Request;
use App\porducts;
use App\productGallery;
use Carbon\Carbon;
use Image;


class productController extends Controller
{

        function product()
    {
        $cat = category::orderBy('Category_name', 'asc')->get();
        $SubCat = subCategory::orderBy('subCategory', 'asc')->get();
        return view('backend.products', ['cat' => $cat, 'SubCat' => $SubCat]);
    }


        function productPost(Request $data)
    {
        $slug = strtolower($data->ProductName);
        $slug = str_replace(' ', '-', $slug);
        $slugCheck = porducts::where('slug', $slug)->count();
        if ($slugCheck > 0) {
            $slug = $slug . time();
        }
        $imgName = null;
        if($data->hasFile('ProductThambnail')){
            $image = $data->file('ProductThambnail');
            $ext = $image->getClientOriginalExtension();
            $imgName = $slug.'.'.$ext;
            Image::make($image)->resize(600, 622)->save(public_path('img/products/thumbnail'.'/'.$imgName));
        }
          $pro_id = porducts::insertGetId([
                'CatId' => $data->CatId,
                'SubCatId' => $data->SubCatId,
                'ProductName' => $data->ProductName,
                'Slug' => $slug,
                'ProductSummary' => $data->ProductSummary,
                'ProductDescription' => $data->ProductDescription,
                'ProductPrice' => $data->ProductPrice,
                'ProductQuantity' => $data->ProductQuantity,
                'ProductThambnail' => $imgName,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            if ($data->hasFile('img_name')) {
                $imgs = $data->file('img_name');
                foreach ($imgs as $key => $img) {
                    $ext = $img->getClientOriginalExtension();
                    $imgName = $slug . $key . '.' . $ext;
                    Image::make($img)->resize(600, 622)->save(public_path('img/products/gallery/' . $imgName));
                    productGallery::insert([
                        'product_id' => $pro_id,
                        'img_name' => $imgName,
                    ]);
                }
            }

        return back()->with('product', 'Your product is successfully added');
    }

        function productView()
        {
            $product = porducts::orderBy('ProductName', 'asc')->paginate(3);
            return view('backend/productView', compact('product'));
        }

        function productDelete($id)
        {
            porducts::findorfail($id)->delete();
            return back()->with('delete', 'Product has been deleted');
        }

        function productEdit($id)
        {
            session(['pro_id' => $id]);
            $cat = category::orderBy('Category_name', 'asc')->get();
            $SubCat = subCategory::orderBy('subCategory', 'asc')->get();
            $pro = porducts::findOrFail($id);
            $proGallery = productGallery::where('product_id',$pro->id)->get();
            return view('backend.productEdit', compact('pro', 'cat', 'SubCat', 'proGallery'));
        }

        function productEditPost(Request $data)
        {
            $id = session('pro_id');
            if ($data->hasFile('ProductThambnail')) {
                $old_product = porducts::findOrFail($id);
                $old_img = $old_product->ProductThambnail;
                $slug = $old_product->Slug;
                if ($old_img == null) {
                    $img = $data->file('ProductThambnail');
                    $ext = $data->file('ProductThambnail')->getClientOriginalExtension();
                    $imgName = $slug . '.' . $ext;
                    Image::make($img)->resize(600, 622)->save(public_path('/img/products/thumbnail/' . $imgName));
                    porducts::findOrFail($id)->update([
                        'CatId' => $data->CatId,
                        'SubCatId' => $data->SubCatId,
                        'ProductName' => $data->ProductName,
                        'ProductSummary' => $data->ProductSummary,
                        'ProductDescription' => $data->ProductDescription,
                        'ProductPrice' => $data->ProductPrice,
                        'ProductQuantity' => $data->ProductQuantity,
                        'ProductThambnail' => $imgName,
                        'updated_at' => Carbon::now(),
                    ]);
                    if($data->hasFile('img_name')){
                        $id = session('pro_id');
                        $images = $data->file('img_name');
                        foreach($images as $key => $img){
                            $ext = $img->getClientOriginalExtension();
                            $img_name = $data->ProductName.time().$key.'.'.$ext;
                            Image::make($img)->resize(600, 622)->save(public_path('img/products/gallery/' . $img_name));
                            productGallery::insert([
                                'product_id' => $id,
                                'img_name' => $img_name,
                            ]);
                        }
                    }
                } else {
                    if (file_exists(public_path('img/products/thumbnail/' . $old_img))) {
                        unlink(public_path('img/products/thumbnail/' . $old_img));
                        $img = $data->file('ProductThambnail');
                        $ext = $data->file('ProductThambnail')->getClientOriginalExtension();
                        $imgName = $slug . '.' . $ext;
                        Image::make($img)->resize(600, 622)->save(public_path('/img/products/thumbnail/' . $imgName));
                        porducts::findOrFail($id)->update([
                            'CatId' => $data->CatId,
                            'SubCatId' => $data->SubCatId,
                            'ProductName' => $data->ProductName,
                            'ProductSummary' => $data->ProductSummary,
                            'ProductDescription' => $data->ProductDescription,
                            'ProductPrice' => $data->ProductPrice,
                            'ProductQuantity' => $data->ProductQuantity,
                            'ProductThambnail' => $imgName,
                            'updated_at' => Carbon::now(),
                        ]);
                        if($data->hasFile('img_name')){
                            $id = session('pro_id');
                            $images = $data->file('img_name');
                            foreach($images as $key => $img){
                                $ext = $img->getClientOriginalExtension();
                                $img_name = $data->ProductName.time().$key.'.'.$ext;
                                Image::make($img)->resize(600, 622)->save(public_path('img/products/gallery/' . $img_name));
                                productGallery::insert([
                                    'product_id' => $id,
                                    'img_name' => $img_name,
                                ]);
                            }
                        }
                    } else {
                        $img = $data->file('ProductThambnail');
                        $ext = $data->file('ProductThambnail')->getClientOriginalExtension();
                        $imgName = $slug . '.' . $ext;
                        Image::make($img)->resize(600, 622)->save(public_path('/img/products/thumbnail/' . $imgName));
                        porducts::findOrFail($id)->update([
                            'CatId' => $data->CatId,
                            'SubCatId' => $data->SubCatId,
                            'ProductName' => $data->ProductName,
                            'ProductSummary' => $data->ProductSummary,
                            'ProductDescription' => $data->ProductDescription,
                            'ProductPrice' => $data->ProductPrice,
                            'ProductQuantity' => $data->ProductQuantity,
                            'ProductThambnail' => $imgName,
                            'updated_at' => Carbon::now(),
                        ]);
                        if($data->hasFile('img_name')){
                            $id = session('pro_id');
                            $images = $data->file('img_name');
                            foreach($images as $key => $img){
                                $ext = $img->getClientOriginalExtension();
                                $img_name = $data->ProductName.time().$key.'.'.$ext;
                                Image::make($img)->resize(600, 622)->save(public_path('img/products/gallery/' . $img_name));
                                productGallery::insert([
                                    'product_id' => $id,
                                    'img_name' => $img_name,
                                ]);
                            }
                        }
                    }
                }

            } else {
                porducts::findOrFail($id)->update([
                    'CatId' => $data->CatId,
                    'SubCatId' => $data->SubCatId,
                    'ProductName' => $data->ProductName,
                    'ProductSummary' => $data->ProductSummary,
                    'ProductDescription' => $data->ProductDescription,
                    'ProductPrice' => $data->ProductPrice,
                    'ProductQuantity' => $data->ProductQuantity,
                    'updated_at' => Carbon::now(),
                ]);
                if($data->hasFile('img_name')){
                    $id = session('pro_id');
                    $images = $data->file('img_name');
                    foreach($images as $key => $img){
                        $ext = $img->getClientOriginalExtension();
                        $img_name = $data->ProductName.time().$key.'.'.$ext;
                        Image::make($img)->resize(600, 622)->save(public_path('img/products/gallery/' . $img_name));
                        productGallery::insert([
                            'product_id' => $id,
                            'img_name' => $img_name,
                        ]);
                    }
                }
            }
            return redirect('productView')->with('delete', 'Successfully updated your data');
        }

        function ProductTrashed()
        {
            $trashPro = porducts::onlyTrashed()->orderBy('ProductName', 'asc')->paginate(4);
            return view('backend.trashedProduct', compact('trashPro'));
        }

        function ProductRestore($id)
        {
            porducts::withTrashed()->findOrFail($id)->restore();
            return redirect('productView')->with('delete', 'Your Data is successfully restored');
        }

        function ProductForceDelete($id)
        {
            $img = porducts::withTrashed()->findOrFail($id)->ProductThambnail;
            if($img != null){
                $img = porducts::withTrashed()->findOrFail($id)->ProductThambnail;
                if (file_exists(public_path('img/products/thumbnail/' . $img))) {
                    unlink(public_path('img/products/thumbnail/' . $img));
                }
                $galleryImgs = productGallery::where('product_id', $id)->get();
                foreach($galleryImgs as $img){
                    if(file_exists(public_path('img/products/gallery'.'/'.$img->img_name))){
                        unlink(public_path('img/products/gallery'.'/'.$img->img_name));
                        $img->delete();
                    }
                }
            }
            else{
                $galleryImgs = productGallery::where('product_id', $id)->get();
                foreach($galleryImgs as $img){
                    if(file_exists(public_path('img/products/gallery'.'/'.$img->img_name))){
                        unlink(public_path('img/products/gallery'.'/'.$img->img_name));
                        $img->delete();
                    }
                }
            }

            porducts::withTrashed()->findOrFail($id)->forceDelete();
            return redirect('productView')->with('delete', 'Your Data is Finally Deleted');
        }

        function deleteGalleryImg($id){
             $pro = productGallery::where('id',$id)->first();
            if(file_exists(public_path('img/products/gallery'.'/'.$pro->img_name))){
                unlink(public_path('img/products/gallery'.'/'.$pro->img_name));
            }
            productGallery::findOrFail($id)->delete();
            return back();
        }
        
    }

