<?php
namespace App\Http\Controllers;

// namespace App\Console\Commands;

use App\Http\Controllers\API\DonationController as DonationApi;
use App\Models\Donation;
use App\Models\ProjectInterval;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CronController extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'autoDonate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
      parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function testCron(Request $request)
    {
      // $now = date('Y-m-d');
      $now = date('Y-m-d h:i:s');
      $users = User::whereColumn('balance', '>=', 'plan')->where('balance','>',0)->get();

      $intervals = ProjectInterval::with('project')
      ->whereDate('start_date','<=',$now)
      ->whereDate('end_date','>=',$now)
      ->oldest()
      ->get();

      foreach($intervals as $interval){
        $projectStatus = $interval['project']['status'];
        $projectTarget = $interval['project']['target'];
        $intervalFunded = $interval['funded'];
        if($projectStatus == 1 && $intervalFunded < $projectTarget)
        {
          foreach($users as $user)
          {
            $donated = Donation::whereUserId($user->id)
            // ->whereDate('created_at',$now)->exists();
            ->where('created_at', '<=' ,$now)->exists();

            if(!$donated)
            {
              $todayFunded = Donation::whereProjectId($interval['project_id'])
              ->whereDate("created_at",$now)
              ->sum('amount_donated');

              $target = $interval['project']['target'];

              if($interval['project']['recurring_days']){
                $recurringDays = $interval['project']['recurring_days'];
                $perDayDonation = $target / $recurringDays;
                $donateUpto = round($perDayDonation / 3);
              }else{
                $startDate = $interval['start_date'];
                $endDate = $interval['end_date'];                            
                $startDate=date_create($interval['start_date']);
                $endDate=date_create($interval['end_date']);
                $diff=date_diff($startDate,$endDate);
                $days = (int)$diff->format("%R%a days");

                $perDayDonation = $target / $days;
                $donateUpto = round($perDayDonation / 3);
              }                        

              if($interval != null && $todayFunded < $donateUpto){   
                $request = new Request;                 
                $request['user_id'] = $user->id;
                $request['project_id'] = $interval['project_id'];
                $request['interval_id'] = $interval['id'];
                $request['created_at'] = date('Y-d-m h:i:s');
                $request['updated_at'] = date('Y-d-m h:i:s');
                $request['amount'] = $user->plan;
                $donation = new DonationApi;
                $donated = $donation->store($request);
                echo json_encode($request->all());                        
              }
            }
          }
        }
      }
      exit;
    }
  }