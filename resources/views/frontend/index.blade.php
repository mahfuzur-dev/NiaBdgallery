@extends('frontend.master')
@section('content')
<!-- Banner HTML Start -->
     <section id="banner">
          <div class="container">
               <div class="row banner_slider">
                    <div class="col-lg-12">
                         <div class="row">
                              <div class="col-lg-6 col-md-6 m-auto">
                                   <div class="banner_left">
                                        <span>Costmetics Face Products</span>
                                        <h2 data-aos="flip-up" data-aos-offset="200" data-aos-delay="80"
                                             data-aos-duration="1500" data-aos-easing="ease-in-out">Discover Your
                                             Radiant Glow with Our Premium Cosmetics Collection</h2>
                                        <a href="{{route('shop')}}">Shop Now</a>
                                   </div>
                              </div>
                              <div class="col-lg-6 col-md-6">
                                   <div class="banner_right" data-aos="fade-up" data-aos-offset="200"
                                        data-aos-delay="50" data-aos-duration="1500" data-aos-easing="ease-in-out">
                                        <img src="{{asset('frontend/assets/images/banner.png')}}" alt="banner">
                                   </div>
                              </div>
                         </div>
                    </div>
                    <div class="col-lg-12">
                         <div class="row">
                              <div class="col-lg-6 col-md-6 m-auto">
                                   <div class="banner_left ">
                                        <span>Costmetics Face Products</span>
                                        <h2 data-aos="flip-left" data-aos-offset="200" data-aos-delay="80"
                                             data-aos-duration="1500" data-aos-easing="ease-in-out">Discover Your
                                             Radiant Glow with Our Premium Cosmetics Collection</h2>
                                        <a href="{{route('shop')}}">Shop Now</a>
                                   </div>
                              </div>
                              <div class="col-lg-6 col-md-6">
                                   <div class="banner_right" data-aos="fade-up" data-aos-offset="200"
                                        data-aos-delay="50" data-aos-duration="1500" data-aos-easing="ease-in-out">
                                        <img src="{{asset('frontend/assets/images/banner1.png')}}" alt="banner">
                                   </div>
                              </div>
                         </div>
                    </div>
                    <div class="col-lg-12">
                         <div class="row">
                              <div class="col-lg-6 col-md-6 m-auto">
                                   <div class="banner_left ">
                                        <span>Costmetics Face Products</span>
                                        <h2 data-aos="fade-up">Discover Your Radiant Glow with Our Premium Cosmetics
                                             Collection</h2>
                                        <a href="{{route('shop')}}">Shop Now</a>
                                   </div>
                              </div>
                              <div class="col-lg-6 col-md-6">
                                   <div class="banner_right" data-aos="fade-up" data-aos-offset="200"
                                        data-aos-delay="50" data-aos-duration="1500" data-aos-easing="ease-in-out">
                                        <img src="{{asset('frontend/assets/images/banner2.png')}}" alt="banner">
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </section>
     <!-- Banner HTML End -->
     <!-- Category HTML Start -->
     <section id="category">
          <div class="container">
               <div class="row category_slider">
                    @foreach ($all_categories as $category)
                         <div class="col-lg-3">
                              <div class="caregory_box">
                                   <div class="category_img text-center m-auto">
                                        <img src="{{asset('uploads/category')}}/{{$category->category_image}}" alt="">
                                        <div class="category_overlay">
                                             <a href="{{route('shop')}}">{{$category->category_name}}</a>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    @endforeach
               </div>
          </div>
     </section>
     <!-- Category HTML End -->
     <!-- Product HTML Start -->
     <section id="product">
          <div class="container">
               <div class="row">
                    <div class="col-lg-8 m-auto">
                         <div class="latest_product text-center">
                              <span>Shop Our Beauty Launches</span>
                              <h3>Our Products</h3>
                              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum at quos, eveniet dolores
                                   deleniti
                                   expedita!</p>
                         </div>
                    </div>
               </div>
               @php
                    $productRatings = [];

                    foreach ($all_products as $product) {
                         $total_review = App\Models\OrderProduct::where('product_id', $product->id)->where('review', '!=', null)->count();
                         $total_star = App\Models\OrderProduct::where('product_id', $product->id)->where('review', '!=', null)->sum('star');
                         $total_rating = 0;

                         if ($total_review != 0) {
                              $total_rating = round($total_star / $total_review);
                         }

                         $productRatings[$product->id] = $total_rating;
                    }
               @endphp

               <div class="row product_slider">
                    @foreach ($all_products as $product)
                         <div class="col-lg-3">
                              <div class="product_box" data-aos="fade-down" data-aos-offset="200" data-aos-delay="100"
                                   data-aos-duration="1500" data-aos-easing="ease-in-out">
                                   <div class="product_img m-auto text-center">
                                        <img src="{{asset('uploads/product/preview')}}/{{$product->preview}}" alt="product">
                                   </div>
                                   <div class="product_tag">
                                        <span>New</span>
                                   </div>
                                   <div class="product_icon">
                                        <ul>
                                             <li><a href="#"><i class="fa-regular fa-heart"></i></a></li>
                                             <li><a href="#"><i class="fa-solid fa-link"></i></a></li>
                                             <li><a href="#"><i class="fa-solid fa-share-nodes"></i></a></li>
                                        </ul>
                                   </div>
                                   <a href="{{route('product.details',$product->slug)}}">
                                        <div class="product_text">
                                        <h6>{{$product->rel_to_category->category_name}}</h6>
                                        <h3>{{$product->product_name}}</h3>
                                        <ul>
                                             @if (isset($productRatings[$product->id]))
                                                  @for ($i = 1; $i <= $productRatings[$product->id]; $i++)
                                                       <li><i class="fa-solid fa-star"></i></li>
                                                  @endfor
                                             @endif
                                        </ul>


                                        @if ($product->discount)
                                        <strong>&#2547 {{$product->after_discount}}</strong><del>&#2547 {{$product->price}}</del>
                                        @else
                                        <strong>&#2547 {{$product->after_discount}}</strong>
                                        @endif
                                   </a>
                                        <div class="cart">
                                             <a href="{{route('product.details',$product->slug)}}"><i class="fa-solid fa-cart-plus"></i> Cart</a>
                                        </div>
                                   </div>
                                   
                              </div>
                         </div>
                    @endforeach
               </div>
          </div>
     </section>
     <!-- Product HTML End -->
     <!-- Offer HTML Start -->
     <section id="offer">
          <div class="container">
               <div class="row">
                    <div class="col-lg-6 ms-auto">
                         <div class="offer_box m-auto">
                              <span>Cosmetic Destination</span>
                              <h3>Get 20% Off on all Cosmetic Cream Packs</h3>
                              <h6>Use Promo Code: <strong>NIA20</strong></h6>
                              <a href="#">Shop Now</a>
                         </div>
                    </div>
               </div>
          </div>
     </section>
     <!-- Offer HTML End -->

     <!-- Latest Product HTML Start -->
     <section id="product">
          <div class="container">
               <div class="row">
                    <div class="col-lg-8 m-auto">
                         <div class="latest_product text-center">
                              <span>Shop Our Latest Beauty Launches</span>
                              <h3>Our Latest Products</h3>
                              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum at quos, eveniet dolores
                                   deleniti expedita!</p>
                         </div>
                    </div>
               </div>
               <div class="row product_slider">
                    @foreach ($new_arrivals as $product)
                         <div class="col-lg-3">
                              <div class="product_box" data-aos="fade-down" data-aos-offset="200" data-aos-delay="100"
                                   data-aos-duration="1500" data-aos-easing="ease-in-out">
                                   <div class="product_img m-auto text-center">
                                        <img src="{{asset('uploads/product/preview')}}/{{$product->preview}}" alt="product">
                                   </div>
                                   <div class="product_tag">
                                        <span>New</span>
                                   </div>
                                   <div class="product_icon">
                                        <ul>
                                             <li><a href="#"><i class="fa-regular fa-heart"></i></a></li>
                                             <li><a href="#"><i class="fa-solid fa-link"></i></a></li>
                                             <li><a href="#"><i class="fa-solid fa-share-nodes"></i></a></li>
                                        </ul>
                                   </div>
                                   <a href="{{route('product.details',$product->slug)}}">
                                        <div class="product_text">
                                        <h6>{{$product->rel_to_category->category_name}}</h6>
                                        <h3>{{$product->product_name}}</h3>
                                        <ul>
                                             @if (isset($productRatings[$product->id]))
                                                  @for ($i = 1; $i <= $productRatings[$product->id]; $i++)
                                                       <li><i class="fa-solid fa-star"></i></li>
                                                  @endfor
                                             @endif
                                        </ul>


                                        @if ($product->discount)
                                        <strong>&#2547 {{$product->after_discount}}</strong><del>&#2547 {{$product->price}}</del>
                                        @else
                                        <strong>&#2547 {{$product->after_discount}}</strong>
                                        @endif
                                   </a>
                                        <div class="cart">
                                             <a href="{{route('product.details',$product->slug)}}"><i class="fa-solid fa-cart-plus"></i> Cart</a>
                                        </div>
                                   </div>
                                   
                              </div>
                         </div>
                    @endforeach
               </div>
          </div>
     </section>
     <!-- Latest Product HTML End -->
     <!-- Best Product HTML Start -->
     <section id="product">
          <div class="container">
               <div class="row">
                    <div class="col-lg-8 m-auto">
                         <div class="latest_product text-center">
                              <span>Shop Our Best Selling Beauty Launches</span>
                              <h3>Our Best Selling Products</h3>
                              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum at quos, eveniet dolores
                                   deleniti expedita!</p>
                         </div>
                    </div>
               </div>
               <div class="row product_slider">
                    @foreach ($best_sellings as $product)
                         <div class="col-lg-3">
                              <div class="product_box" data-aos="fade-down" data-aos-offset="200" data-aos-delay="100"
                                   data-aos-duration="1500" data-aos-easing="ease-in-out">
                                   <div class="product_img m-auto text-center">
                                        <img src="{{asset('uploads/product/preview')}}/{{$product->rel_to_product->preview}}" alt="product">
                                   </div>
                                   <div class="product_tag">
                                        <span>New</span>
                                   </div>
                                   <div class="product_icon">
                                        <ul>
                                             <li><a href="#"><i class="fa-regular fa-heart"></i></a></li>
                                             <li><a href="#"><i class="fa-solid fa-link"></i></a></li>
                                             <li><a href="#"><i class="fa-solid fa-share-nodes"></i></a></li>
                                        </ul>
                                   </div>
                                   <a href="{{route('product.details',$product->rel_to_product->slug)}}">
                                        <div class="product_text">
                                        <h3>{{$product->rel_to_product->product_name}}</h3>

                                        @if ($product->rel_to_product->discount)
                                        <strong>&#2547 {{$product->rel_to_product->after_discount}}</strong><del>&#2547 {{$product->rel_to_product->price}}</del>
                                        @else
                                        <strong>&#2547 {{$product->rel_to_product->after_discount}}</strong>
                                        @endif
                                   </a>
                                        <div class="cart">
                                             <a href="{{route('product.details',$product->rel_to_product->slug)}}"><i class="fa-solid fa-cart-plus"></i> Cart</a>
                                        </div>
                                   </div>
                                   
                              </div>
                         </div>
                    @endforeach
               </div>
          </div>
     </section>
     <!-- Best Product HTML End -->
     <!-- Counter HTML Start -->
     <section id="counter">
          <div class="container">
               <div class="row">
                    <div class="col-lg-3 col-sm-3">
                         <div class="counter_box text-center">
                              <i class="fa-regular fa-handshake"></i>
                              <h3><span class="counter">1520</span></h3>
                              <h4>Orders Completed</h4>
                         </div>
                    </div>
                    <div class="col-lg-3 col-sm-3">
                         <div class="counter_box text-center">
                              <i class="fa-solid fa-cart-shopping"></i>
                              <h3><span class="counter">320</span></h3>
                              <h4>Items In Catalog</h4>
                         </div>
                    </div>
                    <div class="col-lg-3 col-sm-3">
                         <div class="counter_box text-center">
                              <i class="fa-regular fa-handshake"></i>
                              <h3><span class="counter">1230</span></h3>
                              <h4>Happy Clients</h4>
                         </div>
                    </div>
                    <div class="col-lg-3 col-sm-3">
                         <div class="counter_box text-center">
                              <i class="fa-solid fa-mug-hot"></i>
                              <h3><span class="counter">765</span></h3>
                              <h4>Cup Of Coffee</h4>
                         </div>
                    </div>
               </div>
          </div>
     </section>
     <!-- Counter HTML End -->

     <!-- Blog HTML Start -->
     <section id="blog">
          <div class="container">
               <div class="row">
                    <div class="col-lg-6 col-sm-6">
                         <div class="blog_box">
                              <img src="{{asset('frontend/assets/images/feature1_720x.jpg')}}" alt="blog">
                         </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 m-auto">
                         <div class="blog_text">
                              <h2>01.</h2>
                              <h3>Organic Cream</h3>
                              <p>There are many variations of passages of Lorem Ipsum available, but the majority have
                                   suffered alteration in some form,
                                   by injected humour, or randomised words which don't look even slightly believable. If
                                   you are going to use a passage of
                                   Lorem Ipsum.</p>
                              <a href="#">View More</a>
                         </div>
                    </div>
               </div>
               <div class="row">
                    <div class="col-lg-6 col-sm-6 m-auto">
                         <div class="blog_text">
                              <h2>02.</h2>
                              <h3>Organic Cream</h3>
                              <p>There are many variations of passages of Lorem Ipsum available, but the majority have
                                   suffered alteration in some form,
                                   by injected humour, or randomised words which don't look even slightly believable. If
                                   you are going to use a passage of
                                   Lorem Ipsum.</p>
                              <a href="#">View More</a>
                         </div>
                    </div>
                    <div class="col-lg-6 col-sm-6">
                         <div class="blog_box">
                              <img src="{{asset('frontend/assets/images/feature3_720x.jpg')}}" alt="blog">
                         </div>
                    </div>
               </div>
          </div>
     </section>
     <!-- Blog HTML End -->
     <!-- Client Review HTML Start -->
     <section id="client">
          <div class="container">
               <div class="row client_slider">
                    @foreach ($all_clients_review as $review)
                    <div class="col-lg-12">
                         <div class="client_box m-auto text-center">
                              <div class="client_img m-auto text-center">
                                   <img src="{{ asset('frontend/assets/images/photo-1570295999919-56ceb5ecca61.jpg') }}" alt="client">
                              </div>
                              <h3>{{ $review->first()->rel_to_customer->name }}</h3>
                              <ul>
                                   @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $review->first()->star)
                                        <li><i class="fa-solid fa-star"></i></li>
                                        @else
                                        <li><i class="fa-regular fa-star"></i></li>
                                        @endif
                                   @endfor
                              </ul>
                              <p> {{ $review->first()->review }}</p>
                         </div>
                    </div>
                    @endforeach

               </div>
          </div>
     </section>
     <!-- Client Review HTML End -->

     <!-- Contact HTML Start -->
     <section id="contact">
          <div class="container">
               <div class="row">
                    <div class="col-lg-6 m-auto text-center">
                         <div class="contact_head">
                              <h3>Contact Us</h3>
                         </div>
                    </div>
               </div>
               @if (session('contact'))
                    <div class="alert alert-success">{{session('contact')}}</div>
               @endif
               <form action="{{route('contact.send')}}" method="POST">
                    @csrf
                    <div class="row">
                         <div class="col-lg-6">
                              <div class="contact_box">
                                   <div class="mb-3">
                                        <label for="name">Name<span>*</span></label>
                                        <input type="text" name="name" placeholder="Enter Your Name"
                                             class="form-control">
                                             @error('name')
                                                  <strong class="text-danger">{{$message}}</strong>
                                             @enderror
                                   </div>
                              </div>
                         </div>
                         <div class="col-lg-6">
                              <div class="contact_box">
                                   <div class="mb-3">
                                        <label for="name">Email<span>*</span></label>
                                        <input type="email" name="email" placeholder="Enter Your Email"
                                             class="form-control">
                                             @error('email')
                                                  <strong class="text-danger">{{$message}}</strong>
                                             @enderror
                                   </div>
                              </div>
                         </div>
                         <div class="col-lg-6">
                              <div class="contact_box">
                                   <div class="mb-3">
                                        <label for="name">Mobile Number<span>*</span></label>
                                        <input type="number" name="mobile" placeholder="Enter Your Mobile"
                                             class="form-control">
                                             @error('mobile')
                                                  <strong class="text-danger">{{$message}}</strong>
                                             @enderror
                                   </div>
                              </div>
                         </div>
                         <div class="col-lg-6">
                              <div class="contact_box">
                                   <div class="mb-3">
                                        <label for="name">Address</label>
                                        <input type="text" name="address" placeholder="Enter Your Address"
                                             class="form-control">
                                   </div>
                              </div>
                         </div>
                         <div class="col-lg-12">
                              <div class="contact_box">
                                   <div class="mb-3">
                                        <label for="name">Message<span>*</span></label>
                                        <textarea name="message" class="form-control"></textarea>
                                        @error('message')
                                                  <strong class="text-danger">{{$message}}</strong>
                                        @enderror
                                   </div>
                              </div>
                         </div>
                         <div class="col-lg-6">
                              <div class="submit">
                                   <button type="submit">Send Message</button>
                              </div>
                         </div>
                    </div>
               </form>
          </div>
     </section>
     <!-- Contact HTML End -->
@endsection