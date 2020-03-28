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
use Session;
class ProjectController extends Controller
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

            $data['projects'] = Project::with(['user','interval' => function($query){
              $query->whereDate('end_date','>=',date('Y-m-d'));
              $query->whereDate('start_date','<=',date('Y-m-d'));
            }])->whereBetween('end_date',[date('Y-m-d', strtotime($request->start)),date('Y-m-d', strtotime($request->end))]);

            if(Auth::user()->role_id == 2){
              $data['projects']->whereUserId(Auth::id());
            }
            $data['projects'] = $data['projects']->latest()->get(); 
          }
          else{
            $data['projects'] = Project::with(['user','interval' => function($query){
              $query->whereDate('end_date','>=',date('Y-m-d'));
              $query->whereDate('start_date','<=',date('Y-m-d'));
            }]);
            if(Auth::user()->role_id == 2){
              $data['projects']->whereUserId(Auth::id());
            }elseif(Auth::user()->role_id == 14){
              $data['projects']->whereUserId(Auth::id());
            }
            $data['projects'] =  $data['projects']->latest()->get();
          }

        // print_r($data['projects']->toArray());exit;

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
          return view('admin.create_project',['data'=>$data,'ngoDetails'=>$ngoDetails]);

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


            'video_link'=>[function($attribute, $value, $fail) use($request){

              $v_link  = $request->video_link;
              if(!empty($v_link)){

                $strexist = strstr($v_link, 'youtube');

                if(empty($strexist)){

                  $fail('Please enter valid video link.');
                }

              }

            }],
            
            
            // 'recurring_in'=>[Rule::in([1, 7,30])],
            //'video_link' => 'nullable|url|regex:/^https:\/\/(?:www\.)?youtube.com/',
           // 'video_link' => 'regex:/^(youtube.com|youtu.be)\/(watch)?(\?v=)?(\S+)?/',

            // 'feature_image.' => 'required',
            // 'cover_image' => 'required',
            // 'images' => 'required',
            'feature_image.*' => 'required|image|max:500',
            'cover_image.*' => 'required|image|max:500',
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
        // echo "string";
        // exit;
          if(isset($request->cover_image) && isset($request->feature_image))  {    
            $this->authorize('permission','6');
        // return $request;
            $this->validateStoreProject($request);

        // if(count($request->file('images')) > 7 ){
        //     return back()->withInput()->withErrors(['Upload upto 6 images.']);
        // }
            $commission = DB::table('configs')->where('name','commission')->first()->value;
            $formData = $request->except(['_token']);
            $formData['user_id'] = isset($request->user_id)? $request->user_id: Auth::id();
            $formData['target'] = $request->goal + $this->calCharges($request->goal, $commission);
            $formData['recurring_days'] = $request->recurring_days;
            $formData['commission'] = $request->commission;
            $formData['slug'] = $this->slugify($request->title);

            $transaction = DB::transaction(function () use($formData, $request) {
              $project = Project::create($formData);
              $this->storeProjectIntervals($request, $project['id']);

              if(isset($request->images)){
                $imgPath = $this->uploadImages($request->file('images'), $project['id'] );
              }
              if(isset($request->feature_image)){
                $imgPath = $this->uploadFeaturedImage($request->file('feature_image'), $project['id']);
              }

              if(isset($request->cover_image)){
                $imgPath = $this->uploadCoverImages($request->file('cover_image'), $project['id'] );
              }
            // $this->uploadImages('feature_image'.$request->file('feature_image'), $project['id'] );
            // $this->uploadImages('cover_image'.$request->file('cover_image'), $project['id'] );
            });
            session()->flash('success','Project Added Successfully!');
        // return redirect()->route('projects.index')->with('success','Project Added Successfully!');
            return response()->json([
              'status'=>200
            ]);
          }
          else{
            return response()->json([
              'status'=>201
            ]);
          }
        }

        public function slugify($text)
        {
        // replace non letter or digits by -
          $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        // transliterate
          $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
          $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
          $text = trim($text, '-');

        // remove duplicate -
          $text = preg_replace('~-+~', '-', $text);

        // lowercase
          $text = strtolower($text);

          if (empty($text)) {
            return 'n-a';
          }

          return $text;
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
        //return $target = round($goal + $x + $y + $z); 
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

        // if($inputEndtDate->lessThan($projectEnd)){
          if($inputEndtDate->lessThanOrEqualTo($projectEnd)){
            return true;
          }
        }

        public function extendEndDate(Request $request, $id){
          $request->validate([
            'end_date' => 'required',            
          ]);
        // $project = Project::whereId($id)->update(['end_date'=>$request->end_date]);
          $project = Project::findOrFail($id);
          if($this->validateEndDate($request, $project)){
            return back()->withErrors(['end_date'=>'The end date should not be less than or equal to '.$project['end_date']])->withInput();
          }

        // if($request->is_recurring == 'yes'){
          if(!empty($project['recurring_days'])){
            // recurring project
            $startDate = explode('-',$project['end_date']);
            $projectStart = Carbon::create($startDate[2], $startDate[1], $startDate[0], 0); // Project start date
            $startDate = $projectStart->addDays(1);
            $startDate = date_format($startDate,"d-m-Y");
            $data = $request;
            $data['start_date'] = $startDate;
            $this->storeProjectIntervals($data,$id);
          }else{
            // non recurring project
            $interval = ProjectInterval::whereProjectId($id)->first();
            $interval->end_date = date("Y-m-d", strtotime($request->end_date));
            $interval->save();
          }

          $project->end_date = $request->end_date;
          $project->save();
//        return redirect()->route('projects.index');

          return back()->with('success','Date updated successfully!');
        }

        public function uploadImages($images,$projectId){
          foreach($images as $image){
            $imgPath = $image->store(null);
            ProjectImage::create(['name'=>$imgPath, 'project_id'=>$projectId, 'image_type'=>'slide']);        
          }
        }

        public function uploadFeaturedImage($images, $projectId){
          foreach($images as $image){
            $imgPath = $image->store(null);
            ProjectImage::create(['name'=>$imgPath, 'project_id'=>$projectId, 'image_type'=>'feature']);
          }
        }

        public function uploadCoverImages($images,$projectId){
          foreach($images as $image){
            $imgPath = $image->store(null);
            ProjectImage::create(['name'=>$imgPath, 'project_id'=>$projectId, 'image_type'=>'cover']);        
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
          $data['intervals'] = ProjectInterval::whereProjectId($id)->whereDate('start_date','<=',$now)
          ->orderBy('id','desc')->get();

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

          $data['project'] = Project::with('image')->orderBy('id','DESC')->findOrFail($id);
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

        public function fund(Request $request){
          $projects = Project::get()->where('id', $request->id)->first();

          return view('admin.add_fund',['data'=>$projects]);
        }

        public function submitfund(Request $request){
          $this->validate(request(), [
            'fund_amount' => 'required|numeric|min:0|not_in:0',
          ]);
        // dd($request);
          $projects = Project::get()->where('id', $request->project_id)->first();

          $intervals = ProjectInterval::whereProjectId($request->project_id)->whereDate('start_date','<=',now())->whereDate('end_date','>=',now())->oldest()->get()->first();

          $interval_donation = DB::table('donations')
          ->select(
            DB::raw('sum(amount_donated) as donated_amount')
          )
          ->where('project_interval_id', '=', $intervals->id)
          ->first();

          $now = date("d-m-Y");
          $datetime1 = date_create($now);
          $datetime2 = date_create($intervals->end_date);
          $interval = date_diff($datetime1, $datetime2);
          $days_left = (int)$interval->format('%R%a')+1;

          $total_fund_days = abs($projects->recurring_days - ($days_left-1));
          $max_fund_amount = (int)(($projects->target/$projects->recurring_days)*$total_fund_days) - $interval_donation->donated_amount;

        // echo $interval;
        // echo "<br>";
        // echo $intervals->end_date;
        // echo "<br>";
        // echo $projects->recurring_days;
        // echo "<br>";
        // echo $days_left;
        // echo "<br>";
        // echo $total_fund_days;
        // echo "<br>";
        // echo $projects->target;
        // echo "<br>";
        // echo $projects->recurring_days;
        // echo "<br>";
        // echo $interval_donation->donated_amount;
        // echo "<br>";
        // echo $max_fund_amount;
        // exit;

          if ($max_fund_amount < $request->fund_amount) {
            // if ($max_fund_amount == 0) {
            //   Session::flash('fund_limit_msg', 'As of now Fund allocation has been fulfilled');
            //   return redirect('admin/projects/fund?id='.$request->project_id);
            // }else{    
            Session::flash('fund_limit_msg', 'Max fund limit is '.$max_fund_amount);
            return redirect('admin/projects/fund?id='.$request->project_id);
            // }
          }else{
            // echo"12";
            $users = DB::table('users')
            ->select('users.*')
            ->leftJoin('donations','users.id','donations.user_id')
                    // ->whereDate('donations.created_at', '<', Carbon::now())
                    // ->where('donations.project_id','!=',$request->project_id)
            ->whereNOTIn('users.id',function($query){
             $query->select('donations.user_id')->from('donations')->whereDate('donations.created_at',Carbon::now());
           })
            ->distinct('users.id')
            ->orderBy('users.id', 'asc')
            ->get();

            $added_fund = 0;
            if(!$users->isEmpty()){
              foreach ($users as $key => $value) {
                    // if(!$value->isEmpty()){
                    // echo "<pre>"; print_r($value);

                $added_fund = $added_fund + $value->plan;
                if($request->fund_amount >= $added_fund){
                            // print_r("--11--+++");
                            //************* Update Project Table ***********
                  $cur_projects = DB::table('projects')->where('id', $projects->id)->first();
                  $funded = $cur_projects->funded + $value->plan;
                  DB::table('projects')
                  ->where('id', $projects->id)
                  ->update(['funded' => $funded]);

                            // ************ End Update Project Table *********

                            //************* Update Interval Table ***********
                  $cur_interval_record = DB::table('project_intervals')->where('id', $intervals->id)->first();
                  $funded = $cur_interval_record->funded + $value->plan;
                  $completed = (($funded*100)/$cur_projects->target);
                  DB::table('project_intervals')
                  ->where('id', $intervals->id)
                  ->update(['funded' => $funded,'completed'=>$completed]);

                            // *********** End Update Interval Table *********

                            //  ********* Insert Donation table entry ********
                  $donationData=array('user_id'=>$value->id,"project_id"=>$projects->id,"project_interval_id"=>$intervals->id,"amount_donated"=>$value->plan,"status"=>0);
                  DB::table('donations')->insert($donationData);

                            //  ********** End Donation **************

                            // *********** Update balance in User table *******
                  $balance = $value->balance - $value->plan;
                  DB::table('users')
                  ->where('id', $value->id)
                  ->update(['balance' => $balance]);
                            // *********** End User balance Update ********
                            // dd($cur_interval_record);
                }else{
                  return redirect('admin/projects')->with('success', 'Fund donated successfully!');
                }
                    // }else{
                    //     return redirect('admin/projects')->with('success', 'Fund donated successfully!');
                    // }
              }
                // Session::flash('fund_limit_msg', 'There is no user exist to add fund.');
                // return redirect('admin/projects/fund?id='.$request->project_id);
              return redirect('admin/projects')->with('success', 'Fund donated successfully!');
            }else{
              Session::flash('fund_limit_msg', 'There is no user exist to add fund.');
              return redirect('admin/projects/fund?id='.$request->project_id);
            }
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
            
            // 'feature_image' => 'required',
            // 'cover_image' => 'required',
            // 'images' => 'required',
            'feature_image.*' => 'required|image|max:500',
            'cover_image.*' => 'required|image|max:500',
            'images.*' => 'required|image|max:500',
            // 'recurring_in'=>[Rule::in([1, 7,30])],

            'video_link' => 'nullable|url|regex:/^http:\/\/(?:www\.)?youtube.com/',
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
        // $validatedData = $request->validate([
        //     'feature_image' => 'required|image|max:500',
        //     'cover_image' => 'required|image|max:500',
        //     'images.*' => 'required|image|max:500',
        // ]);

      if(isset($request->images)){
       $validatedData = $request->validate([
        'images.*' => 'required|image|max:500'
      ]);
       $imgPath = $this->uploadImages($request->file('images'), $request->id );
     }

     if(isset($request->feature_image)){
       $validatedData = $request->validate([
        'feature_image.*' => 'required|image|max:500'
      ]);
       $imgPath = $this->uploadFeaturedImage($request->file('feature_image'), $request->id);
     }

     if(isset($request->cover_image)){
       $validatedData = $request->validate([
        'cover_image.*' => 'required|image|max:500'
      ]);
       $imgPath = $this->uploadCoverImages($request->file('cover_image'), $request->id );
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

        return back()->with('success','Image updated successfully!');
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
        // fund status: 1 = refund
        // fund status: 2 = transfer

        DB::transaction(function () use($request) {
          $this->authorize('permission','6');
          $status = $request->status == 'true'?1:0;
          $project = Project::findOrFail($request->id);
          $project->status = $status;
          $project->save();
          if($request->status == 'false') {
           ProjectInterval::whereId($request->id)->update(['fund_status' => 1]);
//            print_r($request->status); exit;
           $users = Donation::with('user')->whereProjectIntervalId($request->id)->select('user_id')->distinct()->get();

           $data['project'] = ProjectWeb::maxFunded();
           foreach ($users as $user) {
            $data['user'] = $user->user;
                // calc total amount donated
            $amountDonated = Donation::whereProjectIntervalId($request->id)->whereUserId($user->user_id)->where('status', 0)
            ->sum('amount_donated');
                // update donation table
            Donation::whereProjectIntervalId($request->id)->whereUserId($user->user_id)->update(['status' => 1]);
                // refund to user
            User::whereId($user->user_id)->increment('balance', $amountDonated);
                // refund job to send mail
            RefundJob::dispatch($data);


          }
        }

        return response($project,200);
      });

      }

      public function updateHomeStatus(Request $request){
        DB::transaction(function () use($request) {
          $this->authorize('permission','6');

          if($request->display_on_home_status == 'true') {
            Project::where('display_on_home_status', 1)->update(array('display_on_home_status' => 0));
          }

          $status = $request->display_on_home_status == 'true'?1:0;
          $project = Project::findOrFail($request->id);
          $project->display_on_home_status = $status;
          $project->save();

          return response($project,200);
        });
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

        // echo "<pre>";
        // print_r($request->interval_id);
        // exit;
        // return $request;
      $users = Donation::with('user')->whereProjectIntervalId($request->interval_id)->select('user_id')->distinct()->get();

      $query = DB::table('project_intervals')->where('id', $request->interval_id)->get();
      $project_id = $query[0]->project_id;

      foreach($users as $user){
        $request['user_id'] = $user->user_id;
        InvoiceController::mailInvoice($request, $project_id);
      }

      return redirect('admin/completed-projects');


    }

    public function updateInfo(Request $request, $projectId)
    {
      $request['slug'] = $this->slugify($request['title']);

      $request->validate([
        'title' => 'required|unique:projects,title,'.$projectId,
        'slug' => 'required|unique:projects,slug,'.$projectId,
        'goal' => 'required|integer',
        'description' => 'required',
        'long_description' => 'required',
      ]);


      $project = Project::findOrFail($projectId);

      $goal = $request['goal'];
      $charges = $this->calCharges($goal,$project['commission']);
      $target = $goal + $charges;

      $project->title = $request['title'];
      $project->slug = $request['slug'];
      $project->description = $request['description'];
      $project->long_description = $request['long_description'];
      $project->goal = $goal;
      $project->target = $target;
      $project->save();

      return back()->with('success','Project updated successfully!');
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
