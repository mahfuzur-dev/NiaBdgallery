<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    function size(){
        $all_sizes = Size::all();
        return view('backend.size.index',[
            'all_sizes'=>$all_sizes,
        ]);
    }
    function add_size(Request $request){
        $request->validate([
            'size_name'=>['required'],
        ]);
        Size::insert([
            'size_name'=>$request->size_name,
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('add_size','Size Added!');
    }
    function delete_size($size_id){
        Size::find($size_id)->delete();
        return back()->with('delete_size','Size Deleted!');
    }
}
