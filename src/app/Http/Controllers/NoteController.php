<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Note;
use Illuminate\Support\Facades\Validator;
use App\Helper\CommonHelper;

class NoteController extends Controller
{
    function add(Request $request){
        $validator = Validator::make(request()->all(), [
            'notes' => 'required|max:500',
        ]);

        if($validator->fails()){
            $errorMessage = $validator->errors()->all();
            return $this->jsonOutput(400, $errorMessage[0]);
        }

        $Note = new Note;
        $Note->notes = $request->notes;
        $Note->user_id = $this->getUserLoginId();
        $Note->modify_by = $this->getUserLoginId();
        $result = $Note->save();
        
        if($result > 0){
        	return $this->jsonOutput(200,'Note added successfully',$this->getLastDate($Note->id,'added'));
        }
        else{
        	return $this->jsonOutput(400,'Unable to insert');
        }
    }

    function update(Request $request){
        $validator = Validator::make(request()->all(), [
            'id' => 'required|numeric',
            'notes' => 'required|max:500',
        ]);

        if($validator->fails()){
            $errorMessage = $validator->errors()->all();
            return $this->jsonOutput(400, $errorMessage[0]);
        }

        $Note = Note::find($request->id);
        $Note->notes = $request->notes;
        $result = $Note->save();

        if($result > 0){
        	return $this->jsonOutput(200,'Note updated successfully',$this->getLastDate($Note->id,'updated'));
        }
        else{
        	return $this->jsonOutput(400,'Unable to update');
        }
    }

    function delete(Request $request){
        $validator = Validator::make(request()->all(), [
            'id' => 'required|numeric',
        ]);

        if($validator->fails()){
            $errorMessage = $validator->errors()->all();
            return $this->jsonOutput(400, $errorMessage[0]);
        }

        $Note = Note::find($request->id);
        $Note->delete = 1;
        $result = $Note->save();

        if($result > 0){
        	return $this->jsonOutput(200,'Note deleted successfully',['id' => $request->id, 'notes' => '']);
        }
        else{
        	return $this->jsonOutput(400,'Unable to delete');
        }
    }

    function jsonOutput($code = 400, $message = 'Error', $data = array()){
    	$output = new \stdclass;
    	$output->code = $code;
    	$output->message = $message;
    	if(is_array($data)){
    		$output->data = $data;
    	}
    	return json_encode($output);
    }

    function getUserLoginId(){
        $email = \Session::get('user_login');

        $data = \DB::table('users')->where('email',$email)->get();
        return $data[0]->id;
    }

    function getLastDate($id, $type = ''){

        $noteList = Note::select('notes.id','notes.notes','notes.updated_at','t1.name','t2.name as modifyUser')
							->leftJoin(\DB::raw('users as t1'),'t1.id','=','notes.user_id')
							->leftJoin(\DB::raw('users as t2'),'t2.id','=','notes.modify_by')
							->where('notes.delete',0)
                            ->orderBy('notes.updated_at', 'desc')
                            ->where('notes.id', $id)
							// ->where('user_id',$this->getUserLoginId())
                            ->get();
                            
        $CommonHelper = new CommonHelper;

        $data = [
            'notes' => $noteList[0]->notes,
            'lastId' => $noteList[0]->id,
            'adddate' => $CommonHelper->convertDateFomate($noteList[0]->updated_at),
            'addedby' => $noteList[0]->name,
            'modifyby' => $noteList[0]->modifyUser,
        ];
        if($type == 'added'){
            $data['id'] = 0;
        }
        else if($type == 'updated'){
            $data['id'] = $noteList[0]->id;
        }
        return $data;

    }
}
