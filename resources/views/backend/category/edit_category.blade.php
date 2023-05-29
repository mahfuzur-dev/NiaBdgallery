@extends('layouts.dashboard')
@section('content')
     <div class="row">
          <div class="col-12">
               <div class="page-title-box">
                    <h4 class="page-title float-left">Category Page</h4>

                    <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Cateogory</a></li>
                    <li class="breadcrumb-item active">Edit Category</li>
                    </ol>

                    <div class="clearfix"></div>
               </div>
          </div>
     </div>
     <div class="row">
          <div class="col-lg-6 m-auto">
               <div class="card">
                    <div class="card-header bg-info mb-2">
                         <h3 class="text-white">Edit Category</h3>
                    </div>
                    @if (session('category_add'))
                         <div class="alert alert-success">{{session('category_add')}}</div>
                    @endif
                    <div class="card-bory p-3">
                         <form action="{{route('update.category')}}" method="POST" enctype="multipart/form-data">
                              @csrf
                              <div class="mb-3">
                                   <label for="category_name">Category Name *</label>
                                   <input type="hidden" name="category_id" value="{{$all_categories->id}}">
                                   <input type="text" name="category_name" class="form-control" id="category_name" value="{{$all_categories->category_name}}">
                              </div>
                              <div class="mb-3">
                                   <label for="category_image">Category Image</label>
                                   <input type="file" name="category_image" class="form-control" id="category_image" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                              </div>
                              <div class="mb-3">
                                   <img src="{{asset('uploads/category')}}/{{$all_categories->category_image}}" id="blah" alt="category_image" width="100" height="100" />
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