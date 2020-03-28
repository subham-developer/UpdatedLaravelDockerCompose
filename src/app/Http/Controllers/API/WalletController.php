<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class WalletController extends Controller
{

	public static function postAddMoney(Request $request){
		$request->validate([
            'amount' => ['required','integer', 
            function($attribute, $value, $fail){
                if ($value < 365) {
                    $fail($attribute.' is invalid.');
                }
            }]
        ]);
        
        $data['user']   = $request->user();
        $data['txnId']  = (string) Str::uuid();
        $data['amount'] = $request->amount;
        return view('payumoney', ['data' => $data]);

	}
    public static function updatePlan(Request $request){
    	$request->validate([
    		'amount' => ['required','integer',function ($attribute, $value, $fail) {
	            if ($value <= 0) {
	                $fail($attribute.' is invalid.');
	            }
        	}]
    	]);

    	$user = User::find($request->user_id);
    	$user->plan = $request->amount;
    	$user->save();

    	return response()->json([
    		'message'=>'Plan updated successfully!'
    	],200);
    }
}
