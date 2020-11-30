<?php

namespace App\Http\Controllers;
use App\Emails;
use App\Mail\News;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\newsLetter;


class newsLetterController extends Controller
{
    function newsLetter(){
        $newsLetter = newsLetter::orderBy('created_at', 'desc')->paginate(8);
        return view('backend.newsLetter', compact('newsLetter'));
    }
    function newsLetterPost(Request $data){
        $data->validate([
            'message' => 'required',
        ]);
        $newsLetter = newsLetter::all();
        $messages = ['message' => $data->message ];
        foreach($newsLetter as $item){
            Mail::to($item->email)->send(new News($messages));
        }
        return back()->with('msg', 'successfully sent you message to all subscriber');

    }
}
