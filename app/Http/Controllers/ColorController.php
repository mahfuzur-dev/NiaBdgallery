<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    function color(){
        $all_colors = Color::all();
        return view('backend.color.index',[
            'all_colors'=>$all_colors,
        ]);
    }
    function add_color(Request $request){
        $request->validate([
            'color_name'=>['required'],
            'color_code'=>['required'],
        ]);
        Color::insert([
            'color_name'=>$request->color_name,
            'color_code'=>$request->color_code,
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('add_color','Color Added!');
    }
    function delete_color($color_id){
        Color::find($color_id)->delete();
        return back()->with('delete_color','Color Deleted Successfully');
    }
}
