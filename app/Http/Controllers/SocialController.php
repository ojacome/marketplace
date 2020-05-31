<?php

namespace App\Http\Controllers;

use auth;
use App\User;
use Socialite;
use Illuminate\Http\Request;

class SocialController extends Controller
{

    function redirect($provider){

        return Socialite::driver($provider)->redirect();
    }

    function callback($provider){
        
        $getInfo = Socialite::driver($provider)->user();        
        // dd($getInfo);
        $user = $this->createUser($getInfo, $provider);

        auth()->login($user);

        return redirect()->to('/home');
    }

    function createUser($getInfo, $provider){
        $user = User::where('provider_id', $getInfo->id)->first();

        if(!$user){
            $user = User::create([

                'name'          => $getInfo->name,
                'email'         => $getInfo->email,
                'provider'      => $provider,
                'provider_id'   => $getInfo->id
            ]);
        }

        return $user;
    }
}
