<?php

class Item extends Eloquent
{
	protected $table = "items";
	protected $guarded = ['id','token'];
	protected $hidden = array('checklist_id');

	public function checklist()
	{
		return $this->belongsTo('Checklist');
	}

}