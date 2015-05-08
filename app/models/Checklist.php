<?php

class Checklist extends Eloquent
{
	protected $table = "checklists";
	protected $guarded = ['id','token'];

	public function item()
	{
		return $this->hasMany('Item')->orderBy('dday_prev');
	}

	public function checklistuser()
	{
		return $this->hasMany('ChecklistUser');
	}

	public function manager()
	{
		return $this->hasOne('User');
	}

}