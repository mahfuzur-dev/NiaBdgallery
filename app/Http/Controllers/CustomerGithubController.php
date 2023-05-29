<?php

namespace App\Http\Controllers;

use App\Models\CustomerLogin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class CustomerGithubController extends Controller
{
    function customer_github_callback(){
        return Socialite::driver('github')->redirect();

    }
    function customer_github_callback_auth(){
        $user = Socialite::driver('github')->user();
        
        if(CustomerLogin::where('email',$user->getEmail())->exists()){
            if(Auth::guard('customerlogin')->attempt(['email'=>$user->getEmail(),'password'=>'abcd..12@'])){
                return redirect('/');
            }
        }
        else{
            CustomerLogin::insert([
                'name'=>$user->getName(),
                'email'=>$user->getEmail(),
                'password'=>bcrypt('abcd..12@'),
                'created_at'=>Carbon::now(),
            ]);
            
            if (Auth::guard('customerlogin')->attempt(['email' => $user->getEmail(), 'password' => 'abcd..12@'])) {
                return redirect('/');
            }
        }

    }
}
