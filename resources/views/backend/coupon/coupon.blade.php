@extends('layouts.dashboard')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title float-left">Coupon</h4>

                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Coupon</a></li>
                    <li class="breadcrumb-item active">Add Coupon</li>
                </ol>

                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
          <div class="card">
               <div class="card-header">
                    <h3>Cart Table</h3>
               </div>
               <div class="card-body p-4">
                    <table class="table table-striped table-hover">
                         <tr>
                              <th>Sl No</th>
                              <th>Coupon Name</th>
                              <th>Coupon Type</th>
                              <th>Amount</th>
                              <th>Validity</th>
                              <th>Action</th>
                         </tr>
                         @foreach ($all_coupons as $key=>$coupon)
                              <tr>
                                   <td>{{$key+1}}</td>
                                   <td>{{$coupon->coupon_name}}</td>
                                   <td>{{$coupon->coupon_type == 1?'Solid Amount':'Percentage'}}</td>
                                   <td>{{$coupon->amount}}</td>
                                   <td>{{$coupon->validity}}</td>
                                   <td class="actions">
                                        <a href="#" class="on-default edit-row" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                                        <a href="{{route('delete.coupon',$coupon->id)}}" class="on-default remove-row" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
                                   </td>
                              </tr>
                         @endforeach
                    </table>
               </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="card">
               <div class="card-header">
                    <h3>Add Coupon</h3>
               </div>
               @if (session('coupon'))
                    <div class="alert alert-success">{{session('coupon')}}</div>
               @endif
               <div class="card-body p-3">
                    <form action="{{route('add.coupon')}}" method="POST">
                         @csrf
                         <div class="mb-3">
                              <label for="coupon_code" class="form-label">Coupon Code</label>
                              <input type="text" id="coupon_code" name="coupon_name" class="form-control">
                              @error('coupon_name')
                                   <strong class="text-danger">{{$message}}</strong>
                              @enderror
                         </div>
                         <div class="mb-3">
                              <label for="coupon_type" class="form-label">Coupon Type</label>
                              <select name="coupon_type" id="coupon_type" class="form-control">
                                   <option value="1">Solid Amount</option>
                                   <option value="2">Percentage</option>
                              </select>
                              @error('coupon_type')
                                   <strong class="text-danger">{{$message}}</strong>
                              @enderror
                         </div>
                         <div class="mb-3">
                              <label for="amount" class="form-label">Amount</label>
                              <input type="number" id="amount" name="amount" class="form-control">
                              @error('amout')
                                   <strong class="text-danger">{{$message}}</strong>
                              @enderror
                         </div>
                         <div class="mb-3">
                              <label for="validity" class="form-label">Validity</label>
                              <input type="date" id="validity" name="validity" class="form-control">
                              @error('validity')
                                   <strong class="text-danger">{{$message}}</strong>
                              @enderror
                         </div>
                         <div class="mb-3">
                              <button type="sumbit" class="btn btn-success">Submit</button>
                         </div>
                    </form>
               </div>
          </div>
        </div>
    </div>
@endsection
