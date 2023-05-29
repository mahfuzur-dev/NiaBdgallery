<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Contact;
use App\Models\Country;
use App\Models\CustomerLogin;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Size;
use App\Models\Subcategory;
use App\Models\Thumbnail;
use Illuminate\Validation\Rules\Password;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

class FrontendController extends Controller
{
    function frontend(){
        $all_categories = Category::all();
        $all_products = Product::all();
        $new_arrivals = Product::latest()->take(4)->get();
        $best_sellings = OrderProduct::groupBy('product_id')
        ->selectRaw('sum(quantity) as sum, product_id')
        ->orderBy('quantity','DESC')
        ->havingRaw('sum >= 2')
        ->get();
        $all_clients_review = OrderProduct::select('review')
        ->whereNotNull('review')
        ->distinct()
        ->get();

        return view('frontend.index',[
            'all_categories'=> $all_categories,
            'all_products'=> $all_products,
            'new_arrivals'=> $new_arrivals,
            'best_sellings'=> $best_sellings,
            'all_clients_review'=> $all_clients_review,
        ]);
    }
    function product_details($slug){
        $slugs = Product::where('slug',$slug)->get();
        $all_thumbnails = Thumbnail::where('product_id',$slugs->first()->id)->get();
        $available_colors = Inventory::where('product_id', $slugs->first()->id)->groupBy('color_id')->selectRaw('sum(color_id) as sum, color_id')->get();
        $related_products = Product::where('category_id', $slugs->first()->category_id)->where('id', '!=', $slugs->first()->id)->get();

        $product_id = $slugs->first()->id;
        $all = Cookie::get('recent_view');
        if (!$all) {
            $all = '[]';
        }
        $all_info = json_decode($all, true);
        $all_info = Arr::prepend($all_info, $product_id);
        $recent_viewed_id = json_encode($all_info);
        Cookie::queue('recent_view', $recent_viewed_id, 1000);
        $reviews = OrderProduct::where('product_id', $slugs->first()->id)->whereNotNull('review')->get();
        $total_review = OrderProduct::where('product_id', $slugs->first()->id)->whereNotNull('review')->count();
        $total_star = OrderProduct::where('product_id', $slugs->first()->id)->whereNotNull('review')->sum('star');


        $get_recent_view = json_decode(Cookie::get('recent_view', true));
        if ($get_recent_view == null) {
            $get_recent = [];
            $after_unique = array_unique($get_recent);
        } else {
            $after_unique = array_unique($get_recent_view);
        }
        $all_recent_product = Product::find($after_unique);
        return view('frontend.product_details',[
            'slugs'=> $slugs,
            'all_thumbnails'=> $all_thumbnails,
            'available_colors'=> $available_colors,
            'reviews'=> $reviews,
            'total_review'=> $total_review,
            'total_star'=> $total_star,
            'all_recent_product'=> $all_recent_product,
        ]);
    }
    function getsize(Request $request){
        $str = '<option value="" class="color_id" data-col="'.$request->color_id.'"> --Select Size -- </option>';
        $sizes = Inventory::where('product_id', $request->product_id)->where('color_id', $request->color_id)->get();
        foreach ($sizes as $size) {
            $str.= '<option value="'.$size->rel_to_size->id.'">'.$size->rel_to_size->size_name.'</option>';
        }
        echo $str;
    }
    function getStock(Request $request){
        $quantity = Inventory::where('product_id',$request->product_id)->where('color_id',$request->color_id)->where('size_id',$request->size_id)->first()->quantity;
        
        if($quantity == 0){
            echo '<button class="btn bg-warning disabled mt-1 me-1 py-2">Out Of Stock</button>';
        }
        else{
            if(Auth::guard('customerlogin')->check()){
                echo '<h6 class="pt-4 text-success">Stock: '.$quantity.'</h6>
                <button class="add_cart" type="submit"><i class="fa-solid fa-cart-plus"></i> Add To Cart</button>';
            }
            else{
                echo '<a class="add_cart" href="' . route('customer.login') . '"><i class="fa-solid fa-cart-plus"></i> Add To Cart</a>';

            }
        }
    }

