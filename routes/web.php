<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerGithubController;
use App\Http\Controllers\CustomerGoogleController;
use App\Http\Controllers\CustomerLoginController;
use App\Http\Controllers\CustomerRegisterController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserGithubController;
use App\Http\Controllers\UserGoogleController;
use App\Http\Controllers\WishController;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Frontend 
Route::get('/',[FrontendController::class,'frontend'])->name('frontend');
Route::get('/product/details/{slug}',[FrontendController::class,'product_details'])->name('product.details');
Route::post('/getsize',[FrontendController::class, 'getsize']);
Route::post('/getStock',[FrontendController::class, 'getStock']);
Route::get('/checkout',[FrontendController::class, 'checkout'])->name('checkout');
Route::get('/account',[FrontendController::class, 'account'])->name('account');
Route::post('/account/info/update',[FrontendController::class, 'account_info_update'])->name('account.info.update');
Route::post('/account/password/change',[FrontendController::class, 'account_password_change'])->name('account.password.change');
Route::get('/shop/grid',[FrontendController::class,'shop'])->name('shop');
Route::get('/contact',[FrontendController::class,'contact'])->name('contact');
Route::post('/contact/send',[FrontendController::class,'contact_send'])->name('contact.send');

//Customer
Route::get('/invoice/download/{order_id}',[CustomerController::class,'customer_invoice'])->name('customer.invoice');
Route::post('/customer/review',[CustomerController::class,'review'])->name('review');

//Customer Message
Route::get('/customer/message', [CustomerController::class, 'customer_message'])->name('contact.message');
Route::get('/customer/contact/delete{contact_id}', [CustomerController::class, 'customer_contact_delete'])->name('contact.delete');

//Customer Wishlist
Route::get('/wishlist/{product_id}',[WishController::class,'wishlist'])->name('wish');
Route::get('/view/wishlist',[WishController::class,'wishlist_view'])->name('wish.view');
Route::get('/delete/wishlist/{wish_id}',[WishController::class,'wishlist_delete'])->name('wish.delete');


//Checkout

Route::post('/getcity',[CheckoutController::class, 'getcity']);
Route::post('/order/store',[CheckoutController::class, 'order_store'])->name('order.store');
Route::get('/order/success',[CheckoutController::class, 'order_success'])->name('order.success');

//Customer Register
Route::get('/customer/register',[CustomerRegisterController::class,'customer_register'])->name('customer.register');
Route::post('/customer/register/store',[CustomerRegisterController::class,'customer_register_store'])->name('customer.register.store');
Route::get('/email/veirfy/{verify_token}',[CustomerRegisterController::class, 'email_verify'])->name('email.verify');

// Customer Login
Route::get('/customer/login',[CustomerLoginController::class,'customer_login'])->name('customer.login');
Route::post('/customer/login/store',[CustomerLoginController::class,'customer_login_store'])->name('customer.login.store');
Route::get('/customer/logout',[CustomerLoginController::class,'customer_logout'])->name('customer.logout');

//Customer Login Github
Route::get('/customer/github/callback',[CustomerGithubController::class,'customer_github_callback']);
Route::get('/customer/github/callback/auth',[CustomerGithubController::class,'customer_github_callback_auth']);

//Customer Login Google
Route::get('/customer/google/callback',[CustomerGoogleController::class,'customer_google_callback']);
Route::get('/customer/google/callback/auth',[CustomerGoogleController::class,'customer_google_callback_auth']);

// Cart
Route::post('/cart/store',[CartController::class,'cart_store'])->name('cart.store');
Route::get('/cart/remove/{cart_id}',[CartController::class,'cart_remove'])->name('cart.remove');
Route::get('/cart/view',[CartController::class,'cart_view'])->name('cart.view');
Route::post('/cart/update',[CartController::class,'cart_update'])->name('cart.update');

//Password Reset
Route::get('/password/reset/form',[CustomerController::class,'password_reset_form'])->name('password.reset.form');
Route::post('/password/reset/request/send',[CustomerController::class,'password_reset_request_send'])->name('password.reset.request.send');
Route::get('/customer/password/reset/form/{reset_token}',[CustomerController::class, 'customer_pass_reset_form'])->name('customer.pass.reset.form');
Route::post('/customer/password/reset/new/update',[CustomerController::class, 'password_reset_new_update'])->name('password.reset.new.update');

//DashBoard
Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

///User Github
Route::get('/github/redirect',[UserGithubController::class,'redirect_provider']);
Route::get('/github/callback',[UserGithubController::class,'provider_to_application']);
///User Google
Route::get('/google/redirect',[UserGoogleController::class,'redirect_provider']);
Route::get('/google/callback',[UserGoogleController::class,'provider_to_application']);

