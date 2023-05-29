@extends('layouts.dashboard')
@section('content')
 <div class="row">
          <div class="col-12">
               <div class="page-title-box">
                    <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Role</a></li>
                    <li class="breadcrumb-item active">Edit Role</li>
                    </ol>

                    <div class="clearfix"></div>
               </div>
          </div>
     </div>
<div class="row">
     <div class="col-lg-8 m-auto">
          <div class="card">
               <div class="card-header">
                    <h3>Edit Role</h3>
               </div>
               <div class="card-body m-4">
                    <form action="{{route('update.permission')}}" method="POST">
                         @csrf
                         <div class="mb-3">
                              <label for="" class="form-label">Role Name</label>
                              <input type="hidden" name="user_id" class="form-control" value="{{$user->id}}">
                              <input type="text" class="form-control" value="{{$user->name}}">
                         </div>
                         <div class="mb-3">
                              <label for="permission" class="form-label">Permissions</label>
                              <br>
                              @foreach ($all_perimission as $permission)
                              <input type="checkbox" id="permission{{$permission->id}}" {{($user->hasPermissionTo($permission->name))?'checked':''}} name="permission[]" value="{{$permission->id}}">   {{$permission->name}}
                                   <br>
                              @endforeach
                         </div>
                         <div class="mb-3">
                              <button type="submit" class="btn btn-primary">Update Permission</button>
                         </div>
                    </form>
               </div>
          </div>
     </div>
</div>
@endsection