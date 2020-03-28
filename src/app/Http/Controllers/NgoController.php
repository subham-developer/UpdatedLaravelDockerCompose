<?php

namespace App\Http\Controllers;

use App\Mail\NgoCreated;
use App\Models\Ngo;
use App\Models\Project;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Yajra\Datatables\Datatables;


class NgoController extends Controller
{
    /**
     * Display a listing of the resource----
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
    }

    public function projectCounts($ngos){
        $projectCounts= [];
        foreach($ngos as $key=>$ngo){
            $now = date('Y-m-d');
            $projectCounts[$key]['ngo_id'] = $ngo['id'];
            $projectCounts[$key]['active'] = Project::whereUserId($ngo['id'])->whereStatus(1)->whereDate('start_date','<=',$now)
                                        ->whereDate('end_date','>=',$now)->count();

            $projectCounts[$key]['pending'] = Project::whereUserId($ngo['id'])->whereStatus(0)->count();

            $projectCounts[$key]['fullfilled'] = Project::join('project_intervals', 'projects.id', '=', 'project_intervals.project_id')
            ->whereUserId($ngo['id'])->whereColumn('project_intervals.funded','>=','projects.target')->count();

            $projectCounts[$key]['partialFullfilled'] = Project::join('project_intervals', 'projects.id', '=', 'project_intervals.project_id')
            ->whereUserId($ngo['id'])->whereStatus(1)->whereDate('projects.end_date','<',$now)->whereColumn('project_intervals.funded','<','projects.target')->count();

            $projectCounts[$key]['actionRequired'] = Project::join('project_intervals', 'projects.id', '=', 'project_intervals.project_id')
            ->whereUserId($ngo['id'])->whereStatus(1)->whereDate('projects.end_date','<',$now)->whereColumn('project_intervals.funded','<','projects.target')->where('project_intervals.funded','>',0)->count();
        }
        return $projectCounts;
    }

    public function index()
    {
        $this->authorize('permission','3|4');

        $data['ngo'] = User::with(['ngo','intervals','projects'])->whereRoleId(2)->latest()->get(['id','name']);
        $data['projectCounts'] = $this->projectCounts($data['ngo']);
        return view('admin.all_ngo',['data'=>$data]);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('permission','4');
        return view('admin.create_ngo');
    }

    public function validateNgo($request){
        $validatedData = $request->validate([
            'name' => 'required',
            'logo' => 'nullable|image'   ,
            'address' => 'required',
            'registration_date' => 'required|date_format:d-m-Y',
            'registration_number' => 'required',
            'email' => 'required|email|unique:users,email',
            //'mobile' => 'required|digits:10',
            'mobile' => 'required|digits:10|unique:users,mobile|regex:/^[1-9]{1}[0-9]{9}?/',
            'landline' => 'nullable|digits_between:8,11',
            'password' => 'required',
            'pancard' => 'required',
            'certificate' => 'required',
            'charity_registration_certificate' => 'required',
            'dead' => 'required',
            'dummyname' => 'required',
            'dummymobile' => 'required|digits:10',
            'dummypassword'=> 'required',
            'dummyemail' => 'required|email|unique:users,email',
            'dummyaddress'=>'required',
            'contacts.*.name' => 'required|string',
            'contacts.*.number' => 'required|digits:10',
            'contacts.*.email' => 'required|email',
            'contacts.*.designation' => 'required',
            'NgoBankDetails.*.bank_name' => 'required',
            'NgoBankDetails.*.account_number' => 'required|numeric',
            'NgoBankDetails.*.beneficiary_name' => 'required',
            'NgoBankDetails.*.ifsc' => 'required',
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function contacts($contacts){
        $formContacts =  $contacts;
        $contacts = [];
        foreach($formContacts as $contact){
            $obj['name'] = $contact['name'];
            $obj['contact'] = $contact['number'];
            $obj['email'] = $contact['email'];
            $obj['designation'] = $contact['designation'];
            array_push($contacts, $obj);
        }
       return json_encode($contacts);
    }

    public function NgoBankDetails($bank_details){
//print_r($bank_details);  exit;
        $formbankdetails =  $bank_details;
        $bank_details = [];
        foreach($formbankdetails as $bank_detail){
//            print_r($bank_detail);  exit;
            $obj['bank_name'] = $bank_detail['bank_name'];
            $obj['account_number'] = $bank_detail['account_number'];
            $obj['beneficiary_name'] = $bank_detail['beneficiary_name'];
            $obj['ifsc'] = $bank_detail['ifsc'];
            array_push($bank_details, $obj);
        }
//        print_r(json_encode($bank_details));  exit;

        return json_encode($bank_details);
    }

   public function store(Request $request)
    {
        $this->authorize('permission','4');
        $this->validateNgo($request); // validate data
        DB::transaction(function () use($request) {
        $logo = isset($request->logo)?$request->logo->store(null) : null;
        $pancard = isset($request->pancard)?$request->pancard->store(null) : null;
        $certificate = isset($request->certificate)?$request->certificate->store(null) : null;
        $charity_registration_certificate = isset($request->charity_registration_certificate)?$request->charity_registration_certificate->store(null) : null;
        $dead = isset($request->dead)?$request->dead->store(null) : null;
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->password = bcrypt($request->password);
        $user->role_id = 2;
        $user->profile_image = $logo;
        $user->save();
        $ngo_inserted_id = $user->id;

        $ngo['address'] = $request->address;
        $ngo['landline'] = $request->landline;
        $ngo['registration_date'] = $request->registration_date;
        $ngo['registration_number'] = $request->registration_number;

        $ngo['bank_name'] = $request->bank_name;
        $ngo['account_number'] = $request->account_number;
        $ngo['beneficiary_name'] = $request->beneficiary_name;
        $ngo['ifsc'] = $request->ifsc;

        $ngo = new NGO($ngo);
        $ngo->pancard = $pancard;
        $ngo->certificate = $certificate;
        $ngo->charity_registration_certificate = $charity_registration_certificate;
        $ngo->dead = $dead;
        if(isset($request->contacts)){
            $ngo['contacts'] = $this->contacts($request->contacts);
        }
       if(isset($request->bank_details)){
           $ngo['bank_details'] = $this->NgoBankDetails($request->bank_details);
       }

       $user->ngo()->save($ngo);

        $user1 = new User;
        $user1->name = $request->dummyname;
        $user1->user_id = $ngo_inserted_id;
        $user1->email = $request->dummyemail;
        $user1->mobile = $request->dummymobile;
        $user1->password = bcrypt($request->dummypassword);
        $user1->role_id = 3;
        $user1->profile_image = $logo;
        $user1->save();
        Mail::to($request->email)->send(new NgoCreated($user, $request->password));
         });
        return back()->with('success',"NGO added successfully!");
    }

    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('permission','3|4'); 
        $data['ngo'] = User::with('ngo')->findOrFail($id);
        $data['projects'] = Project::whereUserId($id)->get();
        $data['projectCounts'] = collect($this->projectCounts([$data['ngo']]))->first();
        return view('admin.show_ngo',['data'=>$data]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('permission','4');
        $data['ngo'] = User::with('ngo')->findOrFail($id);
        $data['ngo']['address'] = $data['ngo']['ngo']['address'];
        $data['ngo']['registration_date'] = $data['ngo']['ngo']['registration_date'];
        $data['ngo']['registration_number'] = $data['ngo']['ngo']['registration_number'];
        $data['ngo']['mobile'] = $data['ngo']['mobile'];
        $data['ngo']['landline'] = $data['ngo']['ngo']['landline'];
        $data['contacts'] = $data['ngo']['ngo']['contacts'];
        $data['bank_details'] = $data['ngo']['ngo']['bank_details'];

        return view('admin.edit_ngo',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function validateUpdate($request){
        $messages = [
            
            'contacts.*.number.digits' => 'Invalid contact number',
            'contacts.*.email' => 'Invalid contact email',
        ];

        $validatedData = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'registration_date' => 'required|date_format:d-m-Y',
            'registration_number' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|digits:10',
            'landline' => 'nullable|digits_between:8,11',
            'contacts.*.name' => 'required',
            'contacts.*.number' => 'required|digits:10',
            'contacts.*.email' => 'required|email',
            'contacts.*.designation' => 'required',

        ], $messages);
    }

    public function update(Request $request, $id)
    {
//        print_r($_POST); exit;
        $this->authorize('permission','4');
        $this->validateUpdate($request);
        
        $user = User::findOrFail($id);
//        print_r($user); exit;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        // $user->password = $request->password;
        $user->save();


        $ngo = Ngo::whereUserId($id)->first();
        $ngo->address = $request->address;
        $ngo->landline = $request->landline;
        $ngo->registration_date = $request->registration_date;
        $ngo->registration_number = $request->registration_number;
        if(isset($request->contacts)){
            $ngo->contacts = $this->contacts($request->contacts);
        }else{
            $ngo->contacts = "[]";
        }
        if(isset($request->bank_details)){
            $ngo->bank_details = $this->NgoBankDetails($request->bank_details);
        }else{
            $ngo->bank_details = "[]";
        }
        $ngo->save();
        $request->session()->flash('success','NGO updated successfully!');
        // return session('success');
        return [
            'status'=>201,
            'message'=>'NGO updated successfully!'
        ];
        // return redirect()->route('ngo.index')->with('success','NGO updated successfully!');
        
    }
    
    public function updateImage(Request $request){
        
        $request->validate([
            'logo' => 'required|image',
        ]);

        $user = User::findOrFail($request->user_id);
        Storage::disk('public')->delete($user->profile_image);
        $imgName = $request->file('logo')->store(null);
        $user->profile_image = $imgName;
        $user->save();

        return back();
    }


    public function updatePancard(Request $request){
        //die('dfsdf'); exit;
        $request->validate([
            //'pancard' => 'required|image|pdf',
            'pancard' => 'required|mimes:jpeg,png,jpg,pdf',
        ]);

        $ngo = NGO::findOrFail($request->ngo_id);
        Storage::disk('public')->delete($ngo->pancard);
        $imgName = $request->file('pancard')->store(null);
//        echo '<pre>'; print_r($imgName); exit;
        $ngo->pancard = $imgName;
        $ngo->save();
//
        return back();
    }

    public function updateCertificate(Request $request){
        //die('dfsdf'); exit;
        $request->validate([
//            'certificate' => 'required|image',
            'certificate' => 'required|mimes:jpeg,png,jpg,pdf',
        ]);

        $ngo = NGO::findOrFail($request->ngo_id);
        Storage::disk('public')->delete($ngo->certificate);
        $imgName = $request->file('certificate')->store(null);
//        echo '<pre>'; print_r($imgName); exit;
        $ngo->certificate = $imgName;
        $ngo->save();
//
        return back();
    }

    public function updateCrcertificate(Request $request){
        //die('dfsdf'); exit;
        $request->validate([
//            'charity_registration_certificate' => 'required|image',
            'charity_registration_certificate' => 'required|mimes:jpeg,png,jpg,pdf',
        ]);

        $ngo = NGO::findOrFail($request->ngo_id);
        Storage::disk('public')->delete($ngo->charity_registration_certificate);
        $imgName = $request->file('charity_registration_certificate')->store(null);
//        echo '<pre>'; print_r($imgName); exit;
        $ngo->charity_registration_certificate = $imgName;
        $ngo->save();
//
        return back();
    }
    public function updateDead(Request $request){
        //die('dfsdf'); exit;
        $request->validate([
//            'dead' => 'required|image',
              'dead' => 'required|mimes:jpeg,png,jpg,pdf',
        ]);

        $ngo = NGO::findOrFail($request->ngo_id);
        Storage::disk('public')->delete($ngo->dead);
        $imgName = $request->file('dead')->store(null);
//        echo '<pre>'; print_r($imgName); exit;
        $ngo->dead = $imgName;
        $ngo->save();
//
        return back();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('permission','4');
        User::destroy($id);
        Project::whereUserId($id)->update(['status'=>0]);

        return back()->with('success','NGO deleted successfully!');
    }

    public function destroyImage(Request $request){
        $user = User::findOrFail($request->user_id);
        Storage::disk('public')->delete($user->profile_image);
        $user->profile_image = null;
        $user->save();
        return back();

    }
    public function destroyPan(Request $request){
        $ngo = NGO::findOrFail($request->ngo_id);
        Storage::disk('public')->delete($ngo->pancard);
        $ngo->pancard = null;
        $ngo->save();
        return back();

    }
    public function destroyCertificate(Request $request){
        $ngo = NGO::findOrFail($request->ngo_id);
//        echo '<pre>'; die($ngo); exit;
        Storage::disk('public')->delete($ngo->certificate);
        $ngo->certificate = null;
        $ngo->save();
        return back();

    }

    public function destroyCrcertificate(Request $request){
        $ngo = NGO::findOrFail($request->ngo_id);
//        echo '<pre>'; die($ngo); exit;
        Storage::disk('public')->delete($ngo->charity_registration_certificate);
        $ngo->charity_registration_certificate = null;
        $ngo->save();
        return back();

    }
    public function destroyDead(Request $request){
        $ngo = NGO::findOrFail($request->ngo_id);
//        echo '<pre>'; die($ngo); exit;
        Storage::disk('public')->delete($ngo->dead);
        $ngo->dead = null;
        $ngo->save();
        return back();

    }

   

    /*
    =============================================
        Server side DataTable
    =============================================
    */
    /*public function postIndex(){

        $ngos = Ngo::all();
        
        return Datatables::of($ngos)
            ->addColumn('action', function ($ngos) {
                return '<a href="#view-'.$ngos->id.'">
                <button type="button" class="btn btn-info btn-outline btn-circle btn-sm m-r-5" title="View"><i class="ti-eye"></i></button></a> 

                <a href="#edit-'.$ngos->id.'">
                <button type="button" class="btn btn-info btn-outline btn-circle btn-sm m-r-5" title="Edit"><i class="ti-pencil-alt"></i></button></a>';
            })
            ->addColumn('registration_date', function ($ngos) {
                return date('d-m-Y', strtotime($ngos->registration_date));;
            })
            ->make(true);
    }*/

    public function kycUpdate(Request $request)
    {
        $this->validate($request,[
          'is_kyc'=>'required'
        ]);

        $ngo = NGO::findOrFail($request->id);
        $ngo->is_kyc = $request->is_kyc;
        $ngo->save();
        return back();

    }
}
