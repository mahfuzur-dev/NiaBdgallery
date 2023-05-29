@extends('layouts.dashboard')
@section('content')
     <div class="row">
          <div class="col-12">
               <div class="page-title-box">
                    <h4 class="page-title float-left">Category Page</h4>

                    <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Cateogory</a></li>
                    <li class="breadcrumb-item active">Add Category</li>
                    </ol>

                    <div class="clearfix"></div>
               </div>
          </div>
     </div>
     <div class="row">
          <div class="col-lg-6 m-auto">
               <div class="card">
                    <div class="card-header bg-info mb-2">
                         <h3 class="text-white">Add Category</h3>
                    </div>
                    @if (session('category_add'))
                         <div class="alert alert-success">{{session('category_add')}}</div>
                    @endif
                    <div class="card-bory p-3">
                         <form action="{{route('submit.category')}}" method="POST" enctype="multipart/form-data">
                              @csrf
                              <div class="mb-3">
                                   <label for="category_name">Category Name *</label>
                                   <input type="text" name="category_name" class="form-control" id="category_name">
                                   @error('category_name')
                                        <strong class="text-danger">{{$message}}</strong>
                                   @enderror
                              </div>
                              <div class="mb-3">
                                   <label for="category_image">Category Image</label>
                                   <input type="file" name="category_image" class="form-control" id="category_image">
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