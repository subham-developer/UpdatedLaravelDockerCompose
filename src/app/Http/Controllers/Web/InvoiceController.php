<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Jobs\ReceiptJob;
use App\Mail\DonationInvoiceMail;
use App\Models\Donation;
use App\Models\Project;
use App\Models\ProjectInterval;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Vinkla\Hashids\Facades\Hashids;
use DB;

class InvoiceController extends Controller
{
    public static function mailInvoice(Request $request, $projectId)
    {
        if($projectId != '0'){
            $data['project'] = ProjectInterval::with('project')->whereId($projectId)->first();
        }else{
            $data['project'] = ProjectInterval::with('project')->whereId($request->interval_id)->first()->project;
        }

        $invoice['userId']     = isset($request->user_id) ? $request->user_id : Auth::id();
        $invoice['projectId']  = $projectId;
        $invoice['intervalId'] = isset($request->interval_id) ? $request->interval_id : 0;
        $data['key']    = encrypt(json_encode($invoice));
        $data['user'] = User::find($invoice['userId']);

        $project_name = Project::where('id', $projectId)->get();
        $project_title = $project_name[0]->title;
        $data['project_name'] = $project_title;

        $data['user'] = User::find($invoice['userId']);

        $query = DB::table('users')->where('id', $request->user_id)->get();
        $invoice_id = $query[0]->invoice_id;

        if($invoice_id == ''){
            $invoice_id = rand(999,9999);
            User::whereId($request->user_id)->update(['invoice_id'=>$invoice_id]);
        }

        $data['user']->email = 'sushant@nimapinfotech.com';

        // $data['invoice_id'] = $invoice_id;

        Mail::to($data['user']->email)->send(new DonationInvoiceMail($data));

        // ReceiptJob::dispatch($data);
        // Mail::to($data['user']->email)->send(new DonationInvoiceMail($data));
        return back()->with('success', 'Please check your mail');
    }

    public function showInvoice(Request $request, $key)
    {
        $invoiceDetails        = decrypt($key);
        $invoice               = json_decode($invoiceDetails);

        // echo $invoice->userId;
        // exit;
        $userId                = $invoice->userId;
        $projectId             = $invoice->projectId;
        if($projectId != 0){
            $data['project']       = Project::with(['user', 'user.ngo'])->whereId($projectId)->first();
        }else{
           $data['project'] = ProjectInterval::with('project')->whereId($invoice->intervalId)->first()->project;
        }

        $data['user']          = User::find($userId);

        if($projectId != 0){
            $data['amountDonated'] = Donation::whereUserId($userId)->whereProjectId($projectId)->sum('amount_donated');
            $data['donationDate']  = Donation::whereUserId($userId)->whereProjectId($projectId)->latest()->first();
        }else{
            $data['amountDonated'] = Donation::whereUserId($userId)->whereProjectIntervalId($invoice->intervalId)->sum('amount_donated');
            $data['donationDate']  = Donation::whereUserId($userId)->whereProjectIntervalId($invoice->intervalId)
            ->latest()->first();
        }

        $query = DB::table('users')->where('id', $userId)->get();
        $invoice_id = $query[0]->invoice_id;

        if($invoice_id == ''){
            $invoice_id = rand(999,9999);
            User::whereId($userId)->update(['invoice_id'=>$invoice_id]);
        }else{
            $data['invoice_id'] = $invoice_id;
        }

        return view('donation_invoice', ['data' => $data]);
    }

}
