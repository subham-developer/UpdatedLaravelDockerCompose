<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ProjectController;
use App\Models\Donation;
use App\Models\Payment;
use App\Models\Project;
use App\Models\ProjectInterval;
use Illuminate\Http\Request;


class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['payments'] = Payment::with(['ProjectInterval','ProjectInterval.project:id,title,user_id',
            'ProjectInterval.project.user:id,name'])->latest()->get();
        return view('admin.payments',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $data['interval'] = ProjectInterval::findOrFail($request->id);
        $data['project'] = Project::find($data['interval']['project_id']);
        // return $data['pay'] = $data['interval']['funded'] - ProjectController::calCharges(702);
        $data['paid'] = Payment::whereProjectIntervalId($request->id)->sum('amount');
        $data['pay'] = round(($data['interval']['funded']*100)/114);
        $data['payments'] = Payment::whereProjectIntervalId($request->id)->get();
        return view('admin.payment_create',['data'=>$data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|integer',
            'description' => 'required'
        ]);
        // fund status: 2 = transfer
        ProjectInterval::whereId($request->id)->update(['fund_status'=>2]);
        Donation::whereProjectIntervalId($request->id)->update(['status'=>2]);

        $payment = new Payment;
        $payment->amount = $request->amount;
        $payment->description = $request->description;
        $payment->project_interval_id = $request->id;
        $payment->save();
        return redirect()->route('projects.completed');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
