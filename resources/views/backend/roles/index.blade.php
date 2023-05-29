@extends('layouts.dashboard')
@section('content')
     <div class="row">
          <div class="col-12">
               <div class="page-title-box">
                    <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Role</a></li>
                    <li class="breadcrumb-item active">Add Role & Permission</li>
                    </ol>

                    <div class="clearfix"></div>
               </div>
          </div>
     </div>
     <div class="row">
          <div class="col-lg-8">
               <div class="card">
                    <div class="card-header">
                         <h4>Role & Permission</h4>
                    </div>
                    <div class="card-body">
                         <table class="table table-striped table-hover">
                              <tr>
                                   <th>Sl No</th>
                                   <th>Role</th>
                                   <th>Permissions</th>
                                   <th>Action</th>
                              </tr>
                              @foreach ($all_roles as $key=>$role)
                                   <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$role->name}}</td>
                                        <td>
                                             @foreach ($role->getAllPermissions() as $permission)
                                                  <span class="badge badge-pill badge-info p-1">{{$permission->name}}</span>
                                             @endforeach
                                        </td>
                                        <td class="actions">
                                             <a href="{{route('edit.role',$role->id)}}" class="on-default edit-row" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                                             <a href="" class="on-default remove-row" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                   </tr>
                              @endforeach
                         </table>
                    </div>
               </div>

               <div class="card mt-3">
                    <div class="card-header">
                         <h4>User & Role</h4>
                    </div>
                    <div class="card-body">
                         <table class="table table-striped table-hover">
                              <tr>
                                   <th>Sl No</th>
                                   <th>User</th>
                                   <th>Role</th>
                                   <th>Permission</th>
                                   <th>Action</th>
                              </tr>
                              @foreach ($all_user as $key=>$user)
                                   <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>
                                             @forelse($user->getRoleNames() as $role)
                                                  {{$role}}
                                                  @empty
                                                  Not Assign Yet
                                             @endforelse
                                        </td>
                                        <td>
                                             @forelse ($user->getAllPermissions() as $permission)
                                             <span class="badge badge-primary mb-2">{{$permission->name}},</span>
                                             @empty
                                             Not Assign Permission Yet
                                             @endforelse
                                        </td>
                                        <td class="actions">
                                             <a href="{{route('edit.permission',$user->id)}}" class="on-default edit-row" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                                             <a href="{{route('remove.role',$user->id)}}" class="on-default remove-row" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                   </tr>
                              @endforeach
                         </table>
                    </div>
               </div>

          </div>
          <div class="col-lg-4">
               {{-- <div class="card">
                    <div class="card-header">
                         <h4>Permission</h4>
                    </div>
                    <div class="card-body m-2">
                         <form action="{{route('add.permission')}}" method="POST">
                              @csrf
                              <div class="mb-3">
                                   <label for="permission">Add Permission</label>
                                   <input type="text" name="permission" id="permission" class="form-control">
                              </div>
                              <div class="mb-3">
                                   <button type="submit" class="btn btn-success">Submit</button>
                              </div>
                         </form>
                    </div>
               </div> --}}

               <div class="card mt-3">
                    <div class="card-header">
                         <h4>Role</h4>
                    </div>
                    <div class="card-body m-2">
                         <form action="{{route('add.role')}}" method="POST">
                              @csrf
                              <div class="mb-3">
                                   <label for="role">Add Role</label>
                                   <input type="text" name="role" id="role" class="form-control">
                              </div>
                              <div class="mb-3">
                                   <label for="permission">Permission</label>
                                   <br>
                                   @foreach ($all_perimission as $permission)
                                        <input type="checkbox" name="permission[]" value="{{$permission->id}}" id="permission"><span class="pr-2"></span>{{$permission->name}}<br>
                                   @endforeach
                              </div>
                              <div class="mb-3">
                                   <button type="submit" class="btn btn-success">Submit</button>
                              </div>
                         </form>
                    </div>
               </div>

               <div class="card mt-3">
                    <div class="card-header">
                         <h4>Assign</h4>
                    </div>
                    <div class="card-body m-2">
                         <form action="{{route('assign.role')}}" method="POST">
                              @csrf
                              <div class="mb-3">
                                   <label for="user">User Name</label>
                                   <select name="user" id="user" class="form-control">
                                        <option value="">-- Select User --</option>
                                        @foreach ($all_user as $user)
                                             <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                   </select>
                              </div>
                              <div class="mb-3">
                                   <label for="role">Role</label>
                                   <select name="role" id="role" class="form-control">
                                        <option value="">-- Select Role --</option>
                                        @foreach ($all_roles as $role)
                                             <option value="{{$role->id}}">{{$role->name}}</option>
                                        @endforeach
                                   </select>
                              </div>
                              <div class="mb-3">
                                   <button type="submit" class="btn btn-success">Assign Role</button>
                              </div>
                         </form>
                    </div>
               </div>

          </div>
     </div>
@endsection