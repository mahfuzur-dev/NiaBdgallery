<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    function orders(){
        $all_orders = Order::all();
        return view('backend.orders.order',[
            'all_orders'=> $all_orders,
        ]);
    }
    function order_status(Request $request){
        $after_explode = explode(',', $request->status);
        $order_id = $after_explode[0];
        $status = $after_explode[1];

        Order::find($order_id)->update([
            'status' => $status,
        ]);
        return back();
    }
}
