<?php

class ChecklistUsers extends Eloquent
{
	protected $table = "checklist_users";
	protected $guarded = ['id'];

	public function item()
	{
		return $this->hasMany('Checklist_user_item');
	}

	public function manager()
	{
		return $this->hasOne('User');
	}

}