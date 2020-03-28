<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Config;
use App\Models\Project;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    public function getConfig(){
    	$now = now();
    	$config = Config::all();
    	$data['commission'] = $config->where('name','commission')->first();
    	$data['project_1'] = $config->where('name','project_1')->first();
    	$data['project_2'] = $config->where('name','project_2')->first();
    	$data['projects'] = Project::with(['user'])
    									->where('status',1)
                                        ->whereDate('start_date','<=',$now)
                                        ->whereDate('end_date','>=',$now)->get();
        $data['ngos'] = $data['projects']->unique('user_id');


    	return view('admin.config',['data'=>$data]);
    }

    public function updateCommission(Request $request){
    	
    	$request->validate([
    		'commission' => ['required', 'integer', function($attribute, $value, $fail){
    			if ($value <= 0) {
                	$fail($attribute.' is invalid.');
            	}
    		}]
    	]);

    	$config = Config::whereName('commission')->first();
    	$config->value = $request->commission;
    	$config->save();

    	return redirect('admin/config')->with('success','Commission updated successfully.');
    }

    public function setProject1(Request $request){
    	$request->validate([
    		'project1'=>['required']
    	]);
    	$config = Config::whereName('project_1')->first();
    	$config->value = $request->project1;
    	$config->save();
    	return redirect('admin/config')->with('success','Updated successfully.');

    }

    public function setProject2(Request $request){
    	$request->validate([
    		'project2'=>['required']
    	]);

    	$config = Config::whereName('project_2')->first();
    	$config->value = $request->project2;
    	$config->save();
    	return redirect('admin/config')->with('success','Updated successfully.');

    }
}
