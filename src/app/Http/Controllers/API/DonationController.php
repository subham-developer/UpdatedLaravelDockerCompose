<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Jobs\SendReceiptJob;
use App\Mail\SendReceiptMail;
use App\Models\Donation;
use App\Models\Project;
use App\Models\ProjectInterval;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use DB;

class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function canDonate($request){
        $user = User::find($request->user_id);
        $donateAmount = $request->amount;
        $balance = $user['balance'];
        if($donateAmount <= $balance){
            return true;
        } 
        return false;
    }

    public function store(Request $request)
    {
        
        $canDonate = $this->canDonate($request);
        $userExist = User::whereId($request->user_id)->exists();
        $projectExist = Project::whereId($request->project_id)->exists();
        $intervalExist = ProjectInterval::whereId($request->interval_id)->exists();

        if($userExist && $projectExist && $intervalExist){
            if($canDonate){
                // create entry for donation
                $donate = new Donation;
                $donate->user_id = $request->user_id;
                $donate->project_id = $request->project_id;
                $donate->project_interval_id = $request->interval_id;
                $donate->amount_donated = $request->amount;
                $donate->save();
                // minus donated amount from user balance
                User::find($request->user_id)->decrement('balance',$request->amount);
                // update interval funded column
                $totalDonation = Donation::whereProjectIntervalId($request->interval_id)->sum('amount_donated');


                $interval = ProjectInterval::find($request->interval_id)->update(['funded' => $totalDonation]);
                
                $interval = ProjectInterval::find($request->interval_id);
                
                $completed = ($interval['funded'] / $interval->project['target']) * 100;
                
                $interval = ProjectInterval::find($request->interval_id)->update(['completed' => $completed]);

                $total_fund = ProjectInterval::whereProjectId($request->project_id)->sum('funded');

                // print_r($total_fund);
                // exit;
                // DB::enableQueryLog();

                $updated_project_fund = Project::where('id', $request->project_id)->update(['funded' => $total_fund]);

                // Post::where('id',3)->update(['title'=>'Updated title']);
                // var_dump(dd(DB::getQueryLog()));
                // exit;

                // echo $updated_project_fund;
                // exit;
                // Project::find($request->project_id)->increment('funded',$request->amount);
                $status = 201;
                $message = 'Donation successfull';
            }
            else{
                $status = 403;
                $message = 'Insuficient Balance';
            }
        }
        else{
            $status = 404;
            $message = 'Bad request';
        }

        
        
        return response()->json([
            'status' => $status,
            'message' => $message
        ]);
    }

    public function sendReceipt(Request $request){
        $users = Donation::whereProjectIntervalId($request->interval_id)->select(['user_id','project_id'])->get();
        foreach($users as $user){
            $data['user'] = User::find($user->user_id);
            $data['project'] = Project::find($user->project_id);
            $data['donations'] = Donation::whereProjectIntervalId($request->interval_id)->whereUserId($user->user_id)
            ->get();
            Mail::to('sangeet@nimapinfotech.com')
            ->queue(new SendReceiptMail($data));
            
        }
            // SendReceiptJob::dispatch();
            echo 'mail sent<br>';
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
