<?php

namespace App\Http\Controllers;

use App\countdownl;
use Illuminate\Http\Request;

class countdownController extends Controller
{
    function setCountdown(){
        $countDown = countdownl::first();
        return view('backend.countdown',compact('countDown'));
    }

    function countDownPost(Request $data){
        $data->validate([
            'Title' => 'required',
            'description' => 'required',
            'day' => 'required | numeric',
            'month' => 'required | numeric',
            'year' => 'required | numeric',
        ]);
        countdownl::first()->update([
            'Title' => $data->Title,
            'description' => $data->description,
            'day' => $data->day,
            'month' => $data->month,
            'year' => $data->year,
        ]);
        return back()->with('msg', 'Your Countdown is successfully updated');

    }


}
