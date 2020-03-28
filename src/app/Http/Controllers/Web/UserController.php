<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\API\UserController as UserApi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profileEdit(){
        $data['user'] = Auth::user();
        return view('profile_edit',['data'=>$data]);
    }

    public function profileUpdate(Request $request){
        $data = $request;
        $data['user_id'] = Auth::id();

        $res = UserApi::updateProfile($data);

        return redirect('profile')->with('success','Profile Updated Successfully!');
    }

    public function showProfilePassword(Request $request){
         $data['user'] = Auth::user();
        return view('profile_password',['data'=>$data]);
    }

    public function updatePassword(Request $request){
    	$data = $request;
    	$data['user_id'] = Auth::id();
    	UserApi::updatePassword($data);
    	return redirect('profile/password')->with('success','Password Updated Successfully!');
    }

    public function updateProfile(){

    }

    public function destroyProfile(){

    }
}
