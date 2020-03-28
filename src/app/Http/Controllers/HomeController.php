<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\HomeRepo;
use App\Repositories\ResouceRepo;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use  App\Exports\BenchExport;

class HomeController extends Controller
{
    public function index(Request $request)
    {
    	$HomeRepo = new HomeRepo();
        $counts = $HomeRepo->getcount();
        $onBenchResource = $HomeRepo->onBenchResource();
        $upcomingBenchResource = $HomeRepo->upcomingBenchResource();
        $notesList = $HomeRepo->notesList();

        $ResourceRepo = new ResouceRepo();
        $res = $ResourceRepo->gettechnology();

        // $user_login = \Session::get('user_login');    //Get user details

        $activeClientList = $counts['ActiveClientDTL'];
        for($i = 0; $i < sizeof($activeClientList); $i++){
			for($j = $i; $j > 0; $j--){
				if($activeClientList[$j]->resource > $activeClientList[($j-1)]->resource){
					$tempData = $activeClientList[$j];
					$activeClientList[$j] = $activeClientList[($j-1)];
					$activeClientList[($j-1)] = $tempData;
				}
			}
		}

        // dd($onBenchResource);   
    	// return view('index',['counts' => $counts, 'onBenchResource' => $onBenchResource, 'upcomingBenchResource' => $upcomingBenchResource, 'notesList' => $notesList]);
    	return view('dashboard',['counts' => $counts, 'onBenchResource' => $onBenchResource, 'upcomingBenchResource' => $upcomingBenchResource, 'notesList' => $notesList,'activeClientList' => $activeClientList, 'technology' => $res]);
    }

    function getIndActiveClient($id)
    {
    	$HomeRepo = new HomeRepo();
    	$IndActCli = $HomeRepo->getIndActiveClient($id);
    	return $IndActCli;
    }

    function resourceReport(Request $request){

        $HomeRepo = new HomeRepo();
        $onBenchResource = $HomeRepo->onBenchResourceFilter($request);
        $upcomingBenchResource = $HomeRepo->upcomingBenchResourceFilter($request);

        echo json_encode(['onBenchResource' => $onBenchResource , 'upcomingBenchResource' => $upcomingBenchResource]);
    }

    function exportBench(Request $request){
        $HomeRepo = new HomeRepo();
        // return new BenchExport;
        // return $HomeRepo->onBenchResource();
        if($request->action == 'download'){
            $fileName="BenchResourcess".date('d-m-y h:i:s').'.xlsx';
            return Excel::download(new BenchExport, $fileName);
        }else{
            $fileName="BenchResourcess".date('d-m-y h:i:s').'.xlsx';
           Excel::store(new BenchExport, $fileName, 'client_export');
           $data="Auto Mail: Bench Resources Export";
           $content = [
    		"content"=>"Please check attached Bench Resourcess Details file"
        ];
        
        $attachment=[public_path('client_export/'.$fileName)];
         Mail::to($request->email)->send(new SendMail($data,$content,$attachment));

         return redirect()->back()->with('alert', 'Bench Resourcess Details Sent Successfully!');
        } 
    }
}
