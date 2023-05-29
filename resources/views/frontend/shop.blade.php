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
                              <li class="breadcrumb-item"><a href="#">Shop</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Shop Grid</li>
                         </ol>
                    </div>
               </div>
          </div>
     </div>
</section>
<!-- BreadCrumb HTML End -->
<!-- Shop Grid HTML Start -->
<section id="shop_grid">
     <div class="container">
          <div class="row">
               <div class="col-lg-4 col-md-5">
                    <div class="shop_grid_left">
                         <h3>Your Filter</h3>
                         <hr>
                         <div class="price-input">
                              <div class="field">
                                   <span>Min</span>
                                   <input type="number" class="input-min" value="{{@$_GET['min']}}">
                              </div>
                              <div class="separator">-</div>
                              <div class="field">
                                   <span>Max</span>
                                   <input type="number" class="input-max" value="{{@$_GET['max']}}">
                              </div>
                         </div>
                         <div class="slider">
                              <div class="progress"></div>
                         </div>
                         <div class="range-input">
                              <input type="range" id="min" class="range" min="0" max="10000" value="{{@$_GET['min']}}" step="100">
                              <input type="range" id="max" class="range" min="0" max="10000" value="{{@$_GET['max']}}" step="100">
                         </div>
                         <hr>
                         <div class="category">
                              <h3>Category</h3>
                              <ul>
                                   @foreach ($all_categories as $category)
                                        <li>
                                             <input type="radio" class="category_id" value="{{$category->id}}" name="category" id="fashion{{$category->id}}"
                                                  @if (isset($_GET['category']))
                                                       @if ($_GET['category']== $category->id)
                                                            checked
                                                       @endif
                                                  @endif
                                             >
                                             <label for="fashion{{$category->id}}">{{$category->category_name}}</label>
                                        </li>
                                   @endforeach
                              </ul>
                         </div>
                         
                         <div class="category">
                              <h3>Color</h3>
                              <ul>
                                   @foreach ($all_colors as $color)
                                        
                                        <li>
                                             <input type="radio" class="color_id" value="{{$color->id}}" name="color" id="Nill{{$color->id}}"
                                                  @if (isset($_GET['color']))
                                                       @if ($_GET['color']== $color->id)
                                                            checked
                                                       @endif
                                                  @endif
                                             >
                                             <label for="Nill{{$color->id}}">{{$color->color_name}}</label>
                                        </li>
                                   
                                   @endforeach
                              </ul>
                         </div>
                         <div class="category">
                              <h3>Size</h3>
                              <ul>
                                   @foreach ($all_sizes as $size)
                                   <li>
                                        <input type="radio" class="size_id" value="{{$size->id}}" name="size" id="size{{$size->id}}" 
                                             @if (isset($_GET['size']))
                                                  @if ($_GET['size']== $size->id)
                                                       checked
                                                  @endif
                                             @endif
                                             >
                                        <label for="size{{$size->id}}">{{$size->size_name}}</label>
                                   </li>
                                   @endforeach
                              </ul>
                         </div>
                    </div>
               </div>
               <div class="col-lg-8 col-md-7">
                    <div class="shop_grid_right_head">
                         <div class="row">
                              <div class="col-lg-4 col-sm-4">
                                   <div class="shop_nav_icon">
                                        <ul>
                                             <li data-view="list-view" class="active">
                                                  <i class="fa-solid fa-bars"></i>
                                             </li>
                                             <li data-view="grid-view" class="">
                                                  <i class="fa-solid fa-border-all"></i>
                                             </li>
                                        </ul>
                                   </div>
                              </div>
                              <div class="col-lg-4 col-sm-8">
                                   <div class="shop_grid_sort">
                                        @php
                                             $selectedSort = isset($_GET['sort']) ? $_GET['sort'] : null;
                                        @endphp
                                        <select class="form-select sort">
                                             <option <?php if (isset($selectedSort) && $selectedSort === "") echo 'selected'; ?> value="">Default Sorting</option>
                                             <option <?php if (isset($selectedSort) && $selectedSort === "1") echo 'selected'; ?> value="1">A to Z</option>
                                             <option <?php if (isset($selectedSort) && $selectedSort === "2") echo 'selected'; ?> value="2">Z to A</option>
                                             <option <?php if (isset($selectedSort) && $selectedSort === "3") echo 'selected'; ?> value="3">Price High to Low</option>
                                             <option <?php if (isset($selectedSort) && $selectedSort === "4") echo 'selected'; ?> value="4">Price Low to High</option>
                                        </select>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <hr>
                    <div class="tab-content">
                         <div id="shop_home" class="view-wrap list_view" style="display: block;">
                              <div class="row">
                                   @foreach ($all_products as $product)
                                        
                                        <div class="col-lg-4 col-sm-6">
                                             <div class="product_grid">
                                                  <div class="product_img m-auto text-center">
                                                       <img src="{{asset('uploads/product/preview')}}/{{$product->preview}}" alt="product">
                                                  </div>
                                                  <div class="product_details">
                                                       <h6>{{$product->rel_to_category->category_name}}</h6>
                                                       <h3><a href="{{route('product.details',$product->slug)}}">{{$product->product_name}}</a></h3>
                                                       @if($product->discount)
                                                            <p>
                                                                 <span>&#2547 {{$product->after_discount}}</span>
                                                                 <del>&#2547 {{$product->price}}</del>
                                                            </p>
                                                                 @else
                                                                 <p><span>&#2547 {{$product->after_discount}}</span></p>
                                                            @endif
                                                       
                                                       <div class="cart_btn">
                                                            <a href="{{route('product.details',$product->slug)}}">Add to cart</a>
                                                       </div>
                                                  </div>
                                                  <div class="sale">
                                                       <span>Sale</span>
                                                  </div>
                                                  @if ($product->discount)
                                                       <div class="percent">
                                                            <span>{{$product->discount}}% OFF</span>
                                                       </div>
                                                  @else
                                                  
                                                  @endif
                                             </div>
                                        </div>
                                   
                                   @endforeach
                              </div>
                         </div>
                         <div id="shop_list" class="view-wrap grid_view" style="display: none;">
                              @foreach ($all_products as $product)
                                   
                                   <div class="product_grid">
                                        <div class="row">
                                             <div class="col-lg-3 col-sm-3">
                                                       <div class="product_img">
                                                            <img src="{{asset('uploads/product/preview')}}/{{$product->preview}}" alt="">
                                                       </div>
                                                  </div>
                                             <div class="col-lg-6 col-sm-6">
                                                  <div class="product_details">
                                                       <h6>{{$product->rel_to_category->category_name}}</h6>
                                                       <h3><a href="{{route('product.details',$product->slug)}}">{{$product->product_name}}</a></h3>
                                                       @if($product->discount)
                                                            <p>
                                                                 <span>&#2547 {{$product->after_discount}}</span>
                                                                 <del>&#2547 {{$product->price}}</del>
                                                            </p>
                                                            @else
                                                            <p><span>&#2547 {{$product->after_discount}}</span></p>
                                                       @endif
                                                       <div class="cart_btn">
                                                            <a href="{{route('product.details',$product->slug)}}">Add to cart</a>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                        <div class="sale">
                                             <span>Sale</span>
                                        </div>
                                        @if ($product->discount)
                                             <div class="percent">
                                                  <span>{{$product->discount}}% OFF</span>
                                             </div>
                                             @else
                                                  
                                        @endif
                                   </div>
                              
                              @endforeach
                         </div>
                    </div>
               </div>
          </div>
     </div>
