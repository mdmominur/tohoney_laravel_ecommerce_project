<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;


class socialController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('github')->user();
        $data = User::where('provider_id',$user->getId())->where('email', $user->getEmail())->first();
        if($data){
            auth()->login($data);
        }else{
             User::insert([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'provider_id' => $user->getId(),
                'provider_name' => 'Github',
                'email_verified_at' => Carbon::now(),
            ]);
            $data2 = User::where('provider_id',$user->getId())->where('email', $user->getEmail())->first();
            auth()->login($data2);
        }
      /*  echo $user->getId();
        echo $user->getNickname();
        echo $user->getName();
        echo $user->getEmail();*/

        return redirect('/home');
    }

//google login
    public function redirectToProviderGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallbackGoogle()
    {
        $user = Socialite::driver('google')->user();
        $data = User::where('provider_id',$user->id)->where('email', $user->email)->first();
        if($data){
            auth()->login($data);
        }else{
            if(User::where('email', $user->email)->first()){
                return redirect('login')->with('error', 'The email is already taken');
            }else{
                User::insert([
                    'name' => $user->name,
                    'email' => $user->email,
                    'provider_id' => $user->id,
                    'provider_name' => 'Google',
                    'email_verified_at' => Carbon::now(),
                ]);
                $data2 = User::where('provider_id',$user->id)->where('email', $user->email)->first();
                auth()->login($data2);
            }

        }


        return redirect('/home');
    }

}
