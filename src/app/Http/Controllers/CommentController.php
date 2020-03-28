<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\CommentController as CommentApi;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Project;
use Illuminate\Http\Request;
use Vinkla\Hashids\Facades\Hashids;

class CommentController extends Controller
{
    public function store(Request $request,$projectId){

    	$data = $request;
    	$data['user_id'] = $request->user()->id;
    	 // $data['project_id'] = Hashids::decode($projectId)[0];
        $data['project_id'] = $projectId;
    	CommentApi::store($data);
    	return back();
    }

    public function allComments($projectId){
    	// $projectId = Hashids::decode($projectId)[0];
    	$data['project'] = Project::with('image')->whereId($projectId)->first();
    	$data['comments'] = Comment::with('user:id,name,profile_image')->whereProjectId($projectId)->paginate(15);
    	return view('comments',['data'=>$data]);
    }
}
