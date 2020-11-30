<?php

namespace App\Http\Controllers;
use App\subCategory;
use Carbon\carbon;

use Illuminate\Http\Request;
use App\category;

class subCategoryController extends Controller
{
    function subCategoryAdd(){
        $cat = category::all();
        return view('backend.subCategoryAdd', compact('cat'));
    }

    function subCategoryPost(Request $data){
        $data->validate([
            'catId' => ['required'],
            'subCategory' => ['required'],
        ]);
        subCategory::insert([
            'catId' => $data->catId,
            'subCategory' => $data->subCategory,
            'created_at' => carbon::now(),
            'updated_at' => carbon::now()
        ]);
        return back()->with('subCat', "Sub Categroy Successfully added");

    }

    function subCategoryView(){
        $subCat = subCategory::with('getCategories')->orderBy('subCategory', 'asc')->paginate(2);
        return view('backend.subCategoryView', compact('subCat'));
    }

    function subCategoryDelete($id){
        subCategory::findOrFail($id)->delete();
        return back()->with('delete', 'Your Data has been move to trush');
    }

    function subCategoryTrush(){
        $subCat = subCategory::orderBy('subCategory', 'asc')->onlyTrashed()->paginate(2);
        return view('backend.subCategoryTrush', compact('subCat'));
    }

   function subCategoryTrushRecover($id){
       subCategory::withTrashed()->findOrFail($id)->restore();
        return redirect('subCategoryView')->with('delete', 'Your file Successfully recovered');
   }
   function subCategoryTrushForceDelete($id){

        subCategory::withTrashed()->findOrFail($id)->forceDelete();
        return back()->with('delete', 'Your file Permanently deleted');

   }
   function subCategoryUpdate($id){
        $subCat = subCategory::findOrFail($id);
        $cat = category::all();
    return view('backend.subCategoryUpdate', compact('subCat', 'cat'));
   }

   function subCategoryUpdatePost(Request $data){
        $data->validate([
            'subCategory' => 'required',
            'catId'=>'required'
        ]);
       subCategory::findOrFail($data->id)->update([
           'subCategory' => $data->subCategory,
           'catId' => $data->catId
       ]);
       return redirect('subCategoryView')->with('msg', 'Your Data is successfully updated');


   }


}
