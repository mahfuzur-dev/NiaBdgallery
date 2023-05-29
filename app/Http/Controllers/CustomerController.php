<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\CustomerLogin;
use App\Models\CustomerPassReset;
use App\Models\OrderProduct;
use App\Notifications\CustomerResetPassNotification;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\pdf;
use Illuminate\Support\Facades\Notification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class CustomerController extends Controller
{
    function customer_invoice($order_id){
        $pdf = pdf::loadView('invoice.customer_status_invoice',[
            'order_id'=> $order_id,
        ]);
        return $pdf->download('invoice.pdf');
    }
    function review(Request $request){
        $request->validate([
            'review'=>'required',
            'star'=>'required',
        ]);
        OrderProduct::where('customer_id',Auth::guard('customerlogin')->id())->where('product_id',$request->product_id)->update([
            'review'=>$request->review,
            'star'=>$request->star,
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('review','Your Review Added!');
    }
    function password_reset_form(){
        return view('frontend.password_reset');
    }
    function password_reset_request_send(Request $request){
        $customer = CustomerLogin::where('email', $request->email)->firstOrFail();
        CustomerPassReset::where('customer_id',$customer->id)->delete();
        $pass_reset = CustomerPassReset::create([
                'customer_id'=>$customer->id,
                'reset_token'=>uniqid(),
                'created_at'=>Carbon::now(),
        ]);

        Notification::send($customer, new CustomerResetPassNotification($pass_reset));

        return back()->with('reset', 'Please follow the instructions provided in the email to reset your password securely.Please Check your Email');
    }
    function customer_pass_reset_form($reset_token){
        return view('password_reset.password_reset_form',[
            'data'=>$reset_token,
        ]);
    }
    function password_reset_new_update(Request $request){
        $customer_token = CustomerPassReset::where('reset_token',$request->reset_token)->firstOrFail();
        $customer = CustomerLogin::findOrFail($customer_token->customer_id);
        $request->validate([
            'password' => ['required', Password::min(8)->letters()->mixedCase()->numbers()->symbols()->uncompromised()],
        ]);
        $customer->update([
            'password'=>Hash::make($request->password),
        ]);
        $customer_token->delete();
        return redirect()->route('customer.login')->with('reset_success','Password Reset Success!');
    }
    
    function customer_message(){
        $all_contacts = Contact::all();
        return view('backend.customer message.customer_message',[
            'all_contacts'=> $all_contacts,
        ]);
    }
    function customer_contact_delete($contact_id){
        Contact::find($contact_id)->delete();
        return back();
    }
}
