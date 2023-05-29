@extends('layouts.dashboard')
@section('content')
     <div class="row">
          <div class="col-12">
               <div class="page-title-box">
                    <h4 class="page-title float-left">SubCategory Page</h4>

                    <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">SubCateogory</a></li>
                    <li class="breadcrumb-item active">Add SubCategory</li>
                    </ol>

                    <div class="clearfix"></div>
               </div>
          </div>
     </div>
     <div class="row">
          <div class="col-lg-6 m-auto">
               <div class="card">
                    <div class="card-header bg-info mb-2">
                         <h3 class="text-white">Add SubCategory</h3>
                    </div>
                    @if (session('subcategory_add'))
                         <div class="alert alert-success">{{session('subcategory_add')}}</div>
                    @endif
                    <div class="card-bory p-3">
                         <form action="{{route('add.subcategory')}}" method="POST">
                              @csrf
                              <div class="mb-3">
                                   <label for="category_name">Category Name *</label>
                                   <select class="form-control" name="category_id" id="category_name">
                                        <option value="" selected>--Select Category --</option>
                                        @foreach ($all_category as $category)
                                             <option value="{{$category->id}}">{{$category->category_name}}</option>
                                        @endforeach
                                   </select>
                                   @error('category_id')
                                        <strong class="text-danger">{{$message}}</strong>
                                   @enderror
                              </div>
                              <div class="mb-3">
                                   <label for="subcategory_name">SubCategory Name *</label>
                                   <input type="text" name="subcategory_name" class="form-control" id="subcategory_name">
                                   @error('subcategory_name')
                                        <strong class="text-danger">{{$message}}</strong>
                                   @enderror
                              </div>
                              <div class="mb-3">
                                   <button type="submit" class="btn btn-success">Submit</button>
                              </div>
                         </form>
                    </div>
               </div>
          </div>
     </div>
@endsection