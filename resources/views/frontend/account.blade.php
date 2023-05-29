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
                              <li class="breadcrumb-item active" aria-current="page">Account</li>
                         </ol>
                    </div>
               </div>
          </div>
     </div>
</section>
<!-- BreadCrumb HTML End -->
<!-- Account HTML Start -->
<section id="account">
     <div class="container">
          <div class="row">
               <div class="col-lg-3">
                    <div class="account_tab">
                         <button class="tablinks active" onclick="account(event, 'dashboard')">Dashboard</button>
                         <button class="tablinks" onclick="account(event, 'accounts')">Account</button>
                         <button class="tablinks" onclick="account(event, 'order')">My Orders</button>
                    </div>
               </div>
               <div class="col-lg-9">
                    <div id="dashboard" class="tabcontent" style="display: block;">
                         <div class="dashboar_box">
                              <h3>Welcome To Dashboard</h3>
                         </div>
                    </div>
                    
                    <div id="accounts" class="tabcontent">
                         <div class="account_box">
                              <h3>Account Details</h3>
                              <div class="row">
                                   <div class="col-lg-6">
                                        <form action="{{route('account.info.update')}}" method="POST">
                                             @csrf
                                             <div class="mb-3">
                                                  <label for="name">Name <span>*</span></label>
                                                  <input type="text" name="name" value="{{$all_info->first()->name}}" placeholder="Enter Your Name" id="name" class="form-control">
                                             </div>
                                             <div class="mb-3">
                                                  <label for="email">Email <span>*</span></label>
                                                  <input type="email" name="email" value="{{$all_info->first()->email}}" placeholder="Enter Your Email" id="email" class="form-control">
                                             </div>
                                             <div class="mb-3">
                                                  <button type="submit">Update</button>
                                             </div>
                                        </form>
                                   </div>
                                   
                                   <div class="col-lg-6">
                                        @if (session('pass_success'))
                                        <div class="alert alert-success">{{session('pass_success')}}</div>
                                        @endif
                                        @if (session('wrong'))
                                             <div class="alert alert-danger">{{session('wrong')}}</div>
                                        @endif
                                        <div class="password">
                                             <h4>Change Password</h4>
                                             <form action="{{route('account.password.change')}}" method="POST">
                                                  @csrf
                                                  <div class="mb-3">
                                                       <label for="old_pass">Old Password <span>*</span></label>
                                                       <input type="password" name="old_password" placeholder="Enter Your New Password" id="old_pass" class="form-control">
                                                       <i class="fa-regular fa-eye-slash" id="toggleoldPassword"></i>
                                                  </div>
                                                  @error('old_password')
                                                       <strong class="text-danger">{{$message}}</strong>
                                                  @enderror
                                                  <div class="mb-3">
                                                       <label for="new_password">New Password <span>*</span></label>
                                                       <input type="password" name="new_password" placeholder="Enter Your New Password" id="new_password" class="form-control">
                                                       <i class="fa-regular fa-eye-slash" id="togglenewPassword"></i>
                                                  </div>
                                                  @error('new_password')
                                                       <strong class="text-danger">{{$message}}</strong>
                                                  @enderror
                                                  <div class="mb-3">
                                                       <button type="submit">Update</button>
                                                  </div>
                                             </form>
                                        </div>
                                   </div>
                              </div>
                              
                         </div>
                    </div>
                    <div id="order" class="tabcontent m-auto">
                         <div class="order_box text-center">
                              <h3>Your Orders</h3>
                              <div class="order_table">
                                   <table class="table table-bordered">
                                        <tr>
                                             <th>Sl No</th>
                                             <th>Order Id</th>
                                             <th>Sub Total</th>
                                             <th>Discount</th>
                                             <th>Delivery Charge</th>
                                             <th>Total</th>
                                             <th>Order Status</th>
                                             <th>Invoice</th>
                                        </tr>
                                        @foreach ($all_orders as $key=>$order)
                                             
                                             <tr>
                                                  <td>{{$key+1}}</td>
                                                  <td>#{{$order->created_at->format('dmy')}}.{{$order->id}}</td>
                                                  <td>&#2547 {{$order->subtotal}}</td>
                                                  <td>&#2547 {{$order->discount}}</td>
                                                  <td>&#2547 {{$order->delivery}}</td>
                                                  <td>&#2547 {{$order->total}}</td>
                                                  <td>
                                                       @php
                                                            if($order->status == 1){
                                                                 echo '<span class="badge text-bg-info">Placed</span>';
                                                            }
                                                            elseif($order->status == 2){
                                                                 echo '<span class="badge text-bg-primary">Processing</span>';
                                                            }
                                                            elseif($order->status == 3){
                                                                 echo '<span class="badge text-bg-warning">Ready To Deliver</span>';
                                                            }
                                                            elseif($order->status == 4){
                                                                 echo '<span class="badge text-bg-success">Delivery</span>';
                                                            }
                                                            elseif($order->status == 5){
                                                                 echo '<span class="badge text-bg-danger">Cancel</span>';
                                                            }
                                                            else {
                                                                 echo 'Unknown';
                                                            }
                                                       @endphp
                                                  </td>
                                                  <td><a href="{{route('customer.invoice',$order->id)}}"><i class="fa-solid fa-download"></i> Download</a></td>
                                             </tr>
                                        
                                        @endforeach
                                   </table>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</section>
<!-- Account HTML End -->
@endsection