<?php

class ChecklistUsersController extends BaseController {

	public function join($checklist_id){

		$user_id = Auth::user()->id;
		$checklist = ChecklistUsers::create([ 'checklist_id' => $checklist_id, 'user_id' => $user_id ]);
		//return Redirect::route('checklists.edit',$checklist_id)->with(['success' => 'Inscription bien réalisée']);
		return Redirect::back()->with(['success' => 'Inscription bien réalisée']);
	}

	public function edit(){
		$inputs=Input::all();
		$post = ChecklistUsers::findOrFail($inputs['id']);
		$post->update($inputs);
		return Redirect::back()->with(['success' => 'Date bien enregistrée']);
	}

}