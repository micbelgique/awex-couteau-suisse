<?php

class ChecklistUser extends Eloquent
{
	protected $table = "checklist_users";
	protected $guarded = ['id'];

	public function item()
	{
		return $this->hasMany('ChecklistUserItem');
	}

	public function manager()
	{
		return $this->hasOne('User');
	}

}