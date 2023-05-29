@extends('layouts.dashboard')
@section('content')
     <div class="row">
          <div class="col-12">
               <div class="page-title-box">
                    <h4 class="page-title float-left">Product</h4>

                    <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Product</a></li>
                    <li class="breadcrumb-item active">Add Product</li>
                    </ol>

                    <div class="clearfix"></div>
               </div>
          </div>
     </div>
     <div class="row">
          <div class="col-lg-12">
               <div class="card">
                    <div class="card-header bg-dark mb-3">
                         <h3 class="text-white">Add Product</h3>
                    </div>
                    @if (session('add_product'))
                         <div class="alert alert-success">{{session('add_product')}}</div>
                    @endif
                    <div class="card-body p-4">
                         <form action="{{route('add.product')}}" method="POST" enctype="multipart/form-data">
                              @csrf
                              <div class="row">
                                   <div class="col-lg-6">
                                        <div class="mb-3">
                                             <label for="category_id">Category *</label>
                                             <select name="category_id" id="category_id" class="form-control">
                                                  <option value="" selected>-- Select Category --</option>
                                                  @foreach ($all_categories as $category)
                                                       <option value="{{$category->id}}">{{$category->category_name}}</option>
                                                  @endforeach
                                             </select>
                                             @error('category_id')
                                                  <strong class="text-danger">{{$message}}</strong>
                                             @enderror
                                        </div>
                                   </div>
                                   <div class="col-lg-6">
                                        <div class="mb-3">
                                             <label for="subcategory_id">SubCategory</label>
                                             <select name="subcategory_id" id="subcategory_id" class="form-control">
                                                  <option value="" selected>-- Select SubCategory --</option>
                                                  
                                             </select>
                                        </div>
                                   </div>
                                   <div class="col-lg-6">
                                        <div class="mb-3">
                                             <label for="product_name">Product Name *</label>
                                             <input type="text" class="form-control" name="product_name">
                                             @error('product_name')
                                                  <strong class="text-danger">{{$message}}</strong>
                                             @enderror
                                        </div>
                                   </div>
                                   <div class="col-lg-3">
                                        <div class="mb-3">
                                             <label for="product_name">Product Price *</label>
                                             <input type="number" class="form-control" name="price">
                                             @error('price')
                                                  <strong class="text-danger">{{$message}}</strong>
                                             @enderror
                                        </div>
                                   </div>
                                   <div class="col-lg-3">
                                        <div class="mb-3">
                                             <label for="brand">Brand</label>
                                             <input type="text" class="form-control" name="brand">
                                        </div>
                                   </div>
                                   <div class="col-lg-3">
                                        <div class="mb-3">
                                             <label for="discount">Discount</label>
                                             <input type="number" class="form-control" name="discount" value="0">
                                        </div>
                                   </div>
                                   <div class="col-lg-9 ">
                                        <div class="mb-3">
                                             <label for="short_desp">Short Description *</label>
                                             <input type="text" class="form-control" name="short_desp">
                                             @error('short_desp')
                                                  <strong class="text-danger">{{$message}}</strong>
                                             @enderror
                                        </div>
                                   </div>
                                   <div class="col-lg-12 ">
                                        <div class="mb-3">
                                             <label for="desp">Description *</label>
                                             <textarea type="text" id="summernote" class="form-control" name="description"></textarea>
                                             @error('description')
                                                  <strong class="text-danger">{{$message}}</strong>
                                             @enderror
                                        </div>
                                   </div>
                                   <div class="col-lg-6">
                                        <div class="mb-3">
                                             <label for="preview">Preview *</label>
                                             <input type="file" class="form-control" name="preview">
                                             @error('preview')
                                                  <strong class="text-danger">{{$message}}</strong>
                                             @enderror
                                        </div>
                                   </div>
                                   <div class="col-lg-6">
                                        <div class="mb-3">
                                             <label for="thumbnail">Thumbnail *</label>
                                             <input type="file" multiple class="form-control" name="thumbnail[]">
                                             @error('thumbnail')
                                                  <strong class="text-danger">{{$message}}</strong>
                                             @enderror
                                        </div>
                                   </div>
                                   <div class="col-lg-12">
                                        <div class="mb-3 mt-3 text-center">
                                             <button type="submit" class="btn btn-success">Submit</button>
                                        </div>
                                   </div>
                              </div>
                         </form>
                    </div>
               </div>
          </div>
     </div>
@endsection
@section('footer_script')
     <script>
          $(document).ready(function() {
               $('#summernote').summernote();
          });
     </script>
     <script>
          $('#category_id').change(function(){
               var category_id = $(this).val();

               $.ajaxSetup({
                    headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
               });
               $.ajax({
                    type:'POST',
                    url:'/getsubcategory',
                    data:{'category_id':category_id},
                    success:function(data){
                         $("#subcategory_id").html(data);
                    }
               })
          });
     </script>
@endsection