    function checkout(){
        $all_countries = Country::all();
        return view('frontend.checkout',[
            'all_countries'=> $all_countries,
        ]);
    }
    function account(){
        $all_info = CustomerLogin::where('id',Auth::guard('customerlogin')->id())->get();
        $all_orders = Order::where('customer_id',Auth::guard('customerlogin')->id())->get();
        return view('frontend.account',[
            'all_info'=>$all_info,
            'all_orders'=> $all_orders,
        ]);
    }
    function account_info_update(Request $request){
        CustomerLogin::find(Auth::guard('customerlogin')->id())->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'created_at'=>Carbon::now(),
        ]);
        return back();
    }
    function account_password_change(Request $request){
        $request->validate([
            'old_password' => 'required',
            'new_password' => ['required', Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()],
        ]);
        if (Hash::check($request->old_password, Auth::guard('customerlogin')->user()->password)) {
            CustomerLogin::find(Auth::guard('customerlogin')->id())->update([
                'password' => bcrypt($request->new_password),
            ]);
            return back()->with('pass_success', 'Password has been Updated!!');
        } else {
            return back()->with('wrong', 'Old password doesnot match');
        }
    }

    function shop(Request $request){
        $data = $request->all();
        $term = 'created_at';
        $order = 'DESC';
        if (!empty($data['sort']) && $data['sort'] != '' && $data['sort'] != 'undefined') {
            if ($data['sort'] == 1) {
                $term = 'product_name';
                $order = 'ASC';
            } else if ($data['sort'] == 2) {
                $term = 'product_name';
                $order = 'DESC';
            } else if ($data['sort'] == 3) {
                $term = 'after_discount';
                $order = 'ASC';
            } else if ($data['sort'] == 4) {
                $term = 'after_discount';
                $order = 'DESC';
            } else {
                $term = 'created_at';
                $order = 'DESC';
            }
        }
        $all_products = Product::where(function ($q) use ($data) {
            if (!empty($data['q']) && $data['q'] != '' && $data['q'] != 'undefined') {
                $q->where(function ($q) use ($data) {
                    $q->where('product_name', 'like', '%' . $data['q'] . '%');
                    $q->orWhere('description', 'like', '%' . $data['q'] . '%');
                    $q->orWhere('brand', 'like', '%' . $data['q'] . '%');
                });
            }
            if (!empty($data['category']) && $data['category'] != '' && $data['category'] != 'undefined') {
                $q->where('category_id', $data['category']);
            }
            if (!empty($data['min']) && $data['min'] != '' && $data['min'] != 'undefined' || !empty($data['max']) && $data['max'] != '' && $data['max'] != 'undefined') {
                $q->whereBetween('after_discount', [$data['min'], $data['max']]);
            }
            if (!empty($data['color']) && $data['color'] != '' && $data['color'] != 'undefined' || !empty($data['size']) && $data['size'] != '' && $data['size'] != 'undefined') {
                $q->whereHas('rel_to_inventory', function ($q) use ($data) {
                    if (!empty($data['color']) && $data['color'] != '' && $data['color'] != 'undefined') {
                        $q->whereHas('rel_to_color', function ($q) use ($data) {
                            $q->where('colors.id', $data['color']);
                        });
                    }
                    if (!empty($data['size']) && $data['size'] != '' && $data['size'] != 'undefined') {
                        $q->whereHas('rel_to_size', function ($q) use ($data) {
                            $q->where('sizes.id', $data['size']);
                        });
                    }
                });
            }
        })->orderBy($term, $order)->get();


        $all_categories = Category::all();
        $all_colors = Color::all();
        $all_sizes = Size::all();
        return view('frontend.shop',[
            'all_products'=> $all_products,
            'all_categories'=> $all_categories,
            'all_colors'=> $all_colors,
            'all_sizes'=> $all_sizes,
        ]);
    }

    function contact(){
        return view('frontend.contact');
    }
    function contact_send(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>['required','email'],
            'mobile'=>'required',
            'message'=>'required',
        ]);
        Contact::insert([
            'name'=>$request->name,
            'email'=>$request->email,
            'mobile'=>$request->mobile,
            'address'=>$request->address,
            'message'=>$request->message,
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('contact','Thank You for contact us!');
    }
}
