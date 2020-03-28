<?php

namespace App\Console\Commands;

use App\Http\Controllers\API\DonationController as DonationApi;
use App\Models\Donation;
use App\Models\ProjectInterval;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AutoDonate extends Command
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
    public function handle(Request $request)
    {
        // DB::table('test')->delete();
        $now = now();
        Log::info($now);
        
        $yesterday = $now->subDays(1);

        $users = User::whereColumn('balance', '>=', 'plan')->where('balance','!=',0)->get();
        
        foreach($users as $user){
            $donated = Donation::whereUserId($user->id)->whereCreatedAt($yesterday)->exists();
            if(!$donated){

                $interval = ProjectInterval::join('projects', function ($join) use($now) {
                                $join->on('projects.id', '=', 'project_intervals.project_id')
                                ->where('projects.status',1)
                                // ->whereDate('project_intervals.start_date','<=',$now)
                                // ->whereDate('project_intervals.end_date','>=',$now)
                                ->whereColumn('project_intervals.funded','<','projects.target')
                                ->orderBy('completed','desc')
                                ->oldest();
                                })->first();

                // $interval = ProjectInterval::join('projects', function ($join) use($now) {
                //                 $join->on('projects.id', '=', 'project_intervals.project_id');
                //             })->first();
                if($interval != null){
                    $request['user_id'] = $user->id;
                    $request['project_id'] = $interval['project_id'];
                    $request['interval_id'] = $interval['id'];
                    $request['amount'] = $user->plan;
                    $donation = new DonationApi;
                    $donation->store($request);
                    
                }
            }
        }
    }
}
