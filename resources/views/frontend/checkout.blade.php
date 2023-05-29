@extends('frontend.master')
@section('content')
<!-- BreadCrumb HTML Start -->
<section id="breadcrumb">
     <div class="container">
          <div class="row">
               <div class="col-lg-6">
                    <div class="breadcrumb_part">
                         <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{route('frontend')}}">Home</a></li>
                              <li class="breadcrumb-item"><a href="{{route('cart.view')}}">Cart</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                         </ol>
                    </div>
               </div>
          </div>
     </div>
</section>
<!-- BreadCrumb HTML End -->
<!-- Checkout HTML Start -->
<section id="checkout">
     <div class="container">
          <div class="row">
               <div class="col-lg-6 m-auto">
                    <div class="checkout_head text-center">
                         <h3>Billing Information</h3>
                    </div>
               </div>
          </div>
          <div class="row">
               <div class="col-lg-8">
                    <div class="billing_details">
                         <form action="{{route('order.store')}}" method="POST">
                              @csrf
                              <div class="row">
                                   <div class="mb-3 col-lg-6 col-sm-6">
                                        <input type="hidden" name="customer_id" value="{{Auth::guard('customerlogin')->id()}}">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{Auth::guard('customerlogin')->user()->name}}">
                                        @error('name')
                                             <strong class="text-danger">{{$message}}</strong>
                                        @enderror
                                   </div>
                                   <div class="mb-3 col-lg-6 col-sm-6">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{Auth::guard('customerlogin')->user()->email}}">
                                        @error('email')
                                             <strong class="text-danger">{{$message}}</strong>
                                        @enderror
                                   </div>
                                   <div class="mb-3 col-lg-6 col-sm-6">
                                        <label for="mobile" class="form-label">Mobile</label>
                                        <input type="number" class="form-control" name="mobile" id="mobile" placeholder="Mobile">
                                        @error('mobile')
                                             <strong class="text-danger">{{$message}}</strong>
                                        @enderror
                                   </div>
                                   <div class="mb-3 col-lg-6 col-sm-6">
                                        <label for="address" class="form-label">Address</label>
                                        <input type="text" class="form-control" name="address" id="address" placeholder="Address">
                                        @error('address')
                                             <strong class="text-danger">{{$message}}</strong>
                                        @enderror
                                   </div>
                                   <div class="mb-3 col-lg-6 col-sm-6">
                                        <label for="country_id" class="form-label">Country</label>
                                        <select id="country_id" name="country_id" class="form-select">
                                             <option value="">--Select Country --</option>
                                             @foreach ($all_countries as $country)
                                                  <option value="{{$country->id}}">{{$country->name}}</option>
                                             @endforeach
                                        </select>
                                        @error('country_id')
                                             <strong class="text-danger">{{$message}}</strong>
                                        @enderror
                                   </div>
                                   <div class="mb-3 col-lg-6 col-sm-6">
                                        <label for="city_id" class="form-label">City</label>
                                        <select id="city_id" name="city_id" class="form-select">
                                             <option value="">--Select City --</option>
                                        </select>
                                        @error('city_id')
                                             <strong class="text-danger">{{$message}}</strong>
                                        @enderror
                                   </div>
                                   <div class="mb-3">
                                        <label for="notes" class="form-label">Order Notes</label>
                                        <textarea class="form-control" name="note" id="notes" placeholder="Write Your Notes"></textarea>
                                   </div>
                              </div>
                    </div>
               </div>
               @php
                    $subtotal = 0;
                    foreach (App\Models\Cart::where('customer_id', Auth::guard('customerlogin')->id())->get() as $cart) {
                         $subtotal += $cart->rel_to_product->after_discount * $cart->quantity;
                    }
               @endphp
               <div class="col-lg-4">
                    <div class="order">
                         <h3>Your Order</h3>
                    </div>
                    <div class="order_table">
                         <table class="table">
                              <tr>
                                   <th>SubTotal:</th>
                                   <td>&#2547 {{$subtotal}}</td>
                              </tr>
                              <tr>
                                   <th>Discount:</th>
                                   <td>&#2547 {{session('discount_final')}}</td>
                              </tr>
                              <tr>
                                   <th>Delivery Charge:</th>
                                   <td>
                                        <input type="hidden" id="total" value="{{$subtotal - session('discount_final')}}">
                                        <input type="hidden" name="discount" value="{{session('discount_final')}}">
                                        <input type="hidden" name="subtotal" value="{{$subtotal}}">
                                        <input type="radio" name="delivery" value="70" class="delivery" id="inside">
                                        <label for="inside" class="form-label">Insite City</label>
                                        <br>
                                        <input type="radio" name="delivery" value="120" class="delivery" id="outside">
                                        <label for="outside" class="form-label">Outside City</label>
                                        @error('delivery')
                                             <strong class="text-danger">{{$message}}</strong>
                                        @enderror
                                   </td>
                              </tr>
                              <tr>
                                   <th>Total:</th>
                                   <td>&#2547 <span id="final_total">{{$subtotal - session('discount_final')}}</span></td>
                              </tr>
                         </table>
                    </div>
                    <div class="payment_part">
                         <ul>
                              <li>
                                   <input type="radio" name="payment_method" value="1" id="cash">
                                   <span></span>
                                   <label for="cash">Cash On Delivery</label>
                              </li>
                              <li>
                                   <input type="radio" name="payment_method" value="2" id="ssl">
                                   <span></span>
                                   <label for="ssl">SSL</label>
                              </li>
                              <li>
                                   <input type="radio" name="payment_method" value="3" id="stripe">
                                   <span></span>
                                   <label for="stripe">Stripe</label>
                              </li>
                         </ul>
                         @error('payment_method')
                              <strong class="text-danger">{{$message}}</strong>
                         @enderror
                         <hr>
                         <button type="submit">Place Order</button>
                    </div>
                    
                    </form>
               </div>
          </div>
     </div>
</section>
<!-- Checkout HTML End -->
@endsection
@section('js_script')
     <script>
          $(document).ready(function() {
               $('#country_id').select2();
          });
     </script>
     <script>
          $("#country_id").change(function(){
               var country_id = $(this).val();

               $.ajaxSetup({
                    headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
               });
               $.ajax({
                    type:'POST',
                    url:'/getcity',
                    data:{'country_id':country_id},
                    success:function(data){
                         $('#city_id').html(data);
                    }
               });

          });
     </script>
     <script>
          $(".delivery").change(function(){
               var delivery = parseInt($(this).val());
               var total = parseInt($('#total').val());
               var final_total = total+delivery;
               $("#final_total").html(final_total);
          });
     </script>
@endsection