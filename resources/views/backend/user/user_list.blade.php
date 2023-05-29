@extends('layouts.dashboard')
@section('content')
    <div class="row">
          <div class="col-sm-12 mt-3">
               <div class="card-box">
                    <div class="row">
                    <div class="col-sm-6">
                         <div class="m-b-30">
                              <button id="addToTable" class="btn btn-success waves-effect waves-light">Add <i class="mdi mdi-plus-circle-outline"></i></button>
                         </div>
                    </div>
                    </div>

                    <div id="datatable-editable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                         <div class="row">
                         <table class="table table-striped add-edit-table dataTable no-footer" id="datatable-editable" role="grid" aria-describedby="datatable-editable_info">
                    <thead>
                    <tr role="row">
                         <th class="sorting_asc" tabindex="0" aria-controls="datatable-editable" rowspan="1" colspan="1" style="width: 110px;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Sl No</th>
                         <th class="sorting" tabindex="0" aria-controls="datatable-editable" rowspan="1" colspan="1" style="width: 245px;" aria-label="Browser: activate to sort column ascending">Name</th>
                         <th class="sorting" tabindex="0" aria-controls="datatable-editable" rowspan="1" colspan="1" style="width: 265px;" aria-label="Browser: activate to sort column ascending">Email</th>
                         <th class="sorting" tabindex="0" aria-controls="datatable-editable" rowspan="1" colspan="1" style="width: 231px;" aria-label="Platform(s): activate to sort column ascending">Address</th>
                         <th class="sorting" tabindex="0" aria-controls="datatable-editable" rowspan="1" colspan="1" style="width: 231px;" aria-label="Platform(s): activate to sort column ascending">Phone Number</th>
                         <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 164px;" aria-label="Actions">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                         @foreach ($all_users as $key=>$user)
                              
                         <tr class="gradeA odd" role="row">
                              <td class="sorting_1">{{$key+1}}</td>
                              <td>{{$user->name}}</td>
                              <td>{{$user->Email}}</td>
                              <td>{{$user->address}}</td>
                              <td>{{$user->mobile}}</td>
                              <td class="actions">
                                   <a href="{{route('user.delete',$user->id)}}" class="on-default remove-row" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
                              </td>
                         </tr>
                         @endforeach
               </tbody>
                    </table>
               </div>
          </div>
          <div class="row">
               <div class="col-sm-12 col-md-5">
                    </div><div class="col-sm-12 col-md-7"><div class="dataTables_paginate paging_simple_numbers" id="datatable-editable_paginate"><ul class="pagination"><li class="paginate_button page-item previous disabled" id="datatable-editable_previous"><a href="#" aria-controls="datatable-editable" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li><li class="paginate_button page-item active"><a href="#" aria-controls="datatable-editable" data-dt-idx="1" tabindex="0" class="page-link">1</a></li><li class="paginate_button page-item "><a href="#" aria-controls="datatable-editable" data-dt-idx="2" tabindex="0" class="page-link">2</a></li><li class="paginate_button page-item "><a href="#" aria-controls="datatable-editable" data-dt-idx="3" tabindex="0" class="page-link">3</a></li><li class="paginate_button page-item "><a href="#" aria-controls="datatable-editable" data-dt-idx="4" tabindex="0" class="page-link">4</a></li><li class="paginate_button page-item "><a href="#" aria-controls="datatable-editable" data-dt-idx="5" tabindex="0" class="page-link">5</a></li><li class="paginate_button page-item "><a href="#" aria-controls="datatable-editable" data-dt-idx="6" tabindex="0" class="page-link">6</a></li><li class="paginate_button page-item next" id="datatable-editable_next"><a href="#" aria-controls="datatable-editable" data-dt-idx="7" tabindex="0" class="page-link">Next</a></li></ul></div></div></div></div>
               </div>
          </div>
          <!-- end: page -->

     </div>
@endsection