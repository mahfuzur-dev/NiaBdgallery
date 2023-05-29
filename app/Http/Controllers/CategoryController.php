<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;

class CategoryController extends Controller
{
    function add_category(){
        return view('backend.category.add_category');
    }
    function submit_category(Request $request){
        $request->validate([
            'category_name'=>['required'],
        ]);
        $category_id = Category::insertGetId([
            'category_name'=>$request->category_name,
            'add_by'=>Auth::id(),
            'created_at'=>Carbon::now(),
        ]);
        $category_image = $request->category_image;
        $extension = $category_image->getClientOriginalExtension();
        $file_name = $category_id.'.'.$extension;
        Image::make($category_image)->save(public_path('uploads/category/'.$file_name));
        Category::where('id',$category_id)->update([
            'category_image'=>$file_name,
        ]);
        return back()->with('category_add','Category_added Successfully');
    }
    function list_category(){
        $all_categories = Category::all();
        return view('backend.category.list_category',[
            'all_categories'=>$all_categories,
        ]);
    }
    function delete_category($category_id){
        $category = Category::find($category_id);
        $delete_from = public_path('uploads/category/'.$category->category_image);
        unlink($delete_from);
        Category::find($category_id)->delete();
        return back();
    }
    function edit_category($category_id){
        $all_categories = Category::find($category_id);
        return view('backend.category.edit_category',[
            'all_categories'=>$all_categories,
        ]);
    }
    function update_category(Request $request){
        if($request->category_image == ''){
            Category::find($request->category_id)->update([
                'category_name'=>$request->category_name,
                'created_at'=>Carbon::now(),
            ]);
            return redirect()->route('list.category');
        }
        else{
            $image = Category::find($request->category_id);
            $image_delete = public_path('uploads/category/'.$image->category_image);
            unlink($image_delete);
            $category_image = $request->category_image;
            $extension = $category_image->getClientOriginalExtension();
            $file_name = $request->category_id.'.'.$extension;
            Image::make($category_image)->save(public_path('uploads/category/'.$file_name));
            Category::find($request->category_id)->update([
                'category_name'=>$request->category_name,
                'category_image'=>$file_name,
                'created_at'=>Carbon::now(),
            ]);
            return redirect()->route('list.category');
        }
    }
}