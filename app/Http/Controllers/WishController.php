<?php

namespace App\Http\Controllers;

use App\Models\Wish;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishController extends Controller
{
    function wishlist($product_id){
        if(Auth::guard('customerlogin')->check()){
            $wish = Wish::where('customer_id', Auth::guard('customerlogin')->user()->id)->where('product_id', $product_id)->first();
            if ($wish == '') {
                Wish::insert([
                    'customer_id' => Auth::guard('customerlogin')->user()->id,
                    'product_id' => $product_id,
                    'created_at' => Carbon::now(),
                ]);
                return redirect()->route('frontend');
            } else {
                return redirect()->route('frontend');
            }
        }
        else{
            return redirect()->route('customer.register');
        }
        
    }
    function wishlist_view(){
        $all_wishes = Wish::where('customer_id', Auth::guard('customerlogin')->user()->id)->get();
        return view('frontend.wishlist',[
            'all_wishes'=> $all_wishes,
        ]);
    }
    function wishlist_delete($wish_id){
        Wish::find($wish_id)->delete();
        return back();
    }
}
