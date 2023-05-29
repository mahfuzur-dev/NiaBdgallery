@extends('layouts.dashboard')
@section('content')
     <div class="row">
          <div class="col-12">
               <div class="page-title-box">
                    <h4 class="page-title float-left">Product</h4>

                    <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Product</a></li>
                    <li class="breadcrumb-item active">Edit Product</li>
                    </ol>

                    <div class="clearfix"></div>
               </div>
          </div>
     </div>
     <div class="row">
          <div class="col-lg-12">
               <div class="card">
                    <div class="card-header bg-dark mb-3">
                         <h3 class="text-white">Edit Product</h3>
                    </div>
                    <div class="card-body p-4">
                         <form action="{{route('update.product')}}" method="POST" enctype="multipart/form-data">
                              @csrf
                              <div class="row">
                                   <div class="col-lg-6">
                                        <div class="mb-3">
                                             <label for="category_id">Category *</label>
                                             <input type="text" readonly name="category_id" id="category_id" class="form-control" value="{{$all_products->rel_to_category->category_name}}">
                                             <label for="category_id">Category *</label>
                                             <input type="hidden"  name="product_id" id="product_id" class="form-control" value="{{$all_products->id}}">
                                        </div>
                                   </div>
                                   <div class="col-lg-6">
                                        <div class="mb-3">
                                             <label for="subcategory_id">SubCategory</label>
                                             <input type="text" readonly name="subcategory_id" id="subcategory_id" class="form-control" value="{{$all_products->rel_to_subcategory->subcategory_name}}">
                                        </div>
                                   </div>
                                   <div class="col-lg-6">
                                        <div class="mb-3">
                                             <label for="product_name">Product Name *</label>
                                             <input type="text" class="form-control" name="product_name" value="{{$all_products->product_name}}">
                                        </div>
                                   </div>
                                   <div class="col-lg-3">
                                        <div class="mb-3">
                                             <label for="product_name">Product Price *</label>
                                             <input type="number" class="form-control" name="price" value="{{$all_products->price}}">
                                        </div>
                                   </div>
                                   <div class="col-lg-3">
                                        <div class="mb-3">
                                             <label for="brand">Brand</label>
                                             <input type="text" class="form-control" name="brand" value="{{$all_products->brand}}">
                                        </div>
                                   </div>
                                   <div class="col-lg-3">
                                        <div class="mb-3">
                                             <label for="discount">Discount</label>
                                             <input type="number" class="form-control" name="discount" value="{{$all_products->discount}}">
                                        </div>
                                   </div>
                                   <div class="col-lg-9 ">
                                        <div class="mb-3">
                                             <label for="short_desp">Short Description *</label>
                                             <input type="text" class="form-control" name="short_desp" value="{{$all_products->short_desp}}">
                                        </div>
                                   </div>
                                   <div class="col-lg-6">
                                        <div class="mb-3">
                                             <label for="preview">Preview *</label>
                                             <input type="file" class="form-control" name="preview" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                                        </div>
                                        <div class="mb-3">
                                             <img src="{{asset('uploads/product/preview')}}/{{$all_products->preview}}" id="blah" alt="your image" width="100" height="100" />
                                        </div>
                                   </div>
                                   <div class="col-lg-6">
                                        <div class="mb-3">
                                             <label for="thumbnail">Thumbnail *</label>
                                             <input type="file" multiple class="form-control" name="thumbnail[]">
                                        </div>
                                   </div>
                                   <div class="col-lg-12">
                                        <div class="mb-3 mt-3 text-center">
                                             <button type="submit" class="btn btn-success">Update</button>
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