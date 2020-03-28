<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\UserController as Donor;
use App\Models\Donation;
use App\Rules\UpdateUserEmailRule;
use App\User;
use App\Models\Ngo;
use App\Models\Donoremail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Mail\SendMail;
use Mail;


class UserController extends Controller
{

  public function __construct()
  {

  }

  public function index()
  {
    $this->authorize('permission','1|2');

    $data['users'] = User::with(['donation'])->whereRoleId(3)->latest()->get();
        //return count($data['users'][0]['project'])......;
    return view('admin.all_users', ['data' => $data]);
  }

  public function searchDonation(Request $request){
    if($request->start && $request->end){
            // $data['donations'] = Donation::whereBetween('created_at', [date('Y-m-d', strtotime($request->start)), date('Y-m-d', strtotime($request->end))])
            // ->whereUserId($request->user_id)
            // ->get();    
            // $data['search'] = true;

      $data['donations'] = Donation::where('created_at', '>=' ,date('Y-m-d 00:00:01', strtotime($request->start)) )
      ->where('created_at', '<=' ,date('Y-m-d 23:59:59', strtotime($request->end)) )
      ->whereUserId($request->user_id)
      ->get();   
      $data['search'] = true;
    }else{
      $data['donations'] = Donation::whereUserId($request->user_id)->get();
    }

    return view('admin.search_donation',['data'=>$data]);
  }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
      $this->authorize('permission','2');
      return view('admin.create_user');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {
      $this->authorize('permission','2');

      $name = $request->first_name;

      if($request->file('donor_csv_upload') !== null && $name != '' ) {
        return redirect()->route('users.create')->withErrors('You can not submit both CSV and form at the same time');
      }

      $authKey = Donor::getAuthKey();

      if ($request->file('donor_csv_upload') !== null) {

        $file = $request->file('donor_csv_upload');

        $filename = $file->getClientOriginalName();

        $extension = $file->getClientOriginalExtension();

        $valid_extension = "csv";

        if($extension != $valid_extension){
         return redirect()->route('users.create')
         ->withErrors('Please upload only CSV extension file!');
       }

       $path = $request->file('donor_csv_upload')->getRealPath();

       $data = Excel::load($path)->get();

       if($data->count()){
        foreach ($data as $key => $value) {

          $arr = [
           'name' => $value->username,
           'mobile' => $value->mobile,
           'email' => $value->email,
           'password' => bcrypt($value->password),
           'balance' => $value->balance,
           'role_id' => 3,
           'os_type' => 'web',
           'auth_key' => $authKey,
           'created_at' => date('Y-m-d H:i:s')
         ];

         if(($value->username=='' || $value->mobile=='' 
          || $value->email=='' || $value->password=='' || $value->balance=='')){
          return redirect()->route('users.create')->withErrors('Please check all the fields and upload valid CSV only.');
      }

      if(!is_numeric($value->mobile) || !is_numeric($value->balance)){
        return redirect()->route('users.create')->withErrors('Please check all the fields and upload valid CSV only.');
      }

      $count = 0;
      if ($value->email!='pgrfoundation1@gmail.com' && $value->mobile!='9977997799') {
        $row = DB::table('users')
                  // ->where('name', '=', trim($value->username) )
        ->where('email', '=', trim($value->email) )
        ->where('mobile', '=', trim($value->mobile) )
        ->get(); 

        $count = $row->count();
      }else{
        $count = 0;
      }


                // echo $count;
                // exit;

      if($count == 0){ 
        User::insert($arr);
      }else{
        $csvData['updated_at'] = date('Y-m-d H:i:s'); 
        $csvData['balance'] = (int)$row[0]->balance + $value->balance;

                    // echo "<pre>";
                    // print_r($csvData);
                    // print_r($value);
                    // exit;
        DB::table('users')
                    // ->where('name', '=' ,$value->username)
        ->where('mobile', '=' ,$value->mobile)
        ->where('email', '=' ,$value->email)
        ->update($csvData);
      }
    }
  }

  return redirect()->route('users.index')->with('success','Donor CSV Import Successful');
}

$validatedData = $request->validate([
  'first_name' => 'required|alpha|min:3|string',
  'last_name'  => 'required|alpha|min:3|string',
  'profile'    => 'nullable|image',
  'email'      => 'required|email|unique:users,email',
  'mobile'     => 'required|digits:10|unique:users,mobile|regex:/^[1-9]{1}[0-9]{9}?/',
  'password'   => 'required',
]);
$profile                   = $request->file('profile') != null ? $request->file('profile')->store(null) : null;

$profile                   = $profile;
$name                      = $request->first_name . ' ' . $request->last_name;
$formData                  = $request->except('_token');
$formData['name']          = $name;
$formData['role_id']       = 3;
$formData['os_type']       = 'web';
$formData['profile_image'] = $profile;
$formData['password']      = bcrypt($request->password);
$formData['auth_key']      = $authKey;

User::create($formData);
return redirect()->route('users.index')->with('success', 'Donor added successfully!');

}



//     public function store(Request $request)
//     {
//         $this->authorize('permission','2');

//         $name = $request->first_name;

//         if ($request->file('donor_csv_upload') !== null && $name != '' ) {
//             return redirect()->route('users.create')->withErrors('You can not submit both CSV and form at the same time');
//         }

//         $authKey = Donor::getAuthKey();

//             if ($request->file('donor_csv_upload') !== null) {

//                       $file = $request->file('donor_csv_upload');

//                   // File Details 
//                       $filename = $file->getClientOriginalName();
//                       $exploded_file = explode('.', $filename);
//                       $new_file_name =  $exploded_file[0].date('Y-m-d-H-i-s').'.csv';

//                       $extension = $file->getClientOriginalExtension();
//                       $tempPath = $file->getRealPath();
//                       $fileSize = $file->getSize();
//                       $mimeType = $file->getMimeType();

//                   // Valid File Extensions
//                       $valid_extension = array("csv");

//                   // 2MB in Bytes
//                       $maxFileSize = 2097152; 

//                   // Check file extension
//                       if(in_array(strtolower($extension),$valid_extension)){

//                     // Check file size
//                         if($fileSize <= $maxFileSize){

//                       // File upload location
//                           $location = 'csv';

//                       // Upload file
//                           $file->move($location,$new_file_name);

//                       // Import CSV to Database
//                           $filepath = public_path($location."/".$new_file_name);

//                       // Reading file
//                           $file = fopen($filepath,"r");

//                           $importData_arr = array();
//                           $i = 0;

//                           while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
//                            $num = count($filedata);

//                           if ($num != 5) {
//                               return redirect()->route('users.create')->withErrors('No rows affected. Please upload valid CSV.');
//                               exit;
//                           }

//                         for ($c=0; $c < $num; $c++) {
//                             $importData_arr[$i][] = $filedata[$c];
//                         }
//                         $i++;
//                     }
//                     fclose($file);

//                     foreach($importData_arr as $importData){

//                         $csvData['name']          = $importData[0];
//                         $csvData['mobile']        = (int)$importData[1];
//                         $csvData['email']         = 'test';
//                         // $csvData['email']         = (string)$importData[2];
//                         $csvData['password']      = bcrypt($importData[3]);
//                         $csvData['balance']       = (int)$importData[4];

//                         $value = DB::table('users')->where('mobile', 'like', $csvData['mobile'])->get();

//                         $flag = 0;

//                         if($value->count() == 0){
//                             $csvData['role_id']       = 3;
//                             $csvData['os_type']       = 'web';
//                             $csvData['auth_key']      = $authKey;
//                             $csvData['created_at']    = date('Y-m-d H:i:s'); 

//                             DB::table('users')->insert($csvData);
//                             $flag = 1;
//                         }else{
//                             $csvData['updated_at']    = date('Y-m-d H:i:s'); 

//                             $csvData['balance'] = (int)$value[0]->balance + (int)$csvData['balance'];
//                             DB::table('users')
//                             ->where('mobile', '=', $csvData['mobile'])
//                             ->update($csvData);
//                             $flag = 1;
//                         }
//                 }

//                 if($flag == 0){
//                     return redirect()->route('users.create')->withErrors('No rows affected. Please upload valid Data.');
//                 }
//                 return redirect()->route('users.index')->with('success','Donor CSV Import Successful');
//              }else{
//                 return redirect()->route('users.create')->withErrors('File too large. File must be less than 2MB.');
//             }

//             }else{
//                return redirect()->route('users.create')->withErrors('Please upload only CSV extension file!');
//             }

//         }

//     $validatedData = $request->validate([
//         'first_name' => 'required|regex:/^[\pL\s\-]+$/u|min:3|string',
//         'last_name'  => 'required|alpha|min:3|string',
//         'profile'    => 'nullable|image',
//         'email'      => 'required|email|unique:users,email',
//         'mobile'     => 'required|digits:10|unique:users,mobile',
//         'password'   => 'required',
//     ]);
//     $profile                   = $request->file('profile') != null ? $request->file('profile')->store(null) : null;

//     $profile                   = $profile;
//     $name                      = $request->first_name . ' ' . $request->last_name;
//     $formData                  = $request->except('_token');
//     $formData['name']          = $name;
//     $formData['role_id']       = 3;
//     $formData['os_type']       = 'web';
//     $formData['profile_image'] = $profile;
//     $formData['password']      = bcrypt($request->password);
//     $formData['auth_key']      = $authKey;

//     User::create($formData);
//     return redirect()->route('users.index')->with('success', 'Donor added successfully!');

// }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $this->authorize('permission','1|2');

