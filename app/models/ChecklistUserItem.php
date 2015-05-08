<?php

class ChecklistUserItem extends Eloquent
{
	protected $table = "checklist_user_items";
	protected $guarded = ['id'];

	public function checklist_user()
	{
		return $this->belongsTo('ChecklistUser');
	}

}