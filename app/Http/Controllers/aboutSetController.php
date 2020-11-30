<?php

namespace App\Http\Controllers;

use App\about;
use Carbon\Carbon;
use Illuminate\Http\Request;

class aboutSetController extends Controller
{
    function aboutSet(){
        $about = about::first();
        return view('backend.aboutSet', compact('about'));
    }
    function aboutPost(Request $data){
        about::findOrFail($data->id)->update([
                'Title' => $data->Title,
                'description' => $data->description,
                'created_at' => Carbon::now(),
        ]);
        return back()->with('msg', 'About is successfully updated');
    }

}
