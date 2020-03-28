<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Rules\UpdateRoleRule;
use Illuminate\Support\Facades\DB;
use App\Models\RoleHasPermission as Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['roles'] = Role::whereNotIn('id', [1, 2, 3])->latest()->get();
        return view('admin.roles',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:roles,name'
        ]);
        $role = new Role;
        $role->name = $request->name;
        $role->save();
        if($request->permission_id){
            $permission = new Permission;
            $permission->role_id = $role['id'];
            $permission->permission_id = implode(',', $request->permission_id);
            $permission->save();
        }

        session()->flash('success', 'Role Added successful!');
        return response()->json([
            'status' => 200
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['role'] = Role::with('permissions')->whereId($id)->first();

        $data['role']['permission_id'] = $data['role']['permissions']['permission_id'];
        
        return view('admin.role_edit',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => ['required', new UpdateRoleRule($id)],
        ]);

        $role = Role::findOrFail($id);
        $role->name = $request->name;
        $role->save();

        $permission = Permission::where('role_id',$id)->first();
        if($request->permission_id){
            $permission->permission_id = implode(',', $request->permission_id);
        }else{
            $permission->permission_id = '';
        }
        $permission->save();
        session()->flash('success', 'Role Updated Successfully!');
        return response()->json([
            'status' => 200
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Role::destroy($id);
        Permission::whereRoleId($id)->delete();
        session()->flash('success', 'Role Deleted Successfully!');
        return response()->json([
            'status' => 200
        ]); 
    }
}
