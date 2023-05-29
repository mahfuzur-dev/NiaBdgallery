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
                              <li class="breadcrumb-item active" aria-current="page">Success</li>
                         </ol>
                    </div>
               </div>
          </div>
     </div>
</section>
<!-- BreadCrumb HTML End -->
<!-- Success HTML Start -->
<section id="success">
     <div class="container">
          <div class="row">
               <div class="col-lg-8 m-auto">
                    <div class="success_box text-center">
                         <i class="fa-solid fa-check"></i>
                         @if (session('order'))
                              <h3>{{session('order')}}</h3>
                         @endif
                         <p>Thank you for choosing our product. Your order has been successfully processed and confirmed. We appreciate your
                         business and are excited to have you as our valued customer.</p>
                         <a href="{{route('frontend')}}">Back To Home</a>
                    </div>
               </div>
          </div>
     </div>
</section>
<!-- Success HTML End -->
@endsection