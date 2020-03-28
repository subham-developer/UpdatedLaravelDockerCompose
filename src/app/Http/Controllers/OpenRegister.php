<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Openclient;
use App\Models\Client;

class OpenRegister extends Controller
{
    function index(){
    	return view('open_register_page');
    }

    function indexnew(){
        return view('open_register_page_new');
    }

    function insert(Request $request){
    	$validator = Validator::make(request()->all(), [
                                                        'company_name' => 'required|max:50',
                                                        'finance_name' => 'required|max:50',
                                                        'finance_email' => 'required|email|max:50',
                                                        'finance_contact_number' => 'required|numeric|max:9999999999',
                                                        'address' => 'required|max:250',
                                                        'tan' => 'required||max:20',
                                                        'pan' => 'required|max:20',
                                                        'gst' => 'required|max:20',
                                                        'captcha' => 'required|captcha'
                                                    ]);
        if($validator->fails()){
            $errorMessage = $validator->errors()->all();

            if($errorMessage[0] == 'validation.captcha'){
            	echo $this->jsonEncode(400, 'Incorrect captch');
            	exit();
            }
            else{
            	echo $this->jsonEncode(400, $errorMessage[0]);
            	exit();
            }
        }

        $insert = new Openclient;
        $insert->company_name = ucwords($request->company_name);
        $insert->finance_name = ucwords($request->finance_name);
        $insert->finance_email = strtolower($request->finance_email);
        $insert->finance_contact_number = $request->finance_contact_number;
        $insert->address = ucwords($request->address);
        $insert->tan = strtoupper($request->tan);
        $insert->pan = strtoupper($request->pan);
        $insert->gst = strtoupper($request->gst);
        $insert->save();

        if($insert->id > 0){
        	$this->refereshCapcha();
        	echo $this->jsonEncode(200, 'Data added successfully');
        	exit();	
        }
        else{
        	echo $this->jsonEncode(400, 'Unable to add you data');
        	exit();
        }
    }

    function jsonEncode($code = 400, $message = 'Error', $data = array()){
    	$output = new \stdclass;
    	$output->code = $code;
    	$output->message = $message;
    	$output->data = $data;
    	return json_encode($output);
    }

    function show(){
        $data = Openclient::where('is_deleted',0)->get();
        $Client = Client::select('client_name','id')->where('deleted',0)->get();
    	return view('request_client')->with(['client' => $data, 'preClient' => $Client]);
    }

    public function refereshCapcha(){
	    return captcha_img('flat');
	}

	function status(Request $request){
		$validator = Validator::make(request()->all(), [
                                                        'id' => 'required|max:50',
                                                        'type' => 'required|max:50',
                                                    ]);
        if($validator->fails()){
            $errorMessage = $validator->errors()->all();
        	echo $this->jsonEncode(400, $errorMessage[0]);
        	exit();
        }

        if($request->type == 'accept'){
        	$data = Openclient::find($request->id);

        	if(empty($data)){
        		echo $this->jsonEncode(400, 'Somethink went wrong');
        		exit();
        	}

        	$insertData = new Client;
        	$insertData->client_name = $data->company_name;
        	$insertData->account_name = $data->finance_name;
        	$insertData->account_email = $data->finance_email;
        	$insertData->accotant_mobile = $data->finance_contact_number;
        	$insertData->address = $data->address;
        	$insertData->billing_address = $data->address;
        	$insertData->tan = $data->tan;
        	$insertData->gst = $data->gst;
        	$insertData->pan = $data->pan;
        	$insertData->save();

        	$data->is_deleted = 1;
        	$data->save();

        	echo $this->jsonEncode(200, 'Request accepted');
        	exit();
        }
        else if($request->type == 'reject'){
        	$data = Openclient::find($request->id);
        	$data->is_deleted = 1;
        	$data->save();

        	echo $this->jsonEncode(200, 'Request rejected');
        	exit();
        }
        else if($request->type == 'replace'){
        	$data = Openclient::find($request->id);

        	if(empty($data)){
        		echo $this->jsonEncode(400, 'Somethink went wrong');
        		exit();
            }
            
            if(!isset($request->previous_employee) || !is_numeric($request->previous_employee) || $request->previous_employee < 1){
                echo $this->jsonEncode(400, 'Somethink went wrong');
        		exit();
            }

        	$insertData = Client::find($request->previous_employee);
        	// $insertData->client_name = $data->company_name;
        	$insertData->account_name = $data->finance_name;
        	$insertData->account_email = $data->finance_email;
        	$insertData->accotant_mobile = $data->finance_contact_number;
        	$insertData->address = $data->address;
        	$insertData->billing_address = $data->address;
        	$insertData->tan = $data->tan;
        	$insertData->gst = $data->gst;
        	$insertData->pan = $data->pan;
        	$insertData->save();

        	$data->is_deleted = 1;
        	$data->save();

        	echo $this->jsonEncode(200, 'Request accepted');
        	exit();
        }
        else{
        	echo $this->jsonEncode(400, 'Something went wrong123');
        	exit();
        }
	}
}
