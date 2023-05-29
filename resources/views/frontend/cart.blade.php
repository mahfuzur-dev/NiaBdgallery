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
                              <li class="breadcrumb-item"><a href="#">Product</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Cart</li>
                         </ol>
                    </div>
               </div>
          </div>
     </div>
</section>
<!-- BreadCrumb HTML End -->
<!-- Cart HTML Start -->
<section id="cart">
     <div class="container">
          <div class="row">
               <div class="col-lg-6 m-auto">
                    <div class="cart_head text-center">
                         <h3><i class="fa-solid fa-bag-shopping"></i> Cart</h3>
                    </div>
               </div>
          </div>
          <div class="row">
               <div class="col-lg-8">
                    <div class="cart_details">
                         <form action="{{route('cart.update')}}" method="POST">
                              @csrf
                              <div style="overflow-x: auto;">
                                   <table class="table text-center">
                                        <tr>
                                             <th>Remove</th>
                                             <th>Product</th>
                                             <th style="width: 100px;">Price</th>
                                             <th style="width: 160px;">Quantity</th>
                                             <th>SubTotal</th>
                                        </tr>
                                        @php
                                             $subtotal = 0;
                                        @endphp
                                        @foreach ($all_carts as $cart)
                                             <tr>
                                                  <td class="remove"><a href="{{route('cart.remove',$cart->id)}}"><i class="fa-solid fa-xmark"></i></a></td>
                                                  <td class="product_img">
                                                       <img src="{{asset('uploads/product/preview')}}/{{$cart->rel_to_product->preview}}" alt="">
                                                       <h3>{{$cart->rel_to_product->product_name}}</h3>
                                                  </td>
                                                  <td class="product_price abc">&#2547 {{$cart->rel_to_product->after_discount}}</td>
                                                  <td class="product_quantity abc">
                                                       <button type="button"><span class="minus" data-price="{{$cart->rel_to_product->after_discount}}">-</span></button>
                                                       <input type="text" id="quantity" name="quantity[{{$cart->id}}]" readonly value="{{$cart->quantity}}">
                                                       <button type="button"><span class="plus" data-price="{{$cart->rel_to_product->after_discount}}">+</span></button>
                                                  </td>
                                                  <td class="product_sub"> &#2547 <span class="abc">{{$cart->rel_to_product->after_discount * $cart->quantity}}</span></td>
                                             </tr>
                                             @php
                                                  $subtotal += $cart->rel_to_product->after_discount * $cart->quantity;
                                             @endphp
                                        @endforeach
                                   </table>
                              </div>
                              <div class="cart_update">
                                   <button type="submit">Update</button>
                              </form>
                              <div class="coupon_box me-auto">
                                   <form action="#">
                                        <input type="text" name="coupon" value="{{@$_GET['coupon']}}"  placeholder="Enter Your Coupon">
                                        <button type="submit" class="coupon_btn">Submit</button>
                                   </form>
                              </div>
                              @php
                                   if($type == 2){
                                        $discount_final = round($subtotal*$discount/100);
                                   }
                                   else{
                                        $discount_final = $discount;
                                   }
                              @endphp
                              @if ($message)
                                   <div class="text-danger text-end py-2">{{$message}}</div>
                                   @else
                                   
                              @endif
                         </div>
                    </div>
               </div>
               @php
                    session([
                         'discount_final'=>$discount_final,
                    ])
               @endphp
               <div class="col-lg-4">
                    <div class="cart_total">
                         <div class="cart_total_head">
                              <h3>Cart Totals</h3>
                         </div>
                         <div class="cart_total_table">
                              <table class="table">
                                   <tr>
                                        <th>SubTotal</th>
                              <td>&#2547 {{$subtotal}}</td>
                                   </tr>
                                   <tr>
                                        <th>Discount</th>
                                        <td>&#2547 {{$discount_final}}</td>
                                   </tr>
                                   <tr>
                                        <th>Total</th>
                                        <td>&#2547 <span class="total">{{$subtotal - $discount_final}}</span></td>
                                   </tr>
                              </table>
                              <div class="proceed_btn">
                                   <a href="{{route('checkout')}}">Proceed To Checkout</a>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</section>
<!-- Cart HTML End -->
@endsection

@section('js_script')
     <script>
          var qauntity_input = document.querySelectorAll('.abc');
          var arr = Array.from(qauntity_input);
          
          arr.map(item=>{
               item.addEventListener('click',function(e){
                    if(e.target.className == 'plus'){
                         e.target.parentElement.previousElementSibling.value++;
                         var quantity = e.target.parentElement.previousElementSibling.value
                         var price = e.target.dataset.price
                         item.nextElementSibling.innerHTML = price*quantity
                    }
                    if(e.target.className == 'minus'){
                         if(e.target.parentElement.nextElementSibling.value > 1){
                              e.target.parentElement.nextElementSibling.value--;
                              var quantity = e.target.parentElement.nextElementSibling.value
                              var price = e.target.dataset.price
                              item.nextElementSibling.innerHTML = price*quantity     
                         }
                    }
               });
          });


     </script>
@endsection