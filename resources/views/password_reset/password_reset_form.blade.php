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
                              <li class="breadcrumb-item"><a href="{{route('customer.login')}}">Login</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Reset Form</li>
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
                              <h3>Password Reset Form</h3>
                         </div>
                         <div class="login_form">
                              <form action="{{route('password.reset.new.update')}}" method="POST">
                                   @csrf
                                   <div class="mb-3">
                                        <label for="password" class="form-label">Enter New Password</label>
                                        <input type="password" id="password" name="password" class="form-control" placeholder="Enter Your Password">
                                        @error('password')
                                             <strong class="text-danger">{{$message}}</strong>
                                        @enderror
                                        <input type="hidden" name="reset_token" value="{{$data}}" class="form-control">
                                   </div>
                                   
                                   <div class="mb-4">
                                        <button type="submit">Send</button>
                                   </div>
                              </form>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</section>
<!-- Register HTML End -->
@endsection