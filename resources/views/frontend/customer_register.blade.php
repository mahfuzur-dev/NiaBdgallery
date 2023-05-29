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
                                   <h3>Create Account</h3>
                              </div>
                              @if (session('register'))
                                   <div class="alert alert-success">{{session('register')}}</div>
                              @endif
                              @if (session('email_verify'))
                                   <div class="alert alert-success">{{session('email_verify')}}</div>
                              @endif
                              <div class="register_form">
                                   <form action="{{route('customer.register.store')}}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                             <label for="name" class="form-label">Name *</label>
                                             <input type="text" id="name" name="name" class="form-control" placeholder="Enter Your Name">
                                             @error('name')
                                                  <strong class="text-danger">{{$message}}</strong>
                                             @enderror
                                        </div>
                                        <div class="mb-3">
                                             <label for="email" class="form-label">Email *</label>
                                             <input type="email" id="email" name="email" class="form-control" placeholder="Enter Your Email">
                                             @error('email')
                                                  <strong class="text-danger">{{$message}}</strong>
                                             @enderror
                                        </div>
                                        <div class="mb-3">
                                             <label for="password" class="form-label">Password *</label>
                                             <input type="password" id="password" name="password" class="form-control" placeholder="New password">
                                             <i class="fa-regular fa-eye-slash" id="togglePassword"></i>
                                             @error('password')
                                                  <strong class="text-danger">{{$message}}</strong>
                                             @enderror
                                        </div>
                                        <div class="mb-3">
                                             <label for="conpassword" class="form-label">Confirm Password *</label>
                                             <input type="password" name="password_confirmation" class="form-control" id="conpassword" placeholder="Confirm password">
                                             <i class="fa-regular fa-eye-slash" id="toggleconPassword"></i>
                                        </div>
                                        <div class="mb-4">
                                             <button type="submit">Sign Up</button>
                                        </form>
                                             <span>Have you already an account? <a href="{{route('customer.login')}}">Sign In</a></span>
                                        </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </section>
     <!-- Register HTML End -->
@endsection