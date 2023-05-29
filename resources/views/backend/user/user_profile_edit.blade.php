@extends('layouts.dashboard')
@section('content')
     <div class="row">
          <div class="col-lg-4 m-auto">
               <div class="card mt-4">
                    <div class="card-header bg-info">
                         <h5 class="text-white">Edit User Photo</h5>
                    </div>
                    <div class="card-body m-2">
                         <form action="{{route('user.profile.update')}}" method="POST" enctype="multipart/form-data">
                              @csrf
                              <div class="mb-3">
                                   <input type="file" class="form-control" name="profile_photo" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                              </div>
                              <div class="mb-3">
                                   @if (Auth::user()->profile_photo == null)
                                        <img src="{{ Avatar::create('Joko Widodo')->toBase64() }}" id="blah" width="100" height="100" />
                                   @else
                                        <img src="{{asset('uploads/user/8.jpg')}}" id="blah" width="100" height="100" alt="user" class="rounded-circle">
                                   @endif
                                   
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