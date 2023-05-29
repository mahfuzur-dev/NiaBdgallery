<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class UserGithubController extends Controller
{
    function redirect_provider(){
        return Socialite::driver('github')->redirect();
    }
    function provider_to_application(){
        $user = Socialite::driver('github')->user();

        if(User::where('email',$user->getEmail())->exists()){
            if(Auth::attempt(['email' => $user->getEmail(), 'password' => 'abc..123@'])){
                return redirect('/home');
            }
        }
        else{
            User::insert([
                'name'=>$user->getName(),
                'email'=>$user->getEmail(),
                'password'=>bcrypt('abc..123@'),
                'created_at'=>Carbon::now(),
            ]);
            if(Auth::attempt(['email' => $user->getEmail(), 'password' => 'abc..123@'])){
                return redirect('/home');
            } 
        }
    }
}
