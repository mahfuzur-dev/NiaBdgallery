<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    function cart_store(Request $request){
        Cart::insert([
            'customer_id'=>Auth::guard('customerlogin')->id(),
            'product_id'=>$request->product_id,
            'color_id'=>$request->color_id,
            'size_id'=>$request->size_id,
            'quantity'=>$request->quantity,
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('cart', 'Cart Added!');
    }
    function cart_remove($cart_id){
        Cart::find($cart_id)->delete();
        return back();
    }
    function cart_view(Request $request){
        $coupon = $request->coupon;
        $message = null;
        $type = null;
        if($coupon == ''){
            $discount = 0;
        }
        else{
            if(Coupon::where('coupon_name',$coupon)->exists()){
                if(Carbon::now()->format('Y-m-d') > Coupon::where('coupon_name', $coupon)->first()->validity){
                    $discount = 0;
                    $message = 'The coupon code you entered has expired!';
                }
                else{
                    $type = Coupon::where('coupon_name', $coupon)->first()->coupon_type;
                    $discount = Coupon::where('coupon_name', $coupon)->first()->amount;
                }
            }
            else{
                $discount = 0;
                $message = 'Invalid Coupon Code';
            }
        }


        $all_carts = Cart::where('customer_id', Auth::guard('customerlogin')->id())->get();
        return view('frontend.cart',[
            'all_carts'=> $all_carts,
            'message'=> $message,
            'type'=> $type,
            'discount'=> $discount,
        ]);
    }
    function cart_update(Request $request){
        foreach($request->quantity as $cart_id=>$quantity){
            Cart::find($cart_id)->update([
                'quantity'=>$quantity,
                'created_at'=>Carbon::now(),
            ]);
        }
        return back();
    }
}