      $data['user']            = User::findOrFail($id);
      $data['donationDetails'] = Donation::with('project')->whereUserId($id)->get();
      $data['amountDonated']   = $data['donationDetails']->sum('amount_donated');
      $data['uniquePorject']   = $data['donationDetails']->unique('project_id')->values()->all();
      return view('admin.show_user', ['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $this->authorize('permission','2');

      $data['user'] = User::findOrFail($id);
      $name         = explode(' ', $data['user']['name']);
//        print_r($name); exit;
      $lname = end($name);

      $data['user']['first_name'] = $name[0];
//        $data['user']['last_name']  = isset($name[1]) ? $name[1] : null;
      $data['user']['last_name']  = isset($lname) ? $lname : null;
      return view('admin.edit_user', ['data' => $data]);
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
      $this->authorize('permission','2');

      $validatedData = $request->validate([
        'first_name' => 'required|alpha|min:3|string',
        'last_name'  => 'required|alpha|min:3|string',
        'email' => ['required', 'email', new UpdateUserEmailRule($id)],
            // 'email'      => 'required|email',
        'mobile'     => 'required|digits:10|regex:/^[1-9]{1}[0-9]{9}?/',
            // 'IMEI'       => 'required|numeric|digits:15',
      ]);

      $name             = $request->first_name . ' ' . $request->last_name;
      $formData         = $request->except('_token');
      $formData['name'] = $name;

      User::findOrFail($id)->update($formData);
      return redirect()->route('users.index')->with('success', "Donor updated successfully!");
    }

    public function updateImage(Request $request)
    {
      $request->validate([
        'profile' => 'required|image',
      ]);
      $userId = isset($request->user_id)?$request->user_id:Auth::id();
      $user = User::findOrFail($userId);
      Storage::disk('public')->delete($user->profile_image);
      $imgName             = $request->file('profile')->store(null);
      $user->profile_image = $imgName;
      $user->save();

      return back();
    }
    
    private function validateUpdatePassword(){

    }

    public function updatePassword(Request $request){
      $user = Auth::user();
      $request->validate([
        'current_password' => ['required',function ($attribute, $value, $fail) use($user) {
          if (!Hash::check($value,$user['password'])) {
            $fail('Current password is invalid.');
          }
        }],
        'new_password' => 'required|min:4|confirmed',
      ]);

      $user->password = bcrypt($request->new_password);
      $user->save();
      session()->flash('success','Password Updated Successfully!');
      return response()->json([

      ],200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $this->authorize('permission','2');

      User::destroy($id);
      return back()->with('success', "Donor Deleted Successfully");
    }

    public function destroyImage(Request $request)
    {
      $userId = isset($request->user_id)?$request->user_id:Auth::id();
      $user = User::findOrFail($userId);
      Storage::disk('public')->delete($user->profile_image);
      $user->profile_image = null;
      $user->save();
      return back();

    }

    public function userProjects(Request $request, $userId)
    {
      $data['donations'] = Donation::with('project', 'project.user')->whereUserId($userId)->get();
        // $data['amountDonated']   = $data['donations']->sum('amount_donated');
      $data['projects'] = $data['donations']->unique('project_id')->values()->all();
      $data['userId'] = $userId;
        // $data['projects'] = $data['donations']->unique('project_id');
        //$month = now()->format('m');
        /*$cmonth = now()->format('m');
        $cmonth[0] == 0 ? str_replace(0, '', $cmonth) : $cmonth;
        $data['formData']['month'] = isset($request->month) ? $request->month : $cmonth;
        $data['formData']['year']  = isset($request->year) ? $request->year : date("Y");
        $data['UserDetails']       = User::whereId($userId)->get();
        $data['ProjectDetails']    = Project::whereId($projectId)->get();
        $data['totalAmount']       = Donation::whereProjectId($projectId)->sum('amount_donated');
        $data['DonationDates']     = Donation::whereMonth('created_at', $data['formData']['month'])->whereYear('created_at', $data['formData']['year'])->whereUserId($userId)->whereProjectId($projectId)->get();*/
        return view('admin.user_projects', ['data' => $data]);
      }

      public function showProfile(){
        $data['user'] = Auth::user();
        $data['contacts'] = $data['user']['ngo']['contacts'];

        return view('admin.profile_show',['data'=>$data]);
      }

      public function profile()
      {
        $data['user']               = User::whereId(Auth::id())->with('ngo')->first();
        $data['contacts']           = $data['user']['ngo']['contacts'];
        if($data['user']['role_id'] == 2){
          $ngo                        = NGO::whereUserId($data['user']['id'])->first();
          $data['user']['address']    = $ngo->address;
          $data['user']['landline']    = $ngo->landline;
        }

        return view('admin.profile_edit', ['data' => $data]);
      }

      public function validateUpdateProfile($request,$id){
        $validation = [
          'name'   => 'required|string|min:3',
          'email' => ['required', 'email', new UpdateUserEmailRule($id)],
          'mobile' => 'required|digits:10|unique:users,mobile|regex:/^[1-9]{1}[0-9]{9}?/',
          'password' => 'nullable|min:4',
        ];

        $ngoValidation = [
          'address' => 'required',
            // 'registration_date' => 'required|date_format:d-m-Y',
            // 'registration_number' => 'required|alpha_num',
          'landline' => 'nullable|digits_between:8,11',
          'contacts.*.name' => 'required',
          'contacts.*.number' => 'required|digits:10|unique:users,mobile|regex:/^[1-9]{1}[0-9]{9}?/',
          'contacts.*.email' => 'required|email',
          'contacts.*.designation' => 'required',

        ];

        if(Auth::user()->role_id == 2){
          $validation = array_merge($validation, $ngoValidation);
        }

        $validatedData = $request->validate($validation);
      }

      public function PutUpdateProfile(Request $request)
      {
        $id = Auth::id(); 

        // $this->validateUpdateProfile($request,$id);

        $validation = [
          'name'   => 'required|string|min:3',
          'email' => ['required', 'email', new UpdateUserEmailRule($id)],
          'mobile' => 'required|digits:10',
          'password' => 'nullable|min:4',
        ];
        $validatedData = $request->validate($validation);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;

        if($request->password){
          $user->password = bcrypt($request->password);
        }
        $user->save();

        if($user['role_id'] == 2){
          $this->updateNGOProfile($request,$id);
        }

        return redirect()->route('profile.show')->with('success', 'Profile Updated successfully!');
      }

      public function updateNGOProfile($request,$id){
        $ngo = Ngo::whereUserId($id)->first();
        $ngo->address = $request->address;
        $ngo->landline = $request->landline;
        // $ngo->registration_date = $request->registration_date;
        // $ngo->registration_number = $request->registration_number;
        if(isset($request->contacts)){
          $ngo->contacts = $this->contacts($request->contacts);
          dd($this->contacts($request->contacts));
        }else{
          $ngo->contacts = "[]";
        }
        $ngo->save();
      }



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

      public function csvDownload($filename = ''){
        $file_path = public_path() .'/csv/'. $filename; 

        if ( file_exists( $file_path ) ) { 
        // Send Download 
          return \Response::download( $file_path, $filename ); 

        } else { 
          exit( 'Requested file does not exist on our server!' ); 
        }
      }

      public function showDonorEmailList($value='')
      {
        $this->authorize('permission','1|2');
        
        $data['users'] = User::with(['donation'])->whereRoleId(3)->latest()->get();
        $data['donoremail'] = Donoremail::latest()->get()->toArray();

        return view('admin.all_user_emails', ['data' => $data]);
      }

      public function updateEmailImage(Request $request)
      {
        $request->validate([
          'profile' => 'required|image',
        ]);
        $userId = isset($request->user_id)?$request->user_id:Auth::id();
        $user = User::findOrFail($userId);
        Storage::disk('public')->delete($user->profile_image);
        $imgName             = $request->file('profile')->store(null);
        $user->profile_image = $imgName;
        $user->save();

        return back();
      }

      public function sendDonorEmails(Request $request){
        $this->authorize('permission','1|2');

        // echo "<pre>";
        // print_r($request->all());
        // exit;

        $request->validate([
          'email_subject' => 'required',
          'description' => 'required',
          // 'email_image' => 'required|image',
        ]);

        $users = $request->all();

        $mail_body = $request['description'];
        $email_subject = $request['email_subject'];
        $imgName = '';

        if (isset($request['email_image'])) {
          $userId = isset($request->user_id)?$request->user_id:Auth::id();
          $user = User::findOrFail($userId);
          Storage::disk('public')->delete($user->email_image);
          $imgName = $request->file('email_image')->store(null);
        }else{
          $imgName = $request['hidden_email_image'];
        }
        
        $donoremail_id = Donoremail::create([
          'subject' => $email_subject,
          'email_body' => $mail_body,
          'image_name' => $imgName
        ])->id;


        $all_users = explode(',', $request['all_user_emails']);
        foreach ($all_users as $key => $value) {
          $userData[] = explode('|', $value);
        }

        // echo "<pre>";
        // print_r($userData);
        // exit;

        foreach ($userData as $key => $value) {
          $userEmails[] = trim($value[0]);
        }

        //  echo "<pre>";
        // print_r($userEmails);
        // exit;

        $userEmails = 'sushant@nimapinfotech.com';

        foreach ($userData as $key => $value) {
          $userNames = $value[1];

          $data = [
           'name' => $userNames,
           'imageName' => $imgName,
           'emailbody' => $mail_body,
         ];

         Mail::send(['html' => 'mail'], $data, function($mail) use ($userEmails, $email_subject)
         {
          // $email_subject = $data['email_subject'];
          $mail->from('admin@nimapinfotech.com');
          $mail->to($userEmails);
          $mail->subject($email_subject);
        });

       }

       return redirect()->route('donor.show')->with('success','Email sent to all users.');
     }


   }
