<?php
# Copy the code from below to that controller file located at app/Http/Controllers/RazorpayController.php
namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RazorpayController extends Controller {

	public function pay() {
		return view('pay');
	}

	public function dopayment(Request $request) {
        //Input items of form
		$input = $request->all();
    // Please check browser console.
		// print_r($input);
		// exit;
	}

	public function add_payment_details(Request $request){
		$input = $request->all();

		$user_id = Auth::id();
		$razorpay_payment_id = $input['razorpay_payment_id'];
		$paymentDate = $input['paymentDate'];
		$pay_cost = $input['pay_cost'];
		$balance = 0;

		$user = User::find($user_id);
		$balance = $user->balance;
		// echo "<pre>";
		// print_r($user['']);
		// exit;
		// echo $user_id.'---------'.$paymentDate.'------'.$razorpay_payment_id.'-------'.$pay_cost.'------'.$balance;

		$paymentData['balance'] = $balance + $pay_cost;
		$paymentData['razorpay_payment_id'] = $razorpay_payment_id;
		$paymentData['razorpay_payment_date'] = date("Y-m-d h:i:s");
		User::where('id', $user_id)
		->update($paymentData);
		}

		// echo 'done';
	}