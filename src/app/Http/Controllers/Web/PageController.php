<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\API\DonationController as DonationApi;
use App\Http\Controllers\API\ProjectController as ProjectApi;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\ProjectController as ProjectWeb;
use App\Jobs\TestJob;
use App\Mail\Enquiry;
use App\Mail\SendMail;
use App\Models\Donation;
use App\Models\ProjectInterval;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Vinkla\Hashids\Facades\Hashids;

class PageController extends Controller
{
    public function getProject1()
    {
        $project_1 = DB::table('configs')->whereName('project_1')->first()->value;
        $now       = now();
        $project   = ProjectInterval::with(['project','project.image'])->whereHas('project', function ($query) use ($project_1) {
            $query->where('status', 1);
            $query->where('display_on_home_status', 1);
            $query->where('id', $project_1);
        })
            ->whereDate('start_date', '<=', $now)
            ->whereDate('end_date', '>=', $now)
            ->first();
        if($project){
            return $project;
        }else{
            return $this->defaultProject();
        }
    }

    public function getProject2()
    {
        $project_2 = DB::table('configs')->whereName('project_2')->first()->value;
        $now       = now();
        $project   = ProjectInterval::with(['project','project.image'])->whereHas('project', function ($query) use ($project_2) {
            $query->where('status', 1);
            $query->where('id', $project_2);
        })
            ->whereDate('start_date', '<=', $now)
            ->whereDate('end_date', '>=', $now)
            ->first();
        if($project){
            return $project;
        }else{
            return $this->defaultProject();
        }
    }

    public function defaultProject(){
        $now = date_format(now(),'Y-m-d');
        return $project   = ProjectInterval::with(['project'])->whereHas('project', function ($query){
            $query->where('status', 1);
            $query->where('display_on_home_status', 1);
        })
            ->whereDate('start_date', '<=', $now)
            ->whereDate('end_date', '>=', $now)
            ->first();
    }

    public function index()
    {   
        $res      = ProjectApi::index()->getData();


        $projects = $res->data->projects;

        //  echo "<pre>";
        // print_r($projects);
        // exit;
        
        $data['project_1'] = $this->getProject1();
        $data['project_2'] = $this->getProject2();
        $data['maxCompleted'] = ProjectWeb::maxFunded();
        $data['intervals']    = array_slice($projects, 0, 6);

        // echo Auth::id();
        // exit;
        // $check_dummy_user_id = Auth::id();

        // $data['projects'] = Donation::with('project')->whereUserId($user->id)->distinct()->get(['project_id']);

        // $query_dummy_user = DB::table('users')->where('id', $check_dummy_user_id)->get();
        
        // $project_id = $query_dummy_user[0]->user_id;
        
        // $slug_query = DB::table('projects')->where('id', $project_id)->get();
        // exit;
        return view('index', ['data' => $data]);
    }

    public function about(){
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }

    public function postEnquiry(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required|max:255'
        ]);

        // check if reCaptcha has been validated by Google      
        $secret = env('GOOGLE_RECAPTCHA_SECRET');
        $captchaId = $request->input('g-recaptcha-response');
        
        //sends post request to the URL and tranforms response to JSON
        $responseCaptcha = json_decode(file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$captchaId));
        

        if($responseCaptcha->success == true) {
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['message'] = $request->message;
            Mail::to('enquiry@nimapinfotech.com')->send(new Enquiry($data));
            return back()->with('success','We received your message');
        } else {
            return back()->with('failed','Sorry, Recaptcha verification has failed.');
        }
    }

    public function profile()
    {
        return view('profile');
    }

    public function backCampaigns()
    {
        $user             = Auth::user();
        $data['projects'] = Donation::with('project')->whereUserId($user->id)->distinct()->get(['project_id']);
        foreach ($data['projects'] as $key => $project) {
            $data['totalDonated'][$key] = Donation::whereUserId($user->id)->whereProjectId($project->project_id)->sum('amount_donated');
        }

        return view('backed_campaigns', ['data' => $data]);
    }

    public function donations($projectId)
    {
        // $projectId         = Hashids::decode($projectId);
        $user              = Auth::user();
        $data['donations'] = Donation::whereUserId($user->id)->whereProjectId($projectId)->latest()->get();
        return view('donations', ['data' => $data]);
    }

    public function testJob()
    {
        for ($i = 0; $i < 5; $i++) {
            // Mail::to('sangeet@nimapinfotech.com')->send(new TestMail());
            TestJob::dispatch();
        }
    }

    public function autoDonate(Request $request)
    {

        $now       = now();
        $yesterday = $now->subDays(1);

        $users = User::whereColumn('balance', '>=', 'plan')->where('balance', '!=', 0)->get();
        foreach ($users as $user) {
            $donated = Donation::whereUserId($user->id)->whereDate('created_at', $yesterday)->exists();

            if (!$donated) {

                $interval = ProjectInterval::join('projects', function ($join) use ($now) {
                    $join->on('projects.id', '=', 'project_intervals.project_id')
                        ->where('projects.status', 1)
                        ->whereDate('project_intervals.start_date', '<=', $now)
                        ->whereDate('project_intervals.end_date', '>=', $now)
                        ->whereColumn('project_intervals.funded', '<', 'projects.target')
                        ->orderBy('completed', 'desc')
                        ->oldest();
                })
                    ->first();

                $request['user_id']     = $user->id;
                $request['project_id']  = $interval['project_id'];
                $request['interval_id'] = $interval['id'];
                $request['amount']      = $user->plan;
                $donation               = new DonationApi;
                $donation->store($request);
            }
        }
    }

    public function ngoEnquiry(Request $request){
        $request->validate([
            'ngo_name'=>'required',
            'contact_name'=>'required',
            'phone'=>'required|digits:10',
            'email'=>'required|email',
            'purposes'=>'required',
            'address'=>'required',
        ]);
        
        $data = $request->all();
        $data['view'] = 'ngo_enquiry';
        


        Mail::to('sangeet@nimapinfotech.com')->send(new SendMail($data));
        return back()->with('success','');
    }
 public function subscibed(Request $request){
        $request->validate([
            'email'=>'required|email',
        ]);
        
        $data = $request->all();
        $data['view'] = 'subscription_email';
$data['email_subject'] = 'User Subscription';


         Mail::to('enquiry@nimapinfotech.com')->send(new SendMail($data));
        return back()->with('subscribed','Thankyou for Subscribed');
    }

}