</section>
<!-- Shop Grid HTML End -->
@endsection

@section('js_script')
     <script>
          $('.search_btn').click(function(){
               var search_input = $('#search_input').val();
               var category_id = $('input[class="category_id"]:checked').val();
               var color_id = $('input[class="color_id"]:checked').val();
               var size_id = $('input[class="size_id"]:checked').val();
               var min = $('#min').val();
               var max = $('#max').val();
               var sort = $('.sort :selected').val();
               var link = "{{route('shop')}}"+"?q="+search_input+"&category="+category_id+"&color="+color_id+"&size="+size_id+"&min="+min+"&max="+max+"&sort="+sort;
                window.location.href = link;
          });
          $('.range').change(function(){
               var search_input = $('#search_input').val();
               var category_id = $('input[class="category_id"]:checked').val();
               var color_id = $('input[class="color_id"]:checked').val();
               var size_id = $('input[class="size_id"]:checked').val();
               var min = $('#min').val();
               var max = $('#max').val();
               var sort = $('.sort :selected').val();
               var link = "{{route('shop')}}"+"?q="+search_input+"&category="+category_id+"&color="+color_id+"&size="+size_id+"&min="+min+"&max="+max+"&sort="+sort;
                window.location.href = link;
          });
          $('.category_id').change(function(){
               var search_input = $('#search_input').val();
               var category_id = $('input[class="category_id"]:checked').val();
               var color_id = $('input[class="color_id"]:checked').val();
               var size_id = $('input[class="size_id"]:checked').val();
               var min = $('#min').val();
               var max = $('#max').val();
               var sort = $('.sort :selected').val();
               var link = "{{route('shop')}}"+"?q="+search_input+"&category="+category_id+"&color="+color_id+"&size="+size_id+"&min="+min+"&max="+max+"&sort="+sort;
                window.location.href = link;
          });
          $('.color_id').change(function(){
               var search_input = $('#search_input').val();
               var category_id = $('input[class="category_id"]:checked').val();
               var color_id = $('input[class="color_id"]:checked').val();
               var size_id = $('input[class="size_id"]:checked').val();
               var min = $('#min').val();
               var max = $('#max').val();
               var sort = $('.sort :selected').val();
               var link = "{{route('shop')}}"+"?q="+search_input+"&category="+category_id+"&color="+color_id+"&size="+size_id+"&min="+min+"&max="+max+"&sort="+sort;
                window.location.href = link;
          });
          $('.size_id').change(function(){
               var search_input = $('#search_input').val();
               var category_id = $('input[class="category_id"]:checked').val();
               var color_id = $('input[class="color_id"]:checked').val();
               var size_id = $('input[class="size_id"]:checked').val();
               var min = $('#min').val();
               var max = $('#max').val();
               var sort = $('.sort :selected').val();
               var link = "{{route('shop')}}"+"?q="+search_input+"&category="+category_id+"&color="+color_id+"&size="+size_id+"&min="+min+"&max="+max+"&sort="+sort;
                window.location.href = link;
          });
          $('.sort').change(function(){
               var search_input = $('#search_input').val();
               var category_id = $('input[class="category_id"]:checked').val();
               var color_id = $('input[class="color_id"]:checked').val();
               var size_id = $('input[class="size_id"]:checked').val();
               var min = $('#min').val();
               var max = $('#max').val();
               var sort = $('.sort :selected').val();
               var link = "{{route('shop')}}"+"?q="+search_input+"&category="+category_id+"&color="+color_id+"&size="+size_id+"&min="+min+"&max="+max+"&sort="+sort;
                window.location.href = link;
          });
     </script>
@endsection