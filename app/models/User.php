<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	protected $table = 'users';
	protected $hidden = array('password', 'remember_token');

	protected $guarded = ['id','token'];

	public function checklists()
	{
		return $this->hasMany('Checklist');
	}

	public function getManagers(){
		$managers=User::where('group','=','1')->get();
		$array_managers=array(0 => 'Gestionnaire');
		foreach($managers as $manager)
		{
			$array_managers[$manager->id]=$manager->firstname.' '.$manager->lastname;
		}

		return $array_managers;
	}
	
}
