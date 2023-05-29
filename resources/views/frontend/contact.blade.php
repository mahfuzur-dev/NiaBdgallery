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
                              <li class="breadcrumb-item active" aria-current="page">Contact</li>
                         </ol>
                    </div>
               </div>
          </div>
     </div>
</section>
<!-- BreadCrumb HTML End -->
<!-- Contact HTML Start -->
<section id="contact_details">
     <div class="container">
          <div class="row">
               <div class="col-lg-6">
                    <div class="maps">
                         <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d29207.630527734542!2d90.38882123915545!3d23.78465888507212!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c7bd92b5fe8f%3A0x930815d7bdffdd30!2sNorth%20Badda%2C%20Dhaka%201212!5e0!3m2!1sen!2sbd!4v1684602986407!5m2!1sen!2sbd"
                                   style="border:0;" allowfullscreen="" loading="lazy"
                              referrerpolicy="no-referrer-when-downgrade">
                         </iframe>
                    </div>
               </div>
               <div class="col-lg-6">
                    <div class="contact_info_touch">
                         <h3>Get In Touch</h3>
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
                                                  <input type="text" name="name" placeholder="Enter Your Name" class="form-control">
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
                                                  <input type="email" name="email" placeholder="Enter Your Email" class="form-control">
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
                                                  <input type="number" name="mobile" placeholder="Enter Your Mobile" class="form-control">
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
                                                  <input type="text" name="address" placeholder="Enter Your Address" class="form-control">
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
                                   <div class="col-lg-8">
                                        <div class="submit">
                                             <button type="submit">Send Message</button>
                                        </div>
                                   </div>
                              </div>
                         </form>
                    </div>
               </div>
          </div>
     </div>
</section>
<!-- Contact HTML End -->
@endsection