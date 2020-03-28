<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Razorpaycredentials;

class RazorpaycredentialsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
      $this->authorize('permission','1');
      // $data['roles'] = Role::whereRoleId(1)->latest()->get();
      $razorpayDetails = Razorpaycredentials::select('*')->get()->toArray();
      // echo "<pre>";
      // print_r($razorpayDetails);
      // exit;
      return view('admin.razorpaycredentials',['all_razorpaydata'=>$razorpayDetails]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('admin.razorpaycredentials_form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

     $validatedData = $request->validate([
      'RAZORPAY_KEY' => 'required',
      'RAZORPAY_SECRET'  => 'required'
    ]);

     $razorpaycredentials = Razorpaycredentials::create([
      'RAZORPAY_KEY' => $request['RAZORPAY_KEY'],
      'RAZORPAY_SECRET' => $request['RAZORPAY_SECRET'],
      'status' => $request['status'],
      'created_at' => date("Y-m-d h:i:s")
    ]);
     if (!empty($razorpaycredentials)) {
      return redirect()->route('razorpaycredentials.index')->with('success','Razorpay credentials added.');
    }
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
      $this->authorize('permission','1'); 
      $razorpayDetails = Razorpaycredentials::select('*')->where('id',$id)->get()->toArray();
      return view('admin.edit_razorpaycredentials_form', ['all_razorpaydata'=>$razorpayDetails]);
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
      'RAZORPAY_KEY' => 'required',
      'RAZORPAY_SECRET'  => 'required'
    ]);

     $formData         = $request->except('_token');
     $formData['RAZORPAY_KEY'] = $request['RAZORPAY_KEY'];
     $formData['RAZORPAY_SECRET'] = $request['RAZORPAY_SECRET'];
     $formData['status'] = $request['status'];

     Razorpaycredentials::findOrFail($id)->update($formData);
     return redirect()->route('razorpaycredentials.index')->with('success', "Razorpay credentials updated successfully!");
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