//User Details
Route::get('/user/details',[UserController::class,'user_details'])->name('user.details');
Route::get('/user/list',[UserController::class,'user_list'])->name('user.list');
Route::get('/user/list/delete/{user_id}',[UserController::class,'user_delete'])->name('user.delete');
Route::get('/user/profile/edit',[UserController::class,'user_profile_edit'])->name('user.profile.edit');
Route::post('/user/profile/update',[UserController::class,'user_profile_update'])->name('user.profile.update');
Route::post('/user/info/update',[UserController::class,'user_info_update'])->name('update.info.user');

//Category Part
Route::get('/add/category',[CategoryController::class,'add_category'])->name('add.category');
Route::post('/submit/category',[CategoryController::class,'submit_category'])->name('submit.category');
Route::get('/list/category',[CategoryController::class,'list_category'])->name('list.category');
Route::get('/delete/category/{category_id}',[CategoryController::class,'delete_category'])->name('delete.category');
Route::get('/edit/category/{category_id}',[CategoryController::class,'edit_category'])->name('edit.category');
Route::post('/update/category',[CategoryController::class,'update_category'])->name('update.category');


//SubCategory Part
Route::get('/subcategory',[SubCategoryController::class,'subcategory'])->name('subcategory');
Route::post('/add/subcategory',[SubCategoryController::class,'add_subcategory'])->name('add.subcategory');
Route::get('/list/subcategory',[SubCategoryController::class,'list_subcategory'])->name('list.subcategory');
Route::get('/delete/subcategory/{subcategory_id}',[SubCategoryController::class,'delete_subcategory'])->name('delete.subcategory');
Route::get('/edit/subcategory/{subcategory_id}',[SubCategoryController::class,'edit_subcategory'])->name('edit.subcategory');
Route::post('/update/subcategory',[SubCategoryController::class,'update_subcategory'])->name('update.subcategory');

//Product Part
Route::get('/product',[ProductController::class,'product'])->name('product');
Route::post('/getsubcategory',[ProductController::class,'get_subcategory']);
Route::post('/add/product',[ProductController::class,'add_product'])->name('add.product');
Route::get('/list/product',[ProductController::class,'list_product'])->name('list.product');
Route::get('/delete/product/{product_id}',[ProductController::class,'delete_product'])->name('delete.product');
Route::get('/edit/product/{product_id}',[ProductController::class,'edit_product'])->name('edit.product');
Route::post('/update/product',[ProductController::class,'update_product'])->name('update.product');

//Inventory
Route::get('/inventory/{product_id}',[ProductController::class,'inventory'])->name('inventory');
Route::post('/add/inventory',[ProductController::class,'add_inventory'])->name('add.inventory');
Route::get('/delete/inventory/{inventory_id}',[ProductController::class,'delete_inventory'])->name('delete.inventory');

//Coupon
Route::get('/coupon',[CouponController::class,'coupon'])->name('coupon');
Route::post('/add/coupon',[CouponController::class, 'add_coupon'])->name('add.coupon');
Route::get('/delete/coupon/{coupon_id}',[CouponController::class, 'delete_coupon'])->name('delete.coupon');


//Color
Route::get('/color',[ColorController::class,'color'])->name('color');
Route::post('/add/color',[ColorController::class,'add_color'])->name('add.color');
Route::get('/delete/color/{color_id}',[ColorController::class,'delete_color'])->name('delete.color');

//Size
Route::get('/size',[SizeController::class,'size'])->name('size');
Route::post('/add/size',[SizeController::class,'add_size'])->name('add.size');
Route::get('/delete/size/{size_id}',[SizeController::class,'delete_size'])->name('delete.size');

// Role
Route::get('/role',[RoleController::class,'role'])->name('role');
Route::post('/add/permission',[RoleController::class,'add_permission'])->name('add.permission');
Route::post('/add/role',[RoleController::class,'add_role'])->name('add.role');
Route::get('/edit/role/{role_id}',[RoleController::class,'edit_role'])->name('edit.role');
Route::post('/update/role/',[RoleController::class,'update_role'])->name('update.role');
Route::post('/assign/role',[RoleController::class, 'assign_role'])->name('assign.role');
Route::get('/edit/permission/{user_id}',[RoleController::class, 'edit_permission'])->name('edit.permission');
Route::post('/update/permission',[RoleController::class, 'update_permission'])->name('update.permission');
Route::get('/remove/role/{user_id}',[RoleController::class, 'remove_role'])->name('remove.role');

//Order
Route::get('/orders',[OrderController::class,'orders'])->name('orders');
Route::post('/orders/status',[OrderController::class,'order_status'])->name('order.status');


// SSLCOMMERZ Start
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END