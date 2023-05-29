<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CustomerEmailVerify;
use App\Models\CustomerLogin;
use App\Notifications\CustomerEmailVerifyNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\Rules\Password;

class CustomerRegisterController extends Controller
{
    function customer_register(){
        return view('frontend.customer_register');
    }
    function customer_register_store(Request $request){
        $request->validate([
            'name'=>['required'],
            'email'=>['required','email'],
            'password'=> ['required', Password::min(8)->letters()->mixedCase()->numbers()->symbols()->uncompromised()],
        ]);
        if($request->password == $request->password_confirmation){
            CustomerLogin::insert([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>bcrypt($request->password),
                'created_at'=>Carbon::now(),
            ]);
            $customer = CustomerLogin::where('email', $request->email)->firstOrFail();
            CustomerEmailVerify::where('customer_id', $customer->id)->delete();
            $verify_email = CustomerEmailVerify::create([
                'customer_id' => $customer->id,
                'verify_token' => uniqid(),
                'created_at' => Carbon::now(),
            ]);
            Notification::send($customer, new CustomerEmailVerifyNotification($verify_email));
            
            return back()->with('register', 'Your registration was successful. Please verify your email before login.');
        }

    }

    function email_verify($verify_token){
        $customer_token = CustomerEmailVerify::where('verify_token', $verify_token)->firstOrFail();
        $customer = CustomerLogin::findOrFail($customer_token->customer_id);
        $customer->update([
            'email_verified_at'=>Carbon::now(),
        ]);
        $customer_token->delete();
        return back()->with('email_verify','Your Email Verified!');
    }
}
