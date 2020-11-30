<?php

namespace App\Http\Controllers;

use App\contact;
use Illuminate\Http\Request;

class messageController extends Controller
{
    function message(){
        $messages = contact::orderBy('created_at', 'desc')->paginate(10);
        return view('backend.messages', compact('messages'));
    }
    function messageView($id){
        $msg_details = contact::findOrFail($id);
        if($msg_details->status == 1){
            $msg_details->increment('status');
        }
        return view('backend.messageView', compact('msg_details'));
    }
    function messageUnseen($id){
        contact::findOrFail($id)->decrement('status');
        return redirect(route('message'));
    }
}
