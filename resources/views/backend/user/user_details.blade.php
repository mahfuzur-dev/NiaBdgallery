@extends('layouts.dashboard')
@section('content')
     <div class="row" style="border-bottom: 1px solid #ddd">
          <div class="col-lg-6 mt-1">
               <h3 class="text-info">User Details</h3>
          </div>
          <div class="col-lg-6 text-right mt-3">
               <a href="{{route('home')}}" class="btn btn-info">Back To Home</a>
          </div>
     </div>
     <div class="row">
          <div class="col-lg-3">
               <div class="card mt-3">
                    <div class="card-header">
                         <h5>User Photo</h5>
                    </div>
                    <div class="card-body">
                         <div class="card-img my-3 text-center">
                              <img style="border-radius: 50%;width: 100px; height:100px;" src="{{asset('uploads/user')}}/{{Auth::user()->profile_photo}}" class="img-fluid" alt="">
                         </div>
                         <div class="submit mb-1 text-center">
                              <a href="{{route('user.profile.edit',Auth::user()->id)}}" class="btn btn-info py-2 w-100">Change</a>
                         </div>
                    </div>
               </div>
          </div>
          <div class="col-lg-9">
              <div class="card mt-3">
                     <form action="{{route('update.info.user')}}" method="POST">
                         @csrf
                         <div class="row">
                              <div class="col-lg-4">
                                   <div class="mb-1 p-3">
                                        <label for="name">Name *</label>
                                        <input type="text" name="name" class="form-control" value="{{Auth::user()->name}}">
                                   </div>
                              </div>
                              <div class="col-lg-4">
                                   <div class="mb-1 p-3">
                                        <label for="email">Email *</label>
                                        <input type="text" name="email" class="form-control" value="{{Auth::user()->email}}">
                                   </div>
                              </div>
                              <div class="col-lg-4">
                                   <div class="mb-1 p-3">
                                        <label for="gender">Gender</label>
                                        <select name="gender" class="form-control" id="gender">
                                             <option value="1" selected>Male</option>
                                             <option value="2">Female</option>
                                        </select>
                                   </div>
                              </div>
                              <div class="col-lg-4">
                                   <div class="mb-1 p-3">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control" placeholder="Enter Your Address" name="address" value="{{Auth::user()->address}}">
                                   </div>
                              </div>
                              <div class="col-lg-4">
                                   <div class="mb-1 p-3">
                                        <label for="mobile">Mobile</label>
                                        <input type="number" class="form-control" placeholder="Enter Your Mobile No" name="mobile" value="{{Auth::user()->mobile}}">
                                   </div>
                              </div>
                              <div class="col-lg-4">
                                   <div class="mb-1 p-3">
                                        <label for="birth">Date of Birth</label>
                                        <input type="date" class="form-control" name="birth" value="{{Auth::user()->birth}}">
                                   </div>
                              </div>
                              <div class="col-lg-4">
                                   <div class="mb-2 p-3">
                                        <button type="submit" class="btn btn-success">Save</button>
                                   </div>
                              </div>
                         </div>
                    </form>
              </div>
          </div>
     </div>
@endsection