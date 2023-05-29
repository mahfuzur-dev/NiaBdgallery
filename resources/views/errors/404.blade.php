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
                              <li class="breadcrumb-item active" aria-current="page">404 Error</li>
                         </ol>
                    </div>
               </div>
          </div>
     </div>
</section>
<!-- BreadCrumb HTML End -->
<!-- Error HTML Start -->
<section id="error">
     <div class="container">
          <div class="row">
               <div class="col-lg-8 m-auto">
                    <div class="error_box text-center">
                         <h1>404</h1>
                         <h3>Oops! Page Not Found!</h3>
                         <p>We’re sorry but we can’t seem to find the page you requested. This might be because you have typed the web address
                         incorrectly.</p>
                         <a href="{{route('frontend')}}">Back To Home</a>
                    </div>
               </div>
          </div>
     </div>
</section>
<!-- Error HTML End -->
@endsection

