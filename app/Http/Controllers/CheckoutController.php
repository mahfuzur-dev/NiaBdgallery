<?php

namespace App\Http\Controllers;

use App\Mail\CustomerInvoice;
use App\Models\Billing;
use App\Models\Cart;
use App\Models\City;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    function getcity(Request $request)
    {
        $str = '<option value="">--Select City --</option>';
        $cities = City::where('country_id', $request->country_id)->get();
        foreach($cities as $city){
            $str.= '<option value="'.$city->id.'">'.$city->name.'</option>';
        }
        echo $str;
    }
    function order_store(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'mobile'=>'required',
            'address'=>'required',
            'country_id'=>'required',
            'city_id'=>'required',
            'delivery'=>'required',
            'payment_method'=>'required',
        ]);
        if($request->payment_method == 1){
            $order_id = Order::insertGetId([
                'customer_id'=>Auth::guard('customerlogin')->id(),
                'subtotal'=>$request->subtotal,
                'discount'=>$request->discount,
                'delivery'=>$request->delivery,
                'total'=>$request->subtotal - $request->discount + ($request->delivery),
                'created_at'=>Carbon::now(),
            ]);
            Billing::insert([
                'order_id'=>$order_id,
                'customer_id' => Auth::guard('customerlogin')->id(),
                'name'=>$request->name,
                'email'=>$request->email,
                'mobile'=>$request->mobile,
                'address'=>$request->address,
                'country_id'=>$request->country_id,
                'city_id'=>$request->city_id,
                'note'=>$request->note,
                'created_at'=>Carbon::now(),
            ]);
            
            $carts = Cart::where('customer_id',Auth::guard('customerlogin')->id())->get();
            foreach($carts as $cart){
                OrderProduct::insert([
                    'order_id'=>$order_id,
                    'customer_id' => Auth::guard('customerlogin')->id(),
                    'product_id'=>$cart->product_id,
                    'color_id'=>$cart->color_id,
                    'size_id'=>$cart->size_id,
                    'price'=>$cart->rel_to_product->after_discount,
                    'quantity'=>$cart->quantity,
                    'created_at'=>Carbon::now(),
                ]);
                Inventory::where('product_id',$cart->product_id)->where('color_id',$cart->color_id)->where('size_id',$cart->size_id)->decrement('quantity',$cart->quantity);
                Cart::find($cart->id)->delete();
            }
            $amount = $request->subtotal - $request->discount + ($request->delivery);
            Mail::to($request->email)->send(new CustomerInvoice($order_id));

            $url = "https://bulksmsbd.net/api/smsapi";
            $api_key = "WKYLSiHSqbLxCwhrgXGP";
            $senderid = "8809601004414";
            $number = $request->mobile;
            $message = "Your Order has been Successfully Placed!. Your Order Id is: #$order_id, Your Product Amount:$amount. ";

            $data = [
                "api_key" => $api_key,
                "senderid" => $senderid,
                "number" => $number,
                "message" => $message
            ];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($ch);
            curl_close($ch);


            return redirect()->route('order.success')->with('order','Your Order has been Successfully Placed!!');
        }
        elseif($request->payment_method == 2){
            $data = $request->all();
            return view('exampleHosted',[
                'data'=> $data,
            ]);
        }
        else{
            echo 'stripe';
        }
    }
    function order_success(){
        if(session('order')){
            return view('frontend.order_success');
        }
        else{
            abort('404');
        }
    }
}
