<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Rules\UpdateUserEmailRule;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::whereRoleId(3)->get();
        return response()->json([
            'status'=>200,
            'data'=>$users
        ]);

        $imei = $request->header('imei');
        return $imei;
        /*$authKey = $request->header('auth_key');
        return $userId = $request->header('user_id');
        $isVerified = User::whereId($userId)->exists();*/
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function getAuthKey(){
        while(true){
            $authKey = (string) Str::uuid();

            if(User::where('auth_key', $authKey)->exists()){
                continue;
            }
            break;
        }
        return $authKey;
    }

    public function store(Request $request)
    {

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->password = bcrypt($request->password);
        $user->imei = $request->imei;
        $user->os_type = $request->os_type;
        $user->role_id = 3;
        $user->auth_key = $this->getAuthKey();
        $user->save();

        $data['user'] = $user;
        return response()->json([
            'status' => 200,
            'message' => 'Register successfully!',
            'data' => $data
        ]);
    }

    public function login(Request $request){
        $data = null;
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $user->imei = $request->header('IMEI');
            $user->os_type = $request->header('OSType');
            $user->save();

            $message = 'Login successfully!';
            $status = 200;
            $data['user'] = Auth::user();
        }else{
            $status = 403;
            $message = 'Username or password incorrect';
        }
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
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
        $data['user'] = User::find($id);

        return response()->json([
            'status' => 200,
            'data' => $data
        ]);
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
        //
    }

    public static function updateProfile(Request $request){

        
        $validatedData = $request->validate([
            'name'  => 'required|regex:/^[\pL\s\-]+$/u|min:3',
            'email' => ['required', 'email', new UpdateUserEmailRule($request->user_id)],
            'mobile' => 'required|digits:10',
        ]);

        $user = User::find($request->user_id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile; 
        $user->save();



        return response()->json([
            'status' => 201,
            'message'=>'Profile updated successfully!'
        ],201);


    }

    public static function updatePassword(Request $request){
        $user = User::find($request->user_id);
        $request->validate([
            'current_password' => ['required',function ($attribute, $value, $fail) use($user) {
                if (!Hash::check($value,$user['password'])) {
                    $fail('Current password is invalid.');
                }
            }],
            'new_password' => 'required|min:4|confirmed',
        ]);

        $user->password = bcrypt($request->new_password);
        $user->save();

        return response()->json([
            'message' => 'Password updated successfully!'
        ],201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
