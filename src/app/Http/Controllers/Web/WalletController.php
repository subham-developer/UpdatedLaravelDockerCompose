<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Controllers\API\WalletController as WalletApi;
use App\Models\Transaction;
use App\Models\Razorpaycredentials;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class WalletController extends Controller
{
  public function index()
  {
    $razorpayDetails = Razorpaycredentials::select('*')->where('status',1)->first();
    return view('wallet', ['razorpaydata' => $razorpayDetails] );
  }

  public function postAddMoney(Request $request)
  {
        /*$request->validate([
            'amount' => ['required','integer', 
            function($attribute, $value, $fail){
                if ($value < 365) {
                    $fail($attribute.' is invalid.');
                }
            }]
        ]);

        $data['user']   = Auth::user();
        $data['txnId']  = (string) Str::uuid();
        $data['amount'] = $request->amount;
        return view('payumoney', ['data' => $data]);*/
        return WalletApi::postAddMoney($request);
      }

      public function storeTransaction($request)
      {
        // dd($request);
        $request['user_id'] = Auth::id();

        $transaction                = new Transaction;
        $transaction->user_id       = $request->user_id;
        $transaction->name          = $request->firstname;
        $transaction->email         = $request->email;
        $transaction->mobile        = $request->phone;
        $transaction->txn_id        = $request->txnid;
        $transaction->status        = $request->status;
        $transaction->unmapped_status        = $request->unmappedstatus;
        $transaction->error         = $request->error;
        $transaction->error_message = $request->error_Message;
        $transaction->amount        = $request->amount;
        $transaction->product_info  = $request->productinfo;
        $transaction->pg_type       = $request->PG_TYPE;
        $transaction->mode          = $request->mode;
        $transaction->mih_pay_id    = $request->mihpayid;
        $transaction->payu_money_id = $request->payuMoneyId;
        $transaction->bank_code     = $request->bankcode;
        $transaction->bank_ref_num  = $request->bank_ref_num;
        $transaction->card_num      = $request->cardnum;
        $transaction->save();

      }

      public function postSuccess(Request $request)
      {
        $status      = $_POST["status"];
        $firstname   = $_POST["firstname"];
        $amount      = $_POST["amount"];
        $txnid       = $_POST["txnid"];
        $posted_hash = $_POST["hash"];
        $key         = $_POST["key"];
        $productinfo = $_POST["productinfo"];
        $email       = $_POST["email"];
        $salt        = "dfv1b15n";

        // Salt should be same Post Request

        if (isset($_POST["additionalCharges"])) {
          $additionalCharges = $_POST["additionalCharges"];
          $retHashSeq        = $additionalCharges . '|' . $salt . '|' . $status . '|||||||||||' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
        } else {
          $retHashSeq = $salt . '|' . $status . '|||||||||||' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
        }
        $hash = hash("sha512", $retHashSeq);
        if ($hash != $posted_hash) {
          echo "Invalid Transaction. Please try again";
        } else {
            // return $request;
          echo "<h3>Thank You. Your order status is " . $status . ".</h3>";
          echo "<h4>Your Transaction ID for this transaction is " . $txnid . ".</h4>";
          echo "<h4>We have received a payment of Rs. " . $amount . ". Your order will soon be shipped.</h4>";
          try{

            $this->storeTransaction($request);
                // $plan = $request->amount / 365;
            if($request->amount >= 365){
              $plan = 1;
            }
            if ($request->amount >= 730) {
              $plan = 2;
            }
            if($request->amount >= 1095){
              $plan = 3;
            }

            User::whereId($request->user_id)->increment('balance', $request->amount);
                // update user plan
            $user = User::find($request->user_id);
            $user->plan = $plan;
            $user->save();

            $data = json_encode($request->all());
            session()->put('transaction', $data);
          }
          catch(Exception $e){
            return redirect('wallet/transaction');

          }

          return redirect('wallet/transaction');
        }
      }

      public function postFail(Request $request)
      {
        $status    = $_POST["status"];
        $firstname = $_POST["firstname"];
        $amount    = $_POST["amount"];
        $txnid     = $_POST["txnid"];

        $posted_hash = $_POST["hash"];
        $key         = $_POST["key"];
        $productinfo = $_POST["productinfo"];
        $email       = $_POST["email"];
        $salt        = "dfv1b15n";

        // Salt should be same Post Request

        if (isset($_POST["additionalCharges"])) {
          $additionalCharges = $_POST["additionalCharges"];
          $retHashSeq        = $additionalCharges . '|' . $salt . '|' . $status . '|||||||||||' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
        } else {
          $retHashSeq = $salt . '|' . $status . '|||||||||||' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
        }
        $hash = hash("sha512", $retHashSeq);

        if ($hash != $posted_hash) {
          echo "Invalid Transaction. Please try again";
        } else {

          $this->storeTransaction($request);
          $data = json_encode($request->all());
          session()->put('transaction', $data);
          return redirect('wallet/transaction');
            // return redirect('wallet')->with('failed','Sorry, We unable to update your wallet.');

          echo "<h3>Your order status is " . $status . ".</h3>";
          echo "<h4>Your transaction id for this transaction is " . $txnid . ". You may try making the payment by clicking the link below.</h4>";
        }
      }

      public function getTransaction(Request $request)
      {
        if (session()->get('transaction')) {

          $data = json_decode(session()->get('transaction'), JSON_FORCE_OBJECT);
            // echo "<pre>";
            // print_r($data);
            // exit;
            // return view('transaction_details', ['data' => $data]);
          if($data['status'] == 'success'){
            return back()->with('success','Congratulations, We have updated your wallet with amount '.$data['amount'].' and your transaction id is '.$data['txnid'].'.');
          }else{
            return back()->with('failed','Sorry, We unable to update your wallet.');
          }    
        } else {
            // return redirect('/');
            // return back()->with('failure','Sorry, We unable to update your wallet.');
        }
      }

      public function updatePlan(Request $request){   
        $data = $request;
        $data['user_id'] = $request->user()->id;
        WalletApi::updatePlan($data);

        return back()->with('success','Plan updated successfully.');
      }
    }
