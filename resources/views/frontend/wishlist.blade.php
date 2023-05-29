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
                              <li class="breadcrumb-item"><a href="{{route('shop')}}">Product</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Wishlist</li>
                         </ol>
                    </div>
               </div>
          </div>
     </div>
</section>
<!-- BreadCrumb HTML End -->
<!-- Wishlist HTML Start -->
<section id="wishlist">
     <div class="container">
          <div class="row">
               <div class="col-lg-12 col-sm-12 col-md-12">
                    <div class="wishlist_table" style="overflow-x: auto;">
                         <table class="table">
                              <tr>
                                   <th>Product</th>
                                   <th></th>
                                   <th>Price</th>
                                   <th>Add To Cart</th>
                                   <th>Remove</th>
                              </tr>
                              @foreach ($all_wishes as $wish)
                                   
                                   <tr>
                                        <td class="product_img">
                                             <img src="{{asset('uploads/product/preview')}}/{{$wish->rel_to_product->preview}}" alt="">
                                        </td>
                                        <td>
                                             <span>{{$wish->rel_to_product->product_name}}</span>
                                        </td>
                                        <td>&#2547 {{$wish->rel_to_product->after_discount}}</td>
                                        <td class="cart_btn">
                                             <a href="{{route('product.details',$wish->rel_to_product->slug)}}">Add To Cart</a>
                                        </td>
                                        <td class="remove_btn">
                                             <a href="{{route('wish.delete',$wish->id)}}"><i class="fa-solid fa-trash-can"></i></a>
                                        </td>
                                   </tr>
                              
                              @endforeach
                         </table>
                    </div>
                    
               </div>
          </div>
     </div>
</section>
<!-- Wishlist HTML End -->
@endsection