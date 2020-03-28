<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;

class AdminAuthController extends Controller
{
    public function getLogin(){
        
    	return view('admin.admin_login');
    }

    public function postLogin(Request $request){
    	// return bcrypt('sangeet');
        $roles = Role::whereNotIn('id',[3])->get(['id']);
    	if (Auth::attempt(['email' => $request->email, 'password'=> $request->password, 'role_id'=>$roles ])) {
    		return redirect('admin/dashboard');
		}else{
			return back()->withInput()->with('error','Invalid ');;
			
		}
    }

    public function logout(){
        Auth::logout();
        return redirect('admin/login');
    }
}
