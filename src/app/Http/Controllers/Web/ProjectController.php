<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\API\DonationController;
use App\Http\Controllers\API\ProjectController as ProjectApi;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\ProjectInterval;
use App\User;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Vinkla\Hashids\Facades\Hashids;
use DB;

class ProjectController extends Controller
{
    public function index(Request $request){

        $data['maxFunded'] = $this->maxFunded();
    	$now = date_format(now(),'Y-m-d');
        $data['projects'] = ProjectInterval::join('projects', function ($join) use($now) {
                                        $join->on('projects.id', '=', 'project_intervals.project_id')
                                        ->where('projects.status',1)
                                        ->whereDate('project_intervals.start_date','<=',$now)
                                        ->whereDate('project_intervals.end_date','>=',$now)
                                        ->whereColumn('project_intervals.funded','<','projects.target');
                                    })
                                    ->select('project_intervals.*','projects.*',
                                        'project_intervals.id as id',
                                        'project_intervals.start_date as start_date',
                                        'project_intervals.funded as funded',
                                        'project_intervals.end_date as end_date')
                                    ->with(['project.image','project.user'])
                                    ->paginate(9);
    	return view('projects',['data'=>$data]);
    }

    public function searchHints(Request $request){
        $res = ProjectApi::search($request)->getData();
        $res = json_encode($res);
        $res = collect(json_decode($res,JSON_FORCE_OBJECT)['data']['projects'])->pluck('title');
        // Log::info($res);
        return json_encode($res);
    }

    public function search(Request $request){
        if(!isset($request->search)){
            return redirect('/');
        }
        $res = ProjectApi::search($request)->getData();
        $projects = $res->data->projects;
        $count = count($projects); // total product for pagination
        $page = $request->page; // current page for pagination
        $perPage = 1;
        $offset = ($page-1) * $perPage;
        $projects = array_slice($projects, $offset, $perPage);
        $data['projects'] = new Paginator($projects, $count, $perPage, $page, ['path'  => $request->url(),'query' => $request->query(),]);
        // dd($data);
        return view('project_search',['data'=>$data]);
    }

    public function show($projectSlug){

        $data = Project::where('slug', $projectSlug)->firstOrFail();
        if ($data != null) {
           
            $query = DB::table('projects')->where('slug', $projectSlug)->get();
            $project_id = $query[0]->id;

            $now = date_format(now(),'Y-m-d');

            $project_interval_query = DB::table('project_intervals')
            ->where('project_intervals.project_id', $project_id)
            ->whereDate('project_intervals.start_date','<=',$now)
            ->whereDate('project_intervals.end_date','>=',$now)
            ->get();
            $projectIntervalId = $project_interval_query[0]->id;

        	$data['project'] = ProjectInterval::with(['project','project.image','project.user','project.comments:project_id,user_id,comment,created_at','project.comments.user:id,name,profile_image'])
            ->findOrFail($projectIntervalId);
            $data['comments'] = Comment::with(['user:id,name,profile_image'])->whereProjectId($data['project']->project_id)->latest()->offset(0)->limit(6)->get();
        	return view('project_show',['data'=>$data]);
        }
    }

    public function donate(Request $request,$projectSlug){
        $request->validate([
            'amount' => 'required|numeric|min:1'
        ]);
        
       // echo $request;
       //  echo $intervalId;
       //  exit;
        // $intervalId = Hashids::decode($intervalId);
        // $intervalId = Hashids::decode($intervalId);

        $query = DB::table('projects')->where('slug', $projectSlug)->get();
        $project_id = $query[0]->id;

        // echo $project_id;
        // exit;

        $now = date_format(now(),'Y-m-d');

        $project_interval_query = DB::table('project_intervals')
        ->where('project_intervals.project_id', $project_id)
        ->whereDate('project_intervals.start_date','<=',$now)
        ->whereDate('project_intervals.end_date','>=',$now)
        ->get();
        $projectIntervalId = $project_interval_query[0]->id;

        $data['interval'] = ProjectInterval::with(['project'])
        ->findOrFail($projectIntervalId);
        // ->findOrFail($intervalId[0]);

        $donate = new DonationController;
        $request['user_id'] = Auth::id();
        $request['project_id'] = $data['interval']['project']->id;
        $request['interval_id'] = $data['interval']->id;
        $request['amount'] = $request->amount;

        $status = $donate->store($request)->getData();
        
        if($status->status == 201){
            // return redirect('projects/'.Hashids::encode($intervalId))->with('success','Donation Successfull');
            return redirect('projects/'.$projectSlug)->with('success','Donation Successfull');
        }else{
            return back()->with('fail',$status->message);
        }
    }

    public static function maxFunded(){
        $res = ProjectApi::index()->getData();
        $projects = $res->data->projects;
        $maxCompleted = collect($projects)->max('completed');
        return collect($projects)->where('completed',$maxCompleted)->first();
    }

}
