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
                                   <li class="breadcrumb-item"><a href="{{route('customer.register')}}">Register</a></li>
                                   <li class="breadcrumb-item active" aria-current="page">Library</li>
                              </ol>
                         </div>
                    </div>
               </div>
          </div>
     </section>
     <!-- BreadCrumb HTML End -->
     <!-- Register HTML Start -->
     <section id="register">
          <div class="container">
               <div class="row">
                    <div class="col-lg-6 m-auto">
                         <div class="register_box">
                              <div class="register_head text-center">
                                   <h3>Log In</h3>
                              </div>
                              @if (session('login'))
                                   <div class="alert alert-danger">{{session('login')}}</div>
                              @endif
                              @if (session('reset_success'))
                                   <div class="alert alert-success">{{session('reset_success')}}</div>
                              @endif
                              <div class="login_form">
                                   <form action="{{route('customer.login.store')}}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                             <label for="email" class="form-label">Email</label>
                                             <input type="email" id="email" name="email" class="form-control" placeholder="Enter Your Email">
                                        </div>
                                        <div class="mb-3">
                                             <label for="password" class="form-label">Password</label>
                                             <input type="password" name="password" id="password" class="form-control"
                                                  placeholder="New password">
                                             <i class="fa-regular fa-eye-slash" id="togglePassword"></i>
                                        </div>
                                        <div class="forget_pass">
                                             <a href="{{route('password.reset.form')}}">Forgot your password?</a>
                                        </div>
                                        <div class="mb-4">
                                             <button type="submit">Sign In</button>
                                             <span>Create Account? <a href="{{route('customer.register')}}">Sign Up</a></span>
                                        </div>
                                   </form>
                              </div>
                               <div class="row">
                                   <div class="col-sm-12">
                                        <div class="text-center login_social">
                                             <a href="{{url('/customer/google/callback')}}" class="btn btn-primary">
                                                  <i class="fa-brands fa-google"></i> Login With Google
                                             </a>
                                             <a href="#" class="btn btn-info">
                                                  <i class="fa-brands fa-facebook-f"></i> Login With Facebook
                                             </a>
                                             <a href="{{url('/customer/github/callback')}}" class="btn btn-primary">
                                                  <i class="fa-brands fa-github"></i> Login With Github
                                             </a>
                                        </div>
                                   </div>
               </div>
                         </div>
                    </div>
               </div>
              
          </div>
     </section>
     <!-- Register HTML End -->
@endsection