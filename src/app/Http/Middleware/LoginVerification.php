<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class LoginVerification
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $authKey = $request->header('AuthKey');
        $imei = $request->header('IMEI');
        $userId = $request->header('UserId');

        $isExist = User::where('auth_key',$authKey)->where('imei',$imei)->where('id',$userId)->exists();
        if($isExist){
            return $next($request);
            /*return response()->json([
                'status' => 200
            ]);*/
        }else{
            return response()->json([
                'status' => 401,
                'message' => 'Unauthorized access',
                'data' => null
            ]);
        }

    }
}
