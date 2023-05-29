<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;

class UserController extends Controller
{
    function user_details(){
        return view('backend.user.user_details');
    }
    function user_profile_edit(){
        return view('backend.user.user_profile_edit');
    }
    function user_profile_update(Request $request){
        $profile_photo  = $request->profile_photo;
        if(Auth::user()->profile_photo == !null){
            $extension = $profile_photo->getClientOriginalExtension();
            $file_name = Auth::id().'.'.$extension;
            $img = Image::make($profile_photo)->save(public_path('uploads/user/'.$file_name));
            User::find(Auth::id())->update([
                'profile_photo'=>$file_name,
                'created_at'=>Carbon::now(),
            ]);
            return redirect('/user/details');
        }
        else{
            $extension = $profile_photo->getClientOriginalExtension();
            $file_name = Auth::id().'.'.$extension;
            $img = Image::make($profile_photo)->save(public_path('uploads/user/'.$file_name));
            User::find(Auth::id())->update([
                'profile_photo'=>$file_name,
                'created_at'=>Carbon::now(),
            ]);
            return redirect('/user/details');
        }
    }
    function user_info_update(Request $request){
        User::find(Auth::id())->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'address'=>$request->address,
            'mobile'=>$request->mobile,
            'birth'=>$request->birth,
            'gender'=>$request->gender,
            'created_at'=>Carbon::now(),
        ]);
        return back();
    }
    function user_list(){
        $all_users = User::all();
        return view('backend.user.user_list',[
            'all_users' =>$all_users,
        ]);
    }
    function user_delete($user_id){
        User::find($user_id)->delete();
        return back();
    }
}
