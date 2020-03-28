<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Rules\UpdateUserEmailRule;
use App\User;
use App\Models\Role;

class EditorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::whereNotIn('id',[1,2,3])->get(); 
        foreach($roles as $role){
            $data['roles'][$role['id']] = $role['name'];
        }
        $data['users'] = User::with(['role:id,name'])->whereNotIn('role_id',[1,2,3])->latest()->get();       
        return view('admin.editors',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::whereNotIn('id',[1,2,3])->get(); 
        foreach($roles as $role){
            $data['roles'][$role['id']] = $role['name'];
        }
        return view('admin.editor_create',['data'=>$data]);
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
            'name' => 'required|regex:/^[\pL\s\ ]+$/u',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required|digits:10|unique:users,mobile|regex:/^[1-9]{1}[0-9]{9}?/',
            'password' => 'required',
            'role_id'=>'required'
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->password = bcrypt($request->password);
        $user->role_id = $request->role_id;
        $user->save();
        session()->flash('success', 'User Added successfully!');
        return response()->json([
            'status'=>200
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
        $roles = Role::whereNotIn('id',[1,2,3])->get(); 
        foreach($roles as $role){
            $data['roles'][$role['id']] = $role['name'];
        }
        $data['user'] = User::findOrFail($id);
        return view('admin.editor_edit',['data'=>$data]);
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
            'name' => 'required',
            'email' => ['required', 'email', new UpdateUserEmailRule($id)],
            'mobile' => 'required|digits:10|regex:/^[1-9]{1}[0-9]{9}?/',
            'password' => 'nullable|min:4',
            'role_id'=>'required'
        ]);
        

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->role_id = $request->role_id;
        if($request->password){
            $user->password = bcrypt($request->password);
        }
        $user->save();

        session()->flash('success', 'User Updated Successfully!');
        return response()->json([
            'status'=>200
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
        User::destroy($id);
        session()->flash('success', 'User Deleted Successfully!');
        return response()->json([
            'status'=>200
        ]);
    }
}
