<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta name="csrf-token" content="{{ csrf_token() }}">
     <title>Nia Gallery</title>
     <!-- Google Link -->
     <link href="https://fonts.googleapis.com/css2?family=Fasthand&family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
          rel="stylesheet">
     <!-- Google Link -->
     <link rel="shortcut icon" href="{{asset('frontend/assets/images/favicon.png')}}" type="image/x-icon">
     <link rel="stylesheet" href="{{asset('frontend/assets/css/all.min.css')}}">
     <link rel="stylesheet" href="{{asset('frontend/assets/css/bootstrap.min.css')}}">
     <link rel="stylesheet" href="{{asset('frontend/assets/css/slick.css')}}">
     <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
     <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
     <link rel="stylesheet" href="{{asset('frontend/assets/css/style.css')}}">
     <link rel="stylesheet" href="{{asset('frontend/assets/css/responsive.css')}}">

</head>

<body>
     <!-- Header HTML Start -->
     <header id="header">
          <nav class="navbar navbar-expand-lg">
               <div class="container">
                    <a class="navbar-brand" href="#">
                         <img src="{{asset('frontend/assets/images/logo.png')}}" alt="logo" class="img-fluid">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                         data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                         aria-expanded="false" aria-label="Toggle navigation">
                         <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                         <ul class="navbar-nav me-3">
                              <li class="nav-item">
                                   <a class="nav-link active" aria-current="page" href="{{route('frontend')}}">Home</a>
                              </li>
                              <li class="nav-item dropdown">
                                   <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        Categories
                                   </a>
                                   <ul class="dropdown-menu">
                                        @foreach (App\Models\Category::all() as $category)
                                             <li>
                                                  <span class="dropdown-item">
                                                       <input type="radio" id="category{{$category->id}}" name="category" class="category_id" value="{{$category->id}}"
                                                       @if (isset($_GET['category']))
                                                            @if ($_GET['category']== $category->id)
                                                                 checked
                                                            @endif
                                                       @endif
                                                       >
                                                       <label for="category{{$category->id}}">{{$category->category_name}}</label></span>
                                             </li>
                                        @endforeach
                                   </ul>
                              </li>
                              <li class="nav-item">
                                   <a class="nav-link" href="{{route('shop')}}">Products</a>
                              </li>
                              <li class="nav-item">
                                   <a class="nav-link" href="{{route('contact')}}">Contact Us</a>
                              </li>
                         </ul>
                         <div class="d-flex search_box">
                              <input class="form-control" id="search_input" type="text" placeholder="Search">
                              <button type="submit" class="search_btn"><i class="fa-solid fa-magnifying-glass"></i></button>
                         </div>
                         <div class="nav-right ms-auto">
                              <ul>
                                   <li>
                                        <div class="dropdown">
                                             <a class="dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#"><i class="fa-solid fa-user"></i></a>
                                             <ul class="dropdown-menu">
                                                  @auth('customerlogin')
                                                       <li><a class="dropdown-item" href="{{route('account')}}">{{Auth::guard('customerlogin')->user()->name}}</a></li>
                                                       <li><a class="dropdown-item" href="{{route('customer.logout')}}">Logout</a></li>
                                                       @else
                                                       <li><a class="dropdown-item" href="{{route('customer.register')}}">Register</a></li>
                                                       <li><a class="dropdown-item" href="{{route('customer.login')}}">Login</a></li>
                                                  @endauth
                                             </ul>
                                        </div>

                                   </li>
                                   <li><a href="{{route('wish.view')}}"><i class="fa-regular fa-heart"></i><span>{{App\Models\Wish::where('customer_id',Auth::guard('customerlogin')->id())->count()}}</span></a></li>
                                   <li><a data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
                                             aria-controls="offcanvasExample"><i
                                                  class="fa-solid fa-cart-shopping"></i><span>{{App\Models\Cart::where('customer_id', Auth::guard('customerlogin')->id())->count()}}</span></a></li>
                              </ul>
                         </div>
                    </div>
               </div>
          </nav>
          <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample"
               aria-labelledby="offcanvasExampleLabel">
               <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasExampleLabel">Your Cart</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
               </div>
               <div class="offcanvas-body">
                    <div class="cart_nav_table">
                         <table>
                              @php
                                   $subtotal = 0;
                              @endphp
                              @foreach (App\Models\Cart::where('customer_id', Auth::guard('customerlogin')->id())->get() as $cart)
                                   <tr>
                                        <td class="table_img">
                                             <img src="{{asset('uploads/product/preview')}}/{{$cart->rel_to_product->preview}}" alt="product">
                                        </td>
                                        <td style="width: 280px;">
                                             <h3 class="product_head">{{$cart->rel_to_product->product_name}}</h3>
                                             <p class="product_short_desp">{{$cart->quantity}} X &#2547 {{$cart->rel_to_product->after_discount}}</p>
                                        </td>
                                        <td>
                                             <a href="{{route('cart.remove',$cart->id)}}" class="cart_delete"><i class="fa-solid fa-xmark"></i></a>
                                        </td>
                                   </tr>
                                   @php
                                        $subtotal += $cart->rel_to_product->after_discount * $cart->quantity
                                   @endphp
                              @endforeach
                         </table>
                         <div class="sub_total">
                              <div class="sub_text"><strong>Sub Total:</strong></div>
                              <div class="sub_price" style="width: 250px"><strong>&#2547 {{$subtotal}}</strong></div>
                         </div>
                         <div class="nav_button">
                              <a class="checkout" href="{{route('cart.view')}}">View Cart</a>
                         </div>
                    </div>
               </div>
          </div>
     </header>
     <!-- Header HTML End -->
     @yield('content')
     <!-- Default Service HTML Start -->
     <section id="default_service">
          <div class="container">
               <div class="row">
                    <div class="col-lg-3 col-sm-6">
                         <div class="sevice_box">
                              <div class="row">
                                   <div class="col-lg-4 m-auto">
                                        <div class="service_icon text-center">
                                             <i class="fa-solid fa-car-side"></i>
                                        </div>
                                   </div>
                                   <div class="col-lg-8">
                                        <div class="service_text">
                                             <h3>Free Shipping</h3>
                                             <h6>Whole Country</h6>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                         <div class="sevice_box">
                              <div class="row">
                                   <div class="col-lg-4 m-auto">
                                        <div class="service_icon text-center">
                                             <i class="fa-solid fa-phone"></i>
                                        </div>
                                   </div>
                                   <div class="col-lg-8">
                                        <div class="service_text">
                                             <h3>Helpline</h3>
                                             <h6>+880123456789</h6>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                         <div class="sevice_box">
                              <div class="row">
                                   <div class="col-lg-4 m-auto">
                                        <div class="service_icon text-center">
                                             <i class="fa-solid fa-headset"></i>
                                        </div>
                                   </div>
                                   <div class="col-lg-8">
                                        <div class="service_text">
                                             <h3>24 X 7</h3>
                                             <h6>Customer Support</h6>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                         <div class="sevice_box">
                              <div class="row">
                                   <div class="col-lg-4 m-auto">
                                        <div class="service_icon text-center">
                                             <i class="fa-solid fa-right-left"></i>
                                        </div>
                                   </div>
                                   <div class="col-lg-8">
                                        <div class="service_text">
                                             <h3>Returns</h3>
                                             <h6>Instant Exchange</h6>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </section>
     <!-- Default Service HTML End -->
     <!-- Footer HTML Start -->
     <footer id="footer">
          <div class="container">
               <div class="row">
                    <div class="col-lg-3">
                         <div class="footer_text">
                              <div class="footer_logo">
                                   <img src="{{asset('frontend/assets/images/logo.png')}}" alt="footer">
                              </div>
                              <div class="row">
                                   <div class="col-lg-2 col-sm-1">
                                        <div class="footer_icon">
                                             <i class="fa-solid fa-house-chimney"></i>
                                        </div>
                                   </div>
                                   <div class="col-lg-10 col-sm-11 col-sm-">
                                        <div class="footer_address">
                                             <h5>123/A, Adabor-1234,Dhaka, Bangladesh.</h5>
                                        </div>
                                   </div>
                              </div>
                              <div class="row">
                                   <div class="col-lg-2 col-sm-1">
                                        <div class="footer_icon">
                                             <i class="fa-solid fa-phone"></i>
                                        </div>
                                   </div>
                                   <div class="col-lg-10 col-sm-11 col-sm-">
                                        <div class="footer_address">
                                             <h5>+0123 456 789</h5>
                                        </div>
                                   </div>
                              </div>
                              <div class="row">
                                   <div class="col-lg-2 col-sm-1">
                                        <div class="footer_icon">
                                             <i class="fa-solid fa-envelope"></i>
                                        </div>
                                   </div>
                                   <div class="col-lg-10 col-sm-11 col-sm-">
                                        <div class="footer_address">
                                             <h5>infoexample@gmail.com</h5>
                                        </div>
                                   </div>
                              </div>
                              <div class="footer_social">
                                   <ul>
                                        <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                                        <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa-brands fa-pinterest-p"></i></a></li>
                                        <li><a href="#"><i class="fa-brands fa-whatsapp"></i></a></li>
                                        <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                                   </ul>
                              </div>
                         </div>
                    </div>
                    <div class="col-lg-3">
                         <div class="footer_text">
                              <h3>Categories</h3>
                              <ul>
                                   <li><a href="#">Makeup</a></li>
                                   <li><a href="#">Skincare</a></li>
                                   <li><a href="#">Haircare</a></li>
                                   <li><a href="#">Fragrance</a></li>
                                   <li><a href="#">Bath and Body</a></li>
                                   <li><a href="#">Gift sets and bundles</a></li>
                              </ul>
                         </div>
                    </div>
                    <div class="col-lg-3">
                         <div class="footer_text">
                              <h3>Information</h3>
                              <ul>
                                   <li><a href="#">Search</a></li>
                                   <li><a href="#">About Us</a></li>
                                   <li><a href="#">Information</a></li>
                                   <li><a href="#">Privacy Policy</a></li>
                                   <li><a href="#">Contact Us</a></li>
                              </ul>
                         </div>
                    </div>
                    <div class="col-lg-3">
                         <div class="footer_text">
                              <h3>Support</h3>
                              <ul>
                                   <li><a href="#">Help</a></li>
                                   <li><a href="#">Opportunities</a></li>
                                   <li><a href="#">Careers</a></li>
                                   <li><a href="#">Refund & Return</a></li>
                                   <li><a href="#">Deliveries</a></li>
                              </ul>
                         </div>
                    </div>
               </div>
          </div>
     </footer>
     <!-- Footer HTML End -->
     <!-- Footer-bottom HTML Start -->
     <section id="footer_bottom">
          <div class="container">
               <div class="row">
                    <div class="col-lg-7 col-sm-7">
                         <div class="footer_bottom_left">
                              <p>Copyright © 2023 <span>Nia Gallery</span>. All rights reserved. <span>Mahfuzur Rahman
                                   </span>Theme Deginer.</p>
                         </div>
                    </div>
                    <div class="col-lg-5 col-sm-5">
                         <div class="footer_right_payment">
                              <ul>
                                   <li><a href="#"><img src="{{asset('frontend/assets/images/payment/bkash-logo-835789094A-seeklogo.com.png')}}"
                                                  alt="payment"></a></li>
                                   <li><a href="#"><img src="{{asset('frontend/assets/images/payment/Nagad_Logo_horizontally.png')}}"
                                                  alt="payment"></a></li>
                                   <li><a href="#"><img src="{{asset('frontend/assets/images/payment/1200px-Dutch-bangla_bank_limited.svg.png')}}"
                                                  alt="payment"></a></li>
                                   <li><a href="#"><img src="{{asset('frontend/assets/images/payment/pngwing.com(3).png')}}" alt="payment"></a></li>
                                   <li><a href="#"><img src="{{asset('frontend/assets/images/payment/pngwing.com(4).png')}}" alt="payment"></a></li>
                                   <li><a href="#"><img src="{{asset('frontend/assets/images/payment/pngwing.com(5).png')}}" alt="payment"></a></li>
                              </ul>
                         </div>
                    </div>
               </div>
          </div>
     </section>
     <!-- Footer-bottom HTML End -->

     <!-- Back To Top HTML Start -->
     <div class="back-to-top">
          <i class="fa-solid fa-arrow-up"></i>
     </div>
     <!-- Back To Top HTML End -->



     <!-- Js link -->
     <script src="{{asset('frontend/assets/js/jquery-1.12.4.min.js')}}"></script>
     <script src="{{asset('frontend/assets/js/bootstrap.bundle.min.js')}}"></script>
     <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
     <script src="{{asset('frontend/assets/js/waypoints.min.js')}}"></script>
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     <script src="{{asset('frontend/assets/js/jquery.counterup.min.js')}}"></script>
     <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
     <script src="{{asset('frontend/assets/js/slick.min.js')}}"></script>
     <script src="{{asset('frontend/assets/js/custom_accont.js')}}"></script>
     <script src="{{asset('frontend/assets/js/custom.js')}}"></script>
     <script>
          AOS.init();
     </script>
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
          @yield('js_script')
     <!-- Js link -->
</body>

</html>