<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    function coupon(){
        $all_coupons = Coupon::all();
        return view('backend.coupon.coupon',[
            'all_coupons'=> $all_coupons,
        ]);
    }
    function add_coupon(Request $request){
        $request->validate([
            'coupon_name'=>'required',
            'coupon_type'=>'required',
            'amount'=>'required',
            'validity'=>'required',
        ]);
        Coupon::insert([
            'coupon_name'=>$request->coupon_name,
            'coupon_type'=>$request->coupon_type,
            'amount'=>$request->amount,
            'validity'=>$request->validity,
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('coupon','Coupon Added!');
    }
    function delete_coupon($coupon_id){
        Coupon::find($coupon_id)->delete();
        return back();
    }
}
