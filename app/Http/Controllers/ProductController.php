<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Size;
use App\Models\Subcategory;
use App\Models\Thumbnail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Image;

class ProductController extends Controller
{
    function product(){
        $all_categories = Category::all();
        return view('backend.product.add_product',[
            'all_categories'=>$all_categories,
        ]);
    }
    function get_subcategory(Request $request){
        $subcategoris = Subcategory::where('category_id',$request->category_id)->get();
        $str = '<option value="">-- Select SubCategory --</option>';
        foreach($subcategoris as $subcategory){
            $str .= "<option value='$subcategory->id'>$subcategory->subcategory_name</option>";
        }
        echo $str;
    }
    function add_product(Request $request){
        $name = str_replace('','-',$request->product_name);
        $slug = Str::lower($name).'-'.random_int(10000,9999999);
        $request->validate([
            'category_id'=>['required'],
            'product_name'=>['required'],
            'price'=>['required'],
            'short_desp'=>['required'],
            'description'=>['required'],
            'preview'=>['required'],
            'thumbnail'=>['required'],
        ]);
        $product_id = Product::insertGetId([
            'category_id'=>$request->category_id,
            'subcategory_id'=>$request->subcategory_id,
            'product_name'=>$request->product_name,
            'price'=>$request->price,
            'discount'=>$request->discount,
            'after_discount'=>$request->price - ($request->price * $request->discount/100),
            'brand'=>$request->brand,
            'short_desp'=>$request->short_desp,
            'description'=>$request->description,
            'slug'=>$slug,
            'created_at'=>Carbon::now(),
        ]);
        $preview = $request->preview;
        $extension = $preview->getClientOriginalExtension();
        $file_name = Str::lower($name).'-'.random_int(100,999).'.'.$extension;
        Image::make($preview)->resize(680,680)->save(public_path('uploads/product/preview/'.$file_name));
        Product::find($product_id)->update([
            'preview'=>$file_name,
        ]);
        $thumbnails = $request->thumbnail;
        foreach($thumbnails as $thumbnail){
            $thumbnail_extension = $thumbnail->getClientOriginalExtension();
            $thumbnail_file_name = Str::lower($name).'-'.random_int(1000,9999).'.'.$thumbnail_extension;
            Image::make($thumbnail)->resize(680,680)->save(public_path('uploads/product/thumbnail/'.$thumbnail_file_name));
            Thumbnail::insert([
                'product_id'=>$product_id,
                'thumbnail'=>$thumbnail_file_name,
                'created_at'=>Carbon::now(),
            ]);
        }
        return back()->with('add_product','Product Added!');
    }
    function list_product(){
        $all_products = Product::all();
        return view('backend.product.list_product',[
            'all_products'=>$all_products,
        ]);
    }
    function delete_product($product_id){
        $image = Product::find($product_id);
        $delete_preview = public_path('uploads/product/preview/'.$image->preview);
        unlink($delete_preview);
        $thumbs = Thumbnail::where('product_id',$product_id)->get();
        Inventory::where('product_id',$product_id)->delete();
        Product::find($product_id)->delete();
        foreach($thumbs as $thumb){
            $delete_thumb = public_path('uploads/product/thumbnail/'.$thumb->thumbnail);
            unlink($delete_thumb);
            Thumbnail::find($thumb->id)->delete();
        } 

        return back();
    }
    function edit_product($product_id){
        $all_products = Product::find($product_id);
        return view('backend.product.edit_product',[
            'all_products'=>$all_products,
        ]);
    }
    function update_product(Request $request){
        Product::find($request->product_id)->update([
            'product_name' => $request->product_name,
            'price' => $request->price,
            'discount' => $request->discount,
            'after_discount' => $request->price - ($request->price * $request->discount / 100),
            'brand' => $request->brand,
            'short_desp' => $request->short_desp,
        ]);
        return redirect()->route('list.product');
    }
    function inventory($product_id){
        $all_products = Product::find($product_id);
        $all_colors = Color::all();
        $all_sizes = Size::all();
        $all_inventories = Inventory::where('product_id',$product_id)->get();
        return view('backend.product.inventory.inventory',[
            'all_products'=>$all_products,
            'all_colors'=>$all_colors,
            'all_sizes'=>$all_sizes,
            'all_inventories'=>$all_inventories,
        ]);
    }
    function add_inventory(Request $request){
        $request->validate([
            'color_id'=>['required'],
            'size_id'=>['required'],
            'quantity'=>['required'],
        ]);
        if(Inventory::where('product_id',$request->product_id)->where('color_id',$request->color_id)->where('size_id',$request->size_id)->exists()){
            Inventory::where('product_id',$request->product_id)->where('color_id',$request->color_id)->where('size_id',$request->size_id)->increment('quantity',$request->quantity);
            return back()->with('add_inventory','Inventory Successfully Added!!');
        }
        else{
            Inventory::insert([
                'product_id'=>$request->product_id,
                'color_id'=>$request->color_id,
                'size_id'=>$request->size_id,
                'quantity'=>$request->quantity,
                'created_at'=>Carbon::now(),
            ]);
            return back()->with('add_inventory','Inventory Added!');
        }
    }
    function delete_inventory($inventory_id){
        Inventory::find($inventory_id)->delete();
        return back()->with('delete_inventory','Inventory Deleted!');
    }
}
