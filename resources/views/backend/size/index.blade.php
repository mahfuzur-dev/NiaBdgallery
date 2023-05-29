@extends('layouts.dashboard')
@section('content')
     <div class="row">
          <div class="col-12">
               <div class="page-title-box">
                    <h4 class="page-title float-left">Size Page</h4>

                    <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Size</a></li>
                    <li class="breadcrumb-item active">Add Size</li>
                    </ol>

                    <div class="clearfix"></div>
               </div>
          </div>
     </div>
     <div class="row">
          <div class="col-lg-8">
               <div class="col-sm-12">
                    <div class="card-box">
                         @if (session('delete_size'))
                              <div class="alert alert-danger">{{session('delete_size')}}</div>
                         @endif
                         <div id="datatable-editable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                              <div class="row">
                                   <table class="table table-striped add-edit-table dataTable no-footer" id="datatable-editable" role="grid"          aria-describedby="datatable-editable_info">
                                        <thead>
                                             <tr role="row">
                                                  <th class="sorting_asc" tabindex="0" aria-controls="datatable-editable" rowspan="1" colspan="1" style="width: 110px;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Sl No</th>
                                                  <th class="sorting" tabindex="0" aria-controls="datatable-editable" rowspan="1" colspan="1" style="width: 245px;" aria-label="Browser: activate to sort column ascending">Size Name</th>
                                                  <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 164px;" aria-label="Actions">Actions</th>
                                             </tr>
                                        </thead>
                                        <tbody>
                                             @foreach ($all_sizes as $key=>$size)
                                                  
                                             <tr class="gradeA odd" role="row">
                                                  <td class="sorting_1">{{$key+1}}</td>
                                                  <td>{{$size->size_name}}</td>
                                                  <td class="actions">
                                                       <a href="{{route('delete.size',$size->id)}}" class="on-default remove-row" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
                                                  </td>
                                             </tr>
                                             @endforeach
                                        </tbody>
                                   </table>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
          <div class="col-lg-4">
               <div class="card">
                    <div class="card-header bg-info">
                         <h3 class="text-white">Add Size</h3>
                    </div>
                    <div class="card-body p-3">
                         <form action="{{route('add.size')}}" method="POST">
                              @csrf
                              <div class="mb-3">
                                   <label for="size_name">Size Name *</label>
                                   <input type="text" id="size_name" class="form-control" name="size_name">
                                   @error('size_name')
                                        <strong class="text-danger">{{$message}}</strong>
                                   @enderror
                              </div>
                              <div class="mb-3">
                                   <button type="submit" class="btn btn-success">Submit</button>
                              </div>
                         </form>
                         @if (session('add_size'))
                              <div class="alert alert-success">{{session('add_size')}}</div>
                         @endif
                    </div>
               </div>
          </div>
     </div>
@endsection