@extends('layouts.dashboard')
@section('content')
     <div class="row">
          <div class="col-12">
               <div class="page-title-box">
                    <h4 class="page-title float-left">SubCategory Page</h4>

                    <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">SubCateogory</a></li>
                    <li class="breadcrumb-item active">Edit SubCategory</li>
                    </ol>

                    <div class="clearfix"></div>
               </div>
          </div>
     </div>
     <div class="row">
          <div class="col-lg-6 m-auto">
               <div class="card">
                    <div class="card-header bg-info mb-2">
                         <h3 class="text-white">Edit SubCategory</h3>
                    </div>
                    <div class="card-bory p-3">
                         <form action="{{route('update.subcategory')}}" method="POST">
                              @csrf
                              <div class="mb-3">
                                   <label for="category_name">Category Name</label>
                                   <input type="hidden" name="subcategory_id" value="{{$all_sub_info->id}}">
                                   <input class="form-control" type="text" readonly value="{{$all_sub_info->rel_to_category->category_name}}">
                              </div>
                              <div class="mb-3">
                                   <label for="subcategory_name">SubCategory Name</label>
                                   <input type="text" name="subcategory_name" class="form-control" id="subcategory_name" value="{{$all_sub_info->subcategory_name}}">
                              </div>
                              <div class="mb-3">
                                   <button type="submit" class="btn btn-success">Update</button>
                              </div>
                         </form>
                    </div>
               </div>
          </div>
     </div>
@endsection