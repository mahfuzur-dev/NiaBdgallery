@extends('layouts.dashboard')
@section('content')
     <div class="row">
          <div class="col-12">
               <div class="page-title-box">
                    <h4 class="page-title float-left">Inventory Page</h4>

                    <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Product</a></li>
                    <li class="breadcrumb-item active">Inventory</li>
                    </ol>

                    <div class="clearfix"></div>
               </div>
          </div>
     </div>
     <div class="row">
          <div class="col-lg-8">
               <div class="card-box">
                    @if (session('delete_inventory'))
                         <div class="alert alert-warning">{{session('delete_inventory')}}</div>
                    @endif
                    <div class="row">
                    <div class="col-sm-6">
                         <div class="m-b-30">
                              <a href="{{route('subcategory')}}" id="addToTable" class="btn btn-success waves-effect waves-light">Add<i class="mdi mdi-plus-circle-outline"></i></a>
                         </div>
                    </div>
                    </div>

                    <div id="datatable-editable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                         <div class="row">
                    <table class="table table-striped add-edit-table dataTable no-footer" id="datatable-editable" role="grid" aria-describedby="datatable-editable_info">
                    <thead>
                    <tr role="row">
                         <th class="sorting_asc" tabindex="0" aria-controls="datatable-editable" rowspan="1" colspan="1" style="width: 110px;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Sl No</th>
                         <th class="sorting" tabindex="0" aria-controls="datatable-editable" rowspan="1" colspan="1" style="width: 245px;" aria-label="Browser: activate to sort column ascending">Product Name</th>
                         <th class="sorting" tabindex="0" aria-controls="datatable-editable" rowspan="1" colspan="1" style="width: 265px;" aria-label="Browser: activate to sort column ascending">Color Name</th>
                         <th class="sorting" tabindex="0" aria-controls="datatable-editable" rowspan="1" colspan="1" style="width: 265px;" aria-label="Browser: activate to sort column ascending">Size Name</th>
                         <th class="sorting" tabindex="0" aria-controls="datatable-editable" rowspan="1" colspan="1" style="width: 200px;" aria-label="Browser: activate to sort column ascending">Quantity</th>
                         <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 220px;" aria-label="Actions">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                         @foreach ($all_inventories as $key=>$inventory)
                              <tr class="gradeA odd" role="row">
                                   <td class="sorting_1">{{$key+1}}</td>
                                   <td>{{$inventory->rel_to_product->product_name}}</td>
                                   <td>{{$inventory->rel_to_color->color_name}}</td>
                                   <td>{{$inventory->rel_to_size->size_name}}</td>
                                   <td>{{$inventory->quantity}}</td>
                                   <td class="actions">
                                        <a href="{{route('delete.inventory',$inventory->id)}}" class="on-default remove-row" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
                                   </td>
                              </tr>
                         @endforeach
               </tbody>
                    </table>
               </div>
          </div>
          </div>
          
     </div>
          <div class="col-lg-4">
               <div class="card">
                    <div class="card-header bg-info">
                         <h5 class="text-white">Add Inventory</h5>
                    </div>
                    <div class="card-body p-3">
                         <form action="{{route('add.inventory')}}" method="POST">
                              @csrf
                              <div class="mb-3">
                                   <label for="product_id">Product Name</label>
                                   <input type="hidden" class="form-control" name="product_id" value="{{$all_products->id}}">
                                   <input type="text" readonly class="form-control" value="{{$all_products->product_name}}">
                              </div>
                              <div class="mb-3">
                                   <label for="color_id">Color Name</label>
                                   <select name="color_id" class="form-control">
                                        <option value=""> ---- Select Color ---- </option>
                                        @foreach ($all_colors as $color)
                                             <option value="{{$color->id}}">{{$color->color_name}}</option>
                                        @endforeach
                                   </select>
                                   @error('color_id')
                                        <strong class="text-danger">{{$message}}</strong>
                                   @enderror
                              </div>
                              <div class="mb-3">
                                   <label for="size_id">Size</label>
                                   <select name="size_id" class="form-control">
                                        <option value=""> ---- Select Size ---- </option>
                                        @foreach ($all_sizes as $size)
                                             <option value="{{$size->id}}">{{$size->size_name}}</option>
                                        @endforeach
                                   </select>
                                   @error('size_id')
                                        <strong class="text-danger">{{$message}}</strong>
                                   @enderror
                              </div>
                              <div class="mb-3">
                                   <label for="quantity">Quantity</label>
                                   <input type="number" class="form-control" name="quantity">
                                   @error('quantity')
                                        <strong class="text-danger">{{$message}}</strong>
                                   @enderror
                              </div>
                              <div class="mb-3">
                                   <button type="submit" class="btn btn-success">Submit</button>
                              </div>
                         </form>
                         @if (session('add_inventory'))
                              <strong class="alert alert-success">{{session('add_inventory')}}</strong>
                         @endif
                    </div>
               </div>
          </div>
@endsection