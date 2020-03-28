<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Socialite;
use Auth;
use Exception;
use App\User;
use Illuminate\Http\Request;
use App\Helper\CommonHelper;
use Illuminate\Support\Facades\Mail;
use App\Mail\nonjoiningemp;
use App\Repositories\SettingRepo;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function loginview()
    {
        return view('auth/login');
    }

    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }
    /**
     * Return a callback method from google api.
     *
     * @return callback URL from google
     */
    public function callback()
    {   
        // $host = request()->getHttpHost();
        // if ($host == "resourcingtest.nimapinfotech.com") {
        //     $user_array = array("sagar@nimapinfotech.com", "priyank@nimapinfotech.com", "kunaljagtap@nimapinfotech.com", "brijesh@nimapinfotech.com", "sonali@nimapinfotech.com");
        // }elseif ($host == "resourcing.nimapinfotech.com") {
        //     $user_array = array("sagar@nimapinfotech.com", "priyank@nimapinfotech.com", "brijesh@nimapinfotech.com");
        // }elseif ($host == "localhost") {
        //     $user_array = array("sagar@nimapinfotech.com", "priyank@nimapinfotech.com", "brijesh@nimapinfotech.com", "kunaljagtap@nimapinfotech.com","omprakash@nimapinfotech.com","sonatan@nimapinfotech.com");
        // }

        //Get user data from database for validation - Start
        $user_array = array();
        $tempData = User::all();
        foreach($tempData as $value){
            if($value->type == 'google'){
                $user_array[] = $value->email;
            }
        }
        //Get user data from database for validation - End

        // dd($user_array);

            //dd($googleUser);
        try{
            $googleUser = Socialite::driver('google')->user();
            
            $existUser = User::where('email',$googleUser->email)->first();
         
            if (in_array($googleUser->email, $user_array)) {

                if($existUser) {
                    Auth::loginUsingId($existUser->id);
                    //Set email address in session
                    \Session::put('user_login',$googleUser->email);
                    \Session::put('user_login_id',$existUser->id);

                    return redirect()->to('/');
                }
                else {
                    $user = new User;
                    $user->name = $googleUser->name;
                    $user->email = $googleUser->email;
                    // $user->google_id = $googleUser->id;
                    $user->password = md5(rand(1,10000));
                    $user->save();
                    Auth::loginUsingId($user->id);

                    //Set email address in session
                    \Session::put('user_login',$googleUser->email);
                    \Session::put('user_login_id',$user->id);

                    return redirect()->to('/');
                }
            }else{
                return redirect()->to('/login-error')->with('error','You have not access to this site');
            }
        } catch (Exception $e) {
            return redirect('login')->with('error','Please try again');
        }
    }

    function normalLogin(Request $request){
        try{
            $validator = Validator::make(request()->all(), [
                        'email' => 'required|email|max:100',
                        'password' => 'required|max:100',
                    ]);
            if($validator->fails()){
                $errorMessage = $validator->errors()->all();
                return redirect('login')->with('error',$errorMessage[0]);
            }

            $CommonHelper = new CommonHelper();
            // dd($request->email);

            $data = User::where('email',$request->email)
                            ->where('password',$CommonHelper->encryData($request->password))
                            ->where('type','other')
                            ->limit('1')
                            ->get();
            // dd($data);
            if(!isset($data[0]->id)){
                return redirect('login')->with('error','Incorrect email or password found');
            }

            Auth::loginUsingId($data[0]->id);
            //Set email address in session
            \Session::put('user_login',$data[0]->email);
            \Session::put('user_login_id',$data[0]->id);
            return redirect()->to('/');
        }
        catch (Exception $e) {
            return redirect('login')->with('error','Please try again');
        }
    }

    function forgetPassword(Request $request){
        $validator = Validator::make(request()->all(), [
            'email' => 'required|email|max:100',
        ]);

        if($validator->fails()){
            $errorMessage = $validator->errors()->all();
            return redirect('login')->with('error',$errorMessage[0]);
        }

        $CommonHelper = new CommonHelper();

        $data = User::where('email',$request->email)
                            ->where('type','other')
                            ->limit('1')
                            ->get();

        if(!isset($data[0]->id)){
            return redirect('login')->with('error','Email not found');
        }

        $SettingRepo = new SettingRepo;
        $setting = $SettingRepo->show();
        $from = $setting[0]->from_email;
        unset($setting);

        $uniqueId = $CommonHelper->encryData(date('YmdHis'));

        $updateUser = User::find($data[0]->id);
        $updateUser->forget_id = $uniqueId;
        $updateUser->save();

        $bodyContain = '<p>Dear '.$data[0]->name.',</p>
        <p>We have sent you this email in response to your request to reset your password.</p>

        <p>To reset your password, please follow the link below:</p>
        
        <p><a href="'.route('reset-password',[$uniqueId]).'" target="_blank">Click Here</a></p>
        
        <p>We recommend that you keep your password secure and not share it with anyone</p>.
                
        <p>Thanks and Regards,</p>
        <p>Nimap Infotech</p>';

        Mail::to([$data[0]->email])
                    ->send(new nonjoiningemp(['body'=>$bodyContain,'from'=>$from,'subject'=>'Resetting your password - Nimap Infotech']));
        
        return redirect()->to('login')->with('Success','Mail sent successfully');

    }

    function resetPassword(Request $request){

        $data = User::where('forget_id', $request->unique)
                            ->limit('1')
                            ->get();
        
        if(!isset($data[0]->id)){
            return redirect('login')->with('error','Something went wrong');
        }

        return view('reset-password')->with(['unique' => $request->unique]);
    }

    function resetNewPassword(Request $request){
        $validator = Validator::make(request()->all(), [
            'unique' => 'required|max:500',
            'password' => 'required|max:20',
            'confirm_password' => 'required|max:20',
        ]);

        if($validator->fails()){
            $errorMessage = $validator->errors()->all();
            return redirect()->back()->with('error',$errorMessage[0]);
        }

        if($request->password != $request->confirm_password){
            return redirect()->back()->with('error','Password doesn\'t match');
        }

        $data = User::where('forget_id', $request->unique)
                            ->limit('1')
                            ->get();
        
        if(!isset($data[0]->id)){
            return redirect('login')->with('error','Something went wrong');
        }

        $CommonHelper = new CommonHelper();
        $newPassword = $CommonHelper->encryData($request->password);
        $status = User::where('forget_id',$request->unique)
                ->update([
                    'forget_id' => '',
                    'password' => $newPassword
                ]);
        if($status > 0){
            return redirect()->to('login')->with('Success','Password successfully reset');
        }
        else{
            return redirect('login')->with('error','Something went wrong');
        }
    }

    public function logout()
    {
      Auth::logout();

      return redirect()->to('login')->with('Success','You have Successfully Logout');
    }

    public function loginerror()
    {
      return view('auth/error');
    }
}
