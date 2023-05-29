<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    function subcategory(){
        $all_category = Category::all();
        return view('backend.subcategory.subcategory',[
            'all_category'=>$all_category,
        ]);
    }
    function add_subcategory(Request $request){
        $request->validate([
            'category_id'=>['required'],
            'subcategory_name'=>['required'],
        ]);
        Subcategory::insert([
            'category_id'=>$request->category_id,
            'subcategory_name'=>$request->subcategory_name,
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('subcategory_add','SubCategory Added!');
    }
    function list_subcategory(){
        $all_subcategories = Subcategory::all();
        return view('backend.subcategory.subcategory_list',[
            'all_subcategories'=>$all_subcategories,
        ]);
    }
    function delete_subcategory($subcategory_id){
        Subcategory::find($subcategory_id)->delete();
        return back();
    }
    function edit_subcategory($subcategory_id){
        $all_sub_info = Subcategory::find($subcategory_id);
        return view('backend.subcategory.edit_subcategory',[
            'all_sub_info'=>$all_sub_info,
        ]);
    }
    function update_subcategory(Request $request){
        Subcategory::where('id',$request->subcategory_id)->update([
            'subcategory_name'=>$request->subcategory_name,
            'created_at'=>Carbon::now(),
        ]);
        return redirect()->route('list.subcategory');
    }
}
