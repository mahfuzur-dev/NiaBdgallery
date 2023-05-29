<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    function role(){
        $all_perimission = Permission::all();
        $all_roles = Role::all();
        $all_user = User::all();
        return view('backend.roles.index',[
            'all_perimission'=> $all_perimission,
            'all_roles'=> $all_roles,
            'all_user'=> $all_user,
        ]);
    }
    function add_permission(Request $request){
        Permission::create(['name' => $request->permission]);
        return back();
    }
    function add_role(Request $request){
        $role = Role::create(['name' => $request->role]);
        $role->givePermissionTo($request->permission);
        return back();
    }
    function assign_role(Request $request){
        $user = User::find($request->user);
        $user->assignRole($request->role);
        return back();
    }
    function edit_permission($user_id){
        $user = User::find($user_id);
        $all_perimission = Permission::all();
        return view('backend.roles.edit',[
            'all_perimission'=> $all_perimission,
            'user'=> $user,
        ]);
    }
    function update_permission(Request $request){
        $user = User::find($request->user_id);
        $user->syncPermissions($request->permission);
        return back();
    }
    function remove_role($user_id){
        $user = User::find($user_id);
        $user->syncRoles([]);
        $user->syncPermissions([]);
        return back();
    }
    function edit_role($role_id){
        $role = Role::find($role_id);
        $all_permission = Permission::all();
        return view('backend.roles.edit_role',[
            'role'=> $role,
            'all_permission'=> $all_permission,
        ]);
    }
    function update_role(Request $request){
        $role = Role::find($request->role_id);
        $role->syncPermissions($request->permission);
        return back();
    }

}
