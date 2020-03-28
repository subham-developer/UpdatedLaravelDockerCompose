<?php

namespace App\Http\Controllers;

use Session;
use App\Models\Client;
use App\Helper\CommonHelper;
use Illuminate\Http\Request;
use App\Exports\ClientExport;
use App\Repositories\ClientRepo;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoicedates = Config('constants.DATE_OF_INVOICES');
        return view('ClientIndex',['invoicedates' => $invoicedates]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


       $this->validate($request,[
        'client'=>'required|max:50|regex:/(^[A-Za-z0-9 ]+$)+/',
        'rname'=>'regex:/^[\pL\s]+$/u|max:50|Nullable',
        'rphone'=>'Numeric|Nullable',
        'remail'=>'Email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.).[a-z]{1,6}$/x|Nullable',
        'hrname'=>'regex:/^[\pL\s]+$/u|max:50|Nullable',
        'hrphone'=>'Numeric|Nullable',
        'hremail'=>'Email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.).[a-z]{1,6}$/x|Nullable',
        'iname'=>'regex:/^[\pL\s]+$/u|max:50|Nullable',          
        'url'=>'required',
        'maplink'=>'required',
        'address'=>'required'],[],[
            'rname' => 'reporting manager name',
            'rphone' => 'reporting manager contact',
            'remail' => 'reporting manager email',
            'hrname' => 'HR name',
            'hrphone' => 'HR contact',
            'hremail' => 'HR email',
            'iname' => 'interviewer name',
            'maplink' => 'map link',
        ]);
       $ClientRepo = new ClientRepo();
       $res = $ClientRepo->store($request);
       if($res == 200)
       {
        return redirect()->action('ClientController@show')->with('alert', 'Client Added Successfully!');
    }
    else
    {
        return redirect()->back()->with('alert', 'Something went wrong!');
    }
}
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
       $ClientRepo = new ClientRepo();
       $res = $ClientRepo->show();
       $count = $ClientRepo->getcount();
       return view('ViewClient',['clients' => $res,'totalcount' =>$count]);
   }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ClientRepo = new ClientRepo();
        $res = $ClientRepo->getclientdata($id);
        $invoicedates = Config('constants.DATE_OF_INVOICES');
        return view('EditClient',['clients' => $res, 'invoicedates' => $invoicedates]);
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
        $this->validate($request,[
            'client'=>'required|max:50|regex:/(^[A-Za-z0-9 ]+$)+/',
            'rname'=>'regex:/^[\pL\s]+$/u|max:50|Nullable',
            'rphone'=>'Numeric|Nullable',
            'remail'=>'Email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.).[a-z]{1,6}$/x|Nullable',
            'hrname'=>'regex:/^[\pL\s]+$/u|max:50|Nullable',
            'hrphone'=>'Numeric|Nullable',
            'hremail'=>'Email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.).[a-z]{1,6}$/x|Nullable',
            'iname'=>'regex:/^[\pL\s]+$/u|max:50|Nullable',
            'url'=>'required',
            'maplink'=>'required',
            'address'=>'required'],[],[
                'rname' => 'reporting manager name',
                'rphone' => 'reporting manager contact',
                'remail' => 'reporting manager email',
                'hrname' => 'HR name',
                'hrphone' => 'HR contact',
                'hremail' => 'HR email',
                'iname' => 'interviewer name',
                'maplink' => 'map link',
            ]);

        $ClientRepo = new ClientRepo();
        $res = $ClientRepo->update($request,$id);
        if($res == 200)
        {
            return redirect()->action('ClientController@show')->with('alert', 'Client Updated Successfully!');
        }
        else
        {
            return redirect()->back()->with('alert', 'Something went wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ClientRepo = new ClientRepo();
        $res = $ClientRepo->destroy($id);
        return $res;
    }

    public function downloadExcel(Request $request)
    {
        if($request->action == 'download'){
            return Excel::download(new ClientExport, 'Clients.xlsx');
        }else{
            $fileName="client".date('d-m-y h:i:s').'.xlsx';
           Excel::store(new ClientExport(), $fileName, 'client_export');
           $data="AutoMail : Client Details";


           $content = [
    		"content"=>"hi <br><br>Please check attached client details file"
        ];
        
        $attachment=[public_path('client_export/'.$fileName)];
         Mail::to($request->email)->send(new SendMail($data,$content,$attachment));

         return redirect()->back()->with('alert', 'Client Details Sent Successfully!');
        } 
    }
}
