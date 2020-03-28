<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\InvoiceController;
use App\Http\Controllers\Web\ProjectController as ProjectWeb;
use App\Jobs\RefundJob;
use App\Jobs\TestJob;
use App\Mail\RefundMail;
use App\Models\Donation;
use App\Models\Ngo;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Models\ProjectInterval;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Yajra\Datatables\Datatables;
use Yajra\Datatables\Services\DataTable;

class ProjectController1 extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function canModifyProject($projectId){
        $project = Project::findOrFail($projectId);
        $this->authorize('project', $project);
    }
    /******************************************
        List of all projects & filter project
    *******************************************/
    public function index(Request $request)
    {
        $this->authorize('permission','5|6');
        $data['daysLeft'] = $request->days_left;

        if($request->all()){
            $data['start'] = $request->start;
            $data['end'] = $request->end; 
            
            if(empty($data['start']) || empty($data['start']) ) {
                return back();
            }

            /*$data['projects'] = Project::whereDate('start_date','>=',date('Y-m-d', strtotime($request->start)))
            ->whereDate('end_date','<=',date('Y-m-d', strtotime($request->end)))->get(); */

            $data['projects'] = Project::with('user')->whereBetween('end_date',[date('Y-m-d', strtotime($request->start)),date('Y-m-d', strtotime($request->end))]);
            if(Auth::user()->role_id == 2){
                $data['projects']->whereUserId(Auth::id());
            }
            $data['projects'] = $data['projects']->latest()->get(); 

        }
        else{
            $data['projects'] = Project::with('user');
            if(Auth::user()->role_id == 2){
                $data['projects']->whereUserId(Auth::id());
            }
            $data['projects'] =  $data['projects']->latest()->get();

            
        }
        
        return view('admin.all_projects',['data'=>$data]);
    }

    public function completedProjects(){
        $data['projects'] = ProjectInterval::with(['project','payments'])->whereDate('end_date','<=',date('Y-m-d'))->orderBy('end_date','desc')
        ->whereHas('project',function($query){
            $query->where('status',1);
        })->get();

        return view('admin.completed_projects',['data'=>$data]);
    }

    

    /*****************************************
        Project insert form   
     ****************************************/
    public function create(Request $request)
    {
        $userId = Auth::id();
        $ngoDetails = NGO::where('user_id', $userId)->first();

        $this->authorize('permission','6');
        $ngos = User::whereRoleId(2)->get(['id','name']);
        $data['ngo'] = [];
        $data['ngo'][''] = 'Select';
        foreach($ngos as $ngo){
            $data['ngo'][ $ngo['id'] ] = $ngo['name'];
        }
        $data['formData']['user_id'] = isset($request->id)?$request->id : null;
        // return $data['ngo'];
        return view('admin.create_project',['data'=>$data,$ngoDetails]);
    }

    public function validateStoreProject($request){
        $messages = [
            'user_id.required' => 'The NGO field is required.',
            'recurring_days.required_if' => 'The recurring days are required.'
            // 'images.image' => 'Upload sssimage only.'
        ];

        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required|max:144',
            'goal' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => ['required','date'],
            'is_recurring' => [Rule::in(['yes','no'])],
            'recurring_days'=>['nullable','required_if:is_recurring,true','numeric',function($attribute, $value, $fail) use($request){
                $start = explode('-', $request->start_date);   
                $end = explode('-', $request->end_date);   
                $dt1 = Carbon::create($start[2], $start[1], $start[0]);
                $dt2 = Carbon::create($end[2], $end[1], $end[0]);
                $diff = $dt1->diffInDays($dt2);   
                if($value > $diff){
                    $fail('invalid recurring days.');
                }
            }],
            // 'recurring_in'=>[Rule::in([1, 7,30])],
            'video_link' => 'nullable|url',

            'images' => 'required',
            'images.*' => 'required|image|max:500',
        ],$messages);

        if(Auth::user()->role_id == 1){
            $validatedData = $request->validate([
                'user_id' => 'required',
            ],$messages);
        }
    }

    /**************************
        Insert Project
     **************************/
    public function commission(){
        return $commission = DB::table('configs')->where('name','commission')->first()->value;
    }

    public function store(Request $request)
    {
        $this->authorize('permission','6');
        // return $request;
        $this->validateStoreProject($request);
        
        if(count($request->file('images')) > 5 ){
            return back()->withInput()->withErrors(['Upload upto 5 images.']);;
        }
        $commission = DB::table('configs')->where('name','commission')->first()->value;
        $formData = $request->except(['_token']);
        $formData['user_id'] = isset($request->user_id)? $request->user_id: Auth::id();
        $formData['target'] = $request->goal + $this->calCharges($request->goal, $commission);
        $formData['recurring_days'] = $request->recurring_days;
        
        $transaction = DB::transaction(function () use($formData, $request) {
            $project = Project::create($formData);
            $this->storeProjectIntervals($request, $project['id']);

            if(isset($request->images)){
                $imgPath = $this->uploadImages($request->file('images'), $project['id'] );
            }
        });
        session()->flash('success','Project Added Successfully!');
        // return redirect()->route('projects.index')->with('success','Project Added Successfully!');
        return response()->json([
            'status'=>200
        ]);
    }
    /****************************************
        Calculation of target goal
        Commission (x) = goal * 0.10%
        GST on commission (y) = x * 18%
        PG (z) = (goal + x + y) * 2%
        Total = goal + x + y + z
    *****************************************/
    public static function calCharges($goal,$commission){

        $x = $goal * ($commission/100) ; // Our Commission
        // $x = $goal * (0.10/100*100) ; // Our Commission
        $y = $x * (18/100); // GST on commission
        $z = ($goal + $x + $y) * 2/100; // 2% PG charges
        $charges = $x + $y + $z;
        return round($charges);
        return $target = round($goal + $x + $y + $z); 
    }

    public function storeProjectIntervals($request, $projectId){
        // dd($request);
        // return;
        $startDate = explode('-',$request->start_date);
        $endDate = explode('-',$request->end_date);
        $days = $request->recurring_days;

        $projectStart = Carbon::create($startDate[2], $startDate[1], $startDate[0], 0); // Project start date
        $projectEnd = Carbon::create($endDate[2], $endDate[1], $endDate[0], 0); // Project end date

        $start = Carbon::create($startDate[2], $startDate[1], $startDate[0], 0); // recurring start date
        $tempEnd = Carbon::create($start->year, $start->month, $start->day, 0); // recurring end date
        $end = $tempEnd->addDays($days-1); // recurring end date

        $interval = new ProjectInterval;
        $interval->project_id = $projectId;
        $interval->start_date = $start;
        $interval->end_date = $request->is_recurring== 'yes' ?$end : $projectEnd;
        $interval->funded = 0;
        $interval->save();

        if($request->is_recurring == 'yes'){

            while(true){

                if($end->greaterThanOrEqualTo($projectEnd)){
                    break;
                }

                $start = $end->addDays(1);
                $temp = Carbon::create($start->year, $start->month,$start->day,0);
                $end = $temp->addDays($days-1);

                if($end->greaterThanOrEqualTo($projectEnd)){
                    $end = $projectEnd;
                }  

                $interval = new ProjectInterval;
                $interval->project_id = $projectId;
                $interval->start_date = $start;
                $interval->end_date = $end;
                $interval->funded = 0;
                $interval->save();
            }
        }
    }

    /************************************
        Extend project end date
    *************************************/
    public function validateEndDate($request, $project){

        $inputEndtDate = explode('-',$request->end_date);
        $inputEndtDate = Carbon::create($inputEndtDate[2], $inputEndtDate[1], $inputEndtDate[0], 0);

        $endDate = explode('-',$project['end_date']);
        $projectEnd = Carbon::create($endDate[2], $endDate[1], $endDate[0], 0);

        if($inputEndtDate->lessThanOrEqualTo($projectEnd)){
            return true;
        }
    }

    public function extendEndDate(Request $request, $id){
        // $project = Project::whereId($id)->update(['end_date'=>$request->end_date]);
        $project = Project::findOrFail($id);
        if($this->validateEndDate($request, $project)){
            return back()->withErrors(['end_date'=>'The end date should not be less than or equal to '.$project['end_date']])->withInput();
        }
        

        if($request->is_recurring == 'yes'){
            $startDate = explode('-',$project['end_date']);
            $projectStart = Carbon::create($startDate[2], $startDate[1], $startDate[0], 0); // Project start date
            $startDate = $projectStart->addDays(1);
            $startDate = date_format($startDate,"d-m-Y");
            $data = $request;
            $data['start_date'] = $startDate;
            $this->storeProjectIntervals($data,$id);
        }else{
            $interval = ProjectInterval::whereProjectId($id)->first();
            $interval->end_date = date("Y-m-d", strtotime($request->end_date));
            $interval->save();
        }

        $project->end_date = $request->end_date;
        $project->save();

        return back();

        
    }

    public function uploadImages($images,$projectId){
        
        foreach($images as $image){
            $imgPath = $image->store(null);
            ProjectImage::create(['name'=>$imgPath, 'project_id'=>$projectId]);        
        }
    }

    /****************************
        Disaply project details
     ***************************/
    public function show($id)
    {
        $this->authorize('permission','5|6');

        $this->canModifyProject($id);   
        $now = date_format(now(),'Y-m-d');     
        $data['project'] = Project::with(['user','image'])->findOrFail($id);
        $data['contributors'] = Donation::with('user')->whereProjectId($id)->get()->unique('user_id');
        $data['donations'] = Donation::with('user')->whereProjectId($id)->get();
        $data['intervals'] = ProjectInterval::whereProjectId($id)->whereDate('start_date','<=',$now)->oldest()->get();       

        // dd($data['project']->user_id === Auth::id());
        return view('admin.show_project',['data'=>$data]);
    }

    /*************************************
        Edit project form
    *************************************/
    public function edit($id)
    {
        $this->authorize('permission','6');
        $this->canModifyProject($id);

        $data['project'] = Project::with('image')->findOrFail($id);
        $data['project']['recurring_days'] = $data['project']['recurring_days'];
        // dd(date('Y-m-d'));
        // return $data['project']->start_date;
        $start = explode('-',$data['project']->start_date);
        $now = Carbon::now();
        $start = Carbon::create($start[2],$start[1],$start[0]);
        // return $start;
        $isActive = $now->greaterThanOrEqualTo($start);
        


        $ngos = User::whereRoleId(2)->get(['id','name']);
        $data['ngo'] = [];
        $data['ngo'][''] = 'Select';
        foreach($ngos as $ngo){
            $data['ngo'][ $ngo['id'] ] = $ngo['name'];
        }

        
        if($data['project']['status'] != 1 && !$isActive){
            return view('admin.edit_project',['data'=>$data]);
        }else{
            return view('admin.edit_active_project',['data'=>$data]);
            
        }
    }

    public function validateUpdateProject($request){
        
        $messages = [
            'user_id.required' => 'The NGO field is required.'
            // 'images.image' => 'Upload sssimage only.'
        ];

        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'goal' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'is_recurring' => [Rule::in(['yes','no'])],
            'recurring_days'=>['nullable','required_if:is_recurring,true','numeric',function($attribute, $value, $fail) use($request){
                $start = explode('-', $request->start_date);   
                $end = explode('-', $request->end_date);   
                $dt1 = Carbon::create($start[2], $start[1], $start[0]);
                $dt2 = Carbon::create($end[2], $end[1], $end[0]);
                $diff = $dt1->diffInDays($dt2);   
                if($value > $diff){
                    $fail('invalid recurring days.');
                }
            }],
            // 'recurring_in'=>[Rule::in([1, 7,30])],

            'video_link' => 'nullable|url',
        ],$messages);

        if(Auth::user()->role_id == 1){
            $validatedData = $request->validate([
                'user_id' => 'required',
            ],$messages);
        }
    }

    public function update(Request $request, $id)
    {

        // return $this->calCharges(3000,10);
        $this->authorize('permission','6');
        $this->canModifyProject($id); // Check authorization
        $this->validateUpdateProject($request);// Validate fields
        $project = Project::findOrFail($id);
        $commission = isset($request->commission) ? $request->commission : $project->commission;
        $formData = $request->except('_token','recurring_in'); 
        $formData['target'] = $request->goal + $this->calCharges($request->goal, $commission);
        $formData['recurring_days'] = $request->recurring_days;

        if($project['start_date'] != $request->start_date || $project['end_date'] != $request->end_date || $project['recurring_days'] != $request->recurring_days){
            ProjectInterval::whereProjectId($id)->delete();
            $this->storeProjectIntervals($request, $id);
        }
        $project->update($formData);
        return redirect()->route('projects.index')->with('success','Project updated successfully!');
    }
    /*
    ----------------------------------
        Upload Image On Edit Project
    ----------------------------------
    */
    public function updateImage(Request $request){
        // return $request;
        
        if(isset($request->images)){
            $imgPath = $this->uploadImages($request->file('images'), $request->id );
        }

        /*****************************************
            Convert to image from base64 format
        ******************************************

        foreach($request->base as $image){
            if(!empty($image)){
                // echo '<img src="'.$image.'">';
                $data = explode(',', $image);
                $img = base64_decode($data[1]);
                $imgName = $this->getImgName();
                $imgPath = Storage::put($imgName, $img);
                // $imgPath = $image->store(null);
                ProjectImage::create(['name'=>$imgName, 'project_id'=>$request->id]);  
            }      
        }

        ****************************/

        return back();
    }

    public function getImgName(){
        
        while(true){
            $imgName = str_random(40);
            $count = DB::table('project_images')->where('name',$imgName)->count();
            if($count == 0){
                break;
            }
        }
        return $imgName.'.jpg';
        
    }

    public function updateStatus(Request $request){

        // $this->authorize('ngo');
        $this->authorize('permission','6');
        $status = $request->status == 'true'?1:0;
        $project = Project::findOrFail($request->id);
        $project->status = $status;
        $project->save();
        return response($project,200);

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

    public function destroyImage($imgId){
        // public_path();
        // Storage::disk('public')->allFiles('uploads');
        $image = ProjectImage::findOrFail($imgId);
        Storage::disk('public')->delete($image->name);
        ProjectImage::destroy($imgId);
        return back();
    }

    public function refund(Request $request){

        // fund status: 1 = refund
        // fund status: 2 = transfer
        ProjectInterval::whereId($request->id)->update(['fund_status'=>1]);
        $users = Donation::with('user')->whereProjectIntervalId($request->id)->select('user_id')->distinct()->get();
        
        $data['project'] = ProjectWeb::maxFunded();
        foreach($users as $user){
            $data['user'] = $user->user;
            // calc total amount donated
            $amountDonated = Donation::whereProjectIntervalId($request->id)->whereUserId($user->user_id)->where('status',0)
            ->sum('amount_donated');
            // update donation table
            Donation::whereProjectIntervalId($request->id)->whereUserId($user->user_id)->update(['status'=>1]);
            // refund to user
            User::whereId($user->user_id)->increment('balance', $amountDonated);
            // refund job to send mail
            RefundJob::dispatch($data);
            
            
        }
        return back();

    }

    public function mailReceipt(Request $request){

        // return $request;
        $users = Donation::with('user')->whereProjectIntervalId($request->interval_id)->select('user_id')->distinct()->get();
        foreach($users as $user){
            $request['user_id'] = $user->user_id;
            InvoiceController::mailInvoice($request, 0);
        }

        return redirect('admin/completed-projects');

        
    }
    /*public function postIndex(){

        $projects = Project::all();
        
        return Datatables::of($projects)
        
            ->addColumn('action', function ($projects) {
                return '<a href="#view-'.$projects->id.'">
                <button type="button" class="btn btn-info btn-outline btn-circle btn-sm m-r-5" title="View"><i class="ti-eye"></i></button></a> 

                <a href="#edit-'.$projects->id.'">
                <button type="button" class="btn btn-info btn-outline btn-circle btn-sm m-r-5" title="Edit"><i class="ti-pencil-alt"></i></button></a>';
            })->editColumn('days_left', function ($projects) {
                $date1 = now();
                $date2 = $projects->end_date;
                return $date1->diffInDays($date2);

            })->editColumn('status', function ($projects) {
                return '<input type="checkbox" checked class="js-switch" data-color="#99d683" />';
            })->editColumn('start_date', function ($projects) {
                return date_format(date_create($projects->start_date),'d-m-Y');
            })->editColumn('end_date', function ($projects) {
                return date_format(date_create($projects->end_date),'d-m-Y');
            })
            ->rawColumns(['status','action'])->make(true);
    }*/
}
