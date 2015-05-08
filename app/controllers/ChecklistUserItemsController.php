<?php

class ChecklistUserItemsController extends BaseController {

	public function create($checklist_users_id, $item_id, $status){

		//INSERT
		$item = ChecklistUserItem::create(['checklist_users_id' => $checklist_users_id, 'item_id' => $item_id, 'status' => $status ]);
		return Redirect::back()->with(['success' => 'Status mis à jour']);
		
	}

	public function update($id, $status){

		// UPDATE
		$cui = ChecklistUserItem::findOrFail($id);
		$cui->update(['status' => $status ]);

		$checklistuser = ChecklistUser::findOrFail($cui->checklist_users_id);

		return Redirect::back()->with(['success' => 'Status mis à jour']);

	}

}