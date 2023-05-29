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
                                   <li class="breadcrumb-item active" aria-current="page">Product Details</li>
                              </ol>
                         </div>
                    </div>
               </div>
          </div>
     </section>
     <!-- BreadCrumb HTML End -->
     <!-- Product Details HTML Start -->
     <section id="product_details">
          <div class="container">
               <div class="row">
                    <div class="col-lg-5">
                         <div class="slider-for">
                              @foreach ($all_thumbnails as $thumbnail)
                                   <div class="product">
                                        <img class="zoomable" src="{{asset('uploads/product/thumbnail')}}/{{$thumbnail->thumbnail}}" alt="Tuhmbnail">
                                   </div>
                              @endforeach
                         </div>
                         <div class="slider-nav">
                              @foreach ($all_thumbnails as $short_thumb)
                                   <div class="product_small">
                                        <img src="{{asset('uploads/product/thumbnail')}}/{{$short_thumb->thumbnail}}" alt="thumbnail">
                                   </div>
                              @endforeach
                         </div>
                    </div>
                    <div class="col-lg-7">
                         <div class="product_text">
                              <div class="product_name">
                                   <h2>{{$slugs->first()->product_name}}</h2>
                                   
                                        <h3>Price : @if ($slugs->first()->discount)
                                             <span>&#2547 {{$slugs->first()->after_discount}}</span> 
                                             <del>&#2547 {{$slugs->first()->price}}</del>
                                             @else
                                             <span>&#2547 {{$slugs->first()->after_discount}}</span>
                                             @endif
                                        </h3>
                                   
                              </div>
                              <form action="{{route('cart.store')}}" method="POST">
                                   @csrf
                                   <div class="row">
                                        <div class="col-lg-6 col-sm-6">
                                             <input type="hidden" name="product_id" value="{{$slugs->first()->id}}">
                                             <label for="color_id">Color:</label>
                                             <select id="color_id" name="color_id" class="form-select">
                                                  <option value="0">--Select Color--</option>
                                                  @foreach ($available_colors as $color)
                                                       <option value="{{$color->rel_to_color->id}}">{{$color->rel_to_color->color_name}}</option>
                                                  @endforeach
                                             </select>
                                        </div>
                                        <div class="col-lg-6 col-sm-6">
                                             <label for="size_id">Size:</label>
                                             <select id="size_id" name="size_id" class="form-select">
                                                  <option value="0">--Select Size--</option>
                                                  
                                             </select>
                                        </div>
                                   </div>
                                   <div class="vendor">
                                        <h3>Vendor: <span>{{$slugs->first()->rel_to_subcategory->subcategory_name}}</span></h3>
                                        <h3>Category: <span>{{$slugs->first()->rel_to_category->category_name}}</span></h3> 
                                   </div>
                                   <div class="quantity">
                                        <h3>Quantity:</h3>
                                        <button type="button" id="minus">-</button>
                                        <input type="text" id="quantity" name="quantity" readonly value="1">
                                        <button type="button" id="plus">+</button>
                                   </div>
                                   <div class="cart">
                                        @auth('customerlogin')
                                             <button class="add_cart" type="submit"><i class="fa-solid fa-cart-plus"></i> Add To Cart</button>
                                             @else
                                             <a class="add_cart" href="{{route('customer.login')}}"><i class="fa-solid fa-cart-plus"></i> Add To Cart</a>
                                        @endauth
                                   </div>
                                   <a href="{{route('wish',$slugs->first()->id)}}" class="add_wish"><i class="fa-regular fa-heart"></i> Add To WishList</a>
                              </form>
                         </div>
                    </div>
               </div>
               @php
                    if($total_review == 0){
                         $avg = 0;
                    }
                    else{
                         $avg = round($total_star / $total_review);
                    }
               @endphp
               <div class="row">
                    <div class="col-lg-12">
                         <div class="tab">
                              <button class="tablinks" onclick="openCity(event, 'London')">Description</button>
                              <button class="tablinks" onclick="openCity(event, 'Paris')">Additional Information</button>
                              <button class="tablinks" onclick="openCity(event, 'Tokyo')">Review ({{$total_review}})</button>
                         </div>
                         
                         <div id="London" class="tabcontent" style="display: block;">
                              <h3>What is Lorem Ipsum?</h3>
                              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit, omnis. Labore vitae aliquam doloribus molestiae aspernatur iste, dolor in cum.</p>
                              <h3>What is Lorem Ipsum?</h3>
                              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit, omnis. Labore vitae aliquam doloribus molestiae aspernatur iste, dolor in cum.</p>
                              <h3>What is Lorem Ipsum?</h3>
                              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit, omnis. Labore vitae aliquam doloribus molestiae aspernatur iste, dolor in cum.</p>
                         </div>
                         
                         <div id="Paris" class="tabcontent">
                              <h3>What is Lorem Ipsum?12</h3>
                              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit, omnis. Labore vitae aliquam doloribus molestiae
                                   aspernatur iste, dolor in cum.</p>
                              <h3>What is Lorem Ipsum?</h3>
                              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit, omnis. Labore vitae aliquam doloribus molestiae
                                   aspernatur iste, dolor in cum.</p>
                              <h3>What is Lorem Ipsum?</h3>
                              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit, omnis. Labore vitae aliquam doloribus molestiae
                                   aspernatur iste, dolor in cum.</p>
                         </div>
                         
                         <div id="Tokyo" class="tabcontent">
                              <div class="total_star text-center">
                                   <ul>
                                        @for ($i=1;$i<=$avg;$i++)
                                             <li><i class="fa-solid fa-star"></i></li>
                                        @endfor
                                   </ul>
                                   <h3>Average Star Rating: {{$avg}} out of 5 ({{$total_review}} vote)</h3>
                              </div>
                              @foreach ($reviews as $review)
                                   
                                   <div class="product_review">
                                        <div class="row">
                                             <div class="col-lg-3 col-sm-3">
                                                  <div class="review_img">
                                                       @if ($review->rel_to_customer->profile_photo == null)
                                                            <img src="{{ Avatar::create($review->rel_to_customer->name)->toBase64() }}" />
                                                            
                                                            @endif
                                                  </div>
                                                  <div class="reviewer_details">
                                                       <h4>Mr. John</h4>
                                                       <p>{{$review->created_at->format('d M Y')}}</p>
                                                  </div>
                                             </div>
                                             <div class="col-lg-6 col-sm-9">
                                                  <div class="review_text">
                                                       <ul>
                                                            @for ($i=1;$i<=$review->star;$i++)
                                                                 <li><i class="fa-solid fa-star"></i></li>
                                                            @endfor
                                                       </ul>
                                                       <h5>{{$review->review}}</h5>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              
                              @endforeach


                              @if (session('review'))
                                      <div class="alert alert-success">{{session('review')}}</div>
                              @endif
                              @auth('customerlogin')
                                 @if (App\Models\OrderProduct::where('customer_id',Auth::guard('customerlogin')->id())->where('product_id',$slugs->first()->id)->exists())

                                 @if (App\Models\OrderProduct::where('customer_id',Auth::guard('customerlogin')->id())->where('product_id',$slugs->first()->id)->where('review', '!=' , null)->first() == false)
                                      
                                   <div class="write_review_part">
                                        <h3>Write a review</h3>
                                        <form action="{{route('review')}}" method="POST">
                                             @csrf
                                             <div class="mb-3">
                                                  <label for="name" class="form-label">Name</label>
                                                  <input type="text" id="name" class="form-control" value="{{Auth::guard('customerlogin')->user()->name}}">
                                                  <input type="hidden" name="product_id" value="{{$slugs->first()->id}}">
                                             </div>
                                             <div class="mb-3">
                                                  <label for="email" class="form-label">Email</label>
                                                  <input type="email" id="email"  class="form-control" value="{{Auth::guard('customerlogin')->user()->email}}">
                                             </div>
                                             <div class="mb-3">
                                                  <h5>Your Ratings:</h5>
                                                  <div class="star-rating">
                                                       <input type="radio" id="5-stars" name="star" value="5" />
                                                       <label for="5-stars" class="star">&#9733;</label>
                                                       <input type="radio" id="4-stars" name="star" value="4" />
                                                       <label for="4-stars" class="star">&#9733;</label>
                                                       <input type="radio" id="3-stars" name="star" value="3" />
                                                       <label for="3-stars" class="star">&#9733;</label>
                                                       <input type="radio" id="2-stars" name="star" value="2" />
                                                       <label for="2-stars" class="star">&#9733;</label>
                                                       <input type="radio" id="1-star" name="star" value="1" />
                                                       <label for="1-star" class="star">&#9733;</label>
                                                  </div>
                                                  @error('star')
                                                       <strong class="text-danger">{{$message}}</strong>
                                                  @enderror
                                             </div>
                                             <div class="mb-3">
                                                  <label for="review" class="form-label">Body of Review</label>
                                                  <textarea id="email" class="form-control" name="review" placeholder="Enter Your Review"></textarea>
                                                  @error('review')
                                                       <strong class="text-danger">{{$message}}</strong>
                                                  @enderror
                                             </div>
                                             <div class="mb-4">
                                                  <button type="submit">Submit</button>
                                             </div>
                                        </form>
                                   </div>

                                   @else
                                        <div class="alert alert-info">
                                             <p style="line-height: 24px;">You Already Review This Product.</p>
                                        </div>
                                   @endif


                                   @else
                                        <div class="alert alert-info">
                                             <p style="line-height: 24px;">We're sorry to hear you decided not to purchase our product, and we value your feedback and appreciate your consideration</p>
                                        </div>
                                 @endif

                                   @else
                                   <div class="alert alert-info">
                                        <h4 class="">Please Sign in to Review This Product <a href="{{route('customer.login')}}" class="btn btn-success float-end">Sign In</a></h4>
                                   </div>
                              @endauth
                         </div>
                    </div>
               </div>
          </div>
     </section>
     <!-- Product Details HTML End -->

     <!-- Related Product HTML Start -->
     <section id="related_product">
          <div class="container">
               <div class="row">
                    <div class="col-lg-6 m-auto">
                         <div class="related_product_head text-center">
                              <h3>Related Product</h3>
                              <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eum nobis, eligendi culpa laudantium illum reiciendis.</p>
                         </div>
                    </div>
               </div>
               <div class="row product_slider">
                    @foreach ($all_recent_product as $relet_product)
                         
                         <div class="col-lg-3">
                              <div class="product_box" data-aos="fade-down" data-aos-offset="200" data-aos-delay="100"
                                   data-aos-duration="1500" data-aos-easing="ease-in-out">
                                   <div class="product_img m-auto text-center">
                                        <img src="{{asset('uploads/product/preview')}}/{{$relet_product->preview}}" alt="product">
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
                                   <div class="product_text">
                                        <h6>{{$relet_product->rel_to_category->category_name}}</h6>
                                        <h3>{{$relet_product->product_name}}</h3>
                                        @if ($relet_product->discount)
                                        <strong>&#2547 {{$relet_product->after_discount}}</strong><del>&#2547 {{$relet_product->price}}</del>
                                        @else
                                        <strong>&#2547 {{$relet_product->after_discount}}</strong>
                                        @endif
                                        <div class="cart">
                                             <a href="{{route('product.details',$relet_product->slug)}}"><i class="fa-solid fa-cart-plus"></i> Cart</a>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    
                    @endforeach
               </div>
          </div>
     </section>
     <!-- Related Product HTML End -->
@endsection
@section('js_script')
     @if (session('cart'))
          <script>
               Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: '{{session('cart')}}',
                    showConfirmButton: false,
                    timer: 1500
                    });
          </script>
     @endif
     <script>
          $("#color_id").change(function(){
               var color_id = $(this).val();
               var product_id = "{{$slugs->first()->id}}";
               $.ajaxSetup({
                         headers: {
                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                         }
                    });
               
               $.ajax({
                    type:'POST',
                    url:'/getsize',
                    data:{'color_id':color_id,'product_id':product_id},
                    success:function(data){
                         $("#size_id").html(data);
                    }
               });

          });
          
     </script>
     <script>
          $("#size_id").change(function(){
               var color_id = $('.color_id').attr('data-col');
               var product_id = "{{$slugs->first()->id}}";
               var size_id = $(this).val();
               $.ajaxSetup({
                         headers: {
                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                         }
                    });
               
               $.ajax({
                    type:'POST',
                    url:'/getStock',
                    data:{'color_id':color_id,'product_id':product_id,'size_id':size_id},
                    success:function(data){
                       $('.cart').html(data);
                    }
               });

          });
          
     </script>
@endsection