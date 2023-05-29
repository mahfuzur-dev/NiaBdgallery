@extends('layouts.dashboard')
@section('content')
        <div class="row">
          <div class="col-12">
               <div class="page-title-box">
                    <h4 class="page-title float-left">Order Page</h4>

                    <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Order</a></li>
                    </ol>

                    <div class="clearfix"></div>
               </div>
          </div>
     </div>
     <div class="row">
          <div class="col-12">
               <div class="card">
                    <div class="card-header">
                         <h3>Order List</h3>
                    </div>
                    <div class="card-body m-3">
                         <table class="table table-colored-bordered table-bordered-custom">
                              <tr class="bg-info text-white">
                                   <th>Sl No</th>
                                   <th>Order Id</th>
                                   <th>Subtotal</th>
                                   <th>Discount</th>
                                   <th>Delivery</th>
                                   <th>Total</th>
                                   <th>Status</th>
                                   <th>Action</th>
                              </tr>
                              @foreach ($all_orders as $key=>$order)
                                   <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$order->id}}</td>
                                        <td>{{$order->subtotal}}</td>
                                        <td>{{$order->discount}}</td>
                                        <td>{{$order->delivery}}</td>
                                        <td>{{$order->total}}</td>
                                        <td>
                                             @php
                                             if($order->status == 1){
                                                  echo '<span class="label label-table label-info">Placed</span>';
                                             }
                                             elseif($order->status == 2){
                                                  echo '<span class="label label-table label-primary">Processing</span>';
                                             }
                                             elseif($order->status == 3){
                                                  echo '<span class="label label-table label-inverse">Ready To Deliver</span>';
                                             }
                                             elseif($order->status == 4){
                                                  echo '<span class="label label-table label-success">Delivery</span>';
                                             }
                                             elseif($order->status == 5){
                                                  echo '<span class="label label-table label-danger">Cancel</span>';
                                             }
                                             else {
                                                  echo 'Unknown';
                                             }
                                        @endphp
                                        </td>
                                        <td>
                                             <div class="dropdown">
                                                  <form action="{{route('order.status')}}" method="POST">
                                                       @csrf
                                                       <button type="button" class="btn" data-toggle="dropdown">
                                                            <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
                                                       </button>
                                                       <div class="dropdown-menu">
                                                            <button class="dropdown-item status" name="status" value="{{$order->id.','.'1'}}">Placed</button>
                                                            <button class="dropdown-item status" name="status" value="{{$order->id.','.'2'}}">Processing</button>
                                                            <button class="dropdown-item status" name="status" value="{{$order->id.','.'3'}}">Ready To Deliver</button>
                                                            <button class="dropdown-item status" name="status" value="{{$order->id.','.'4'}}">Delivery</button>
                                                            <button class="dropdown-item status" name="status" value="{{$order->id.','.'5'}}">Cancel</button>
                                                       </div>
                                                  
                                                  </form>
                                             </div>
                                        </td>
                                   </tr>
                              @endforeach
                         </table>
                    </div>
               </div>
          </div>
     </div>
@endsection