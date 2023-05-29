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
                         @if (session('reset'))
                              <div class="alert alert-warning">{{session('reset')}}</div>
                         @endif
                         <div class="login_form">
                              <form action="{{route('password.reset.request.send')}}" method="POST">
                                   @csrf
                                   <div class="mb-3">
                                        <label for="email" class="form-label">Enter Reset Email</label>
                                        <input type="email" id="email" name="email" class="form-control" placeholder="Enter Your Email">
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