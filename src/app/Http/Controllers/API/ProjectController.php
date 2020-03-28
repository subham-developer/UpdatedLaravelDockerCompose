<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectInterval;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function index()
    {
        
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
                                    ->with(['project.image','project.user:id,name,profile_image'])
                                ->get();
            
        return response()->json([
            'status' => 200,
            'data' => $data
        ]);
    }

    public static function search(Request $request){
        
        $request = $request->all();
        $now = date_format(now(),'Y-m-d');
        $data['projects'] = ProjectInterval::join('projects', function ($join) use($now,$request) {
                                        $join->on('projects.id', '=', 'project_intervals.project_id')
                                        ->where('projects.status',1)
                                        ->where(function($query) use($request){
                                            $query->orWhere('projects.title','like', '%'.$request['search'].'%')
                                            ->orWhere('projects.description','like', '%'.$request['search'].'%');
                                        })
                                        // ->where('projects.title','like', '%'.$request['search'].'%')
                                        // ->orwhere('projects.description','like', '%'.$request['search'].'%')
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
                                    ->get();
        return response()->json([
            'status' => 200,
            'data' => $data
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['project'] = Project::with(['image','user','comment'])->find($id);
        return response()->json([
            'status' => 200,
            'data' => $data
        ]);
    }

    public function longDescription($projectId){
        $data['project'] = Project::find($projectId);
        return view('admin.long_description',['data'=>$data]);
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
