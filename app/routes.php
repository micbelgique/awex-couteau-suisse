<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/*
A NE PAS FAIRE 

fonction dans route,
redirection accueil depuis controller users
*/

define("PATH","http://localhost/laravel/awex-devcamp/public");


//BEGIN :: CODE BRUT 
function isBack(){
	$get=explode("/",Route::getCurrentRoute()->getPath());
	return isset($get[1]) && !empty($get[1]);
}
function equalRoute($key){
	$get=explode("/",Route::getCurrentRoute()->getPath());
	if($get[0]==$key){ return "active";	}
	else{ return ""; }
}
function getMissionType($i){
	$mission_type = [
		1 => '<i class="fa fa-user" style="margin-right:2px;" font-size:14px;></i> Solo',
		2 => '<i class="fa fa-group" style="margin-right:2px;" font-size:14px;></i> Collective',
		3 => '<i class="fa fa-star-o" style="margin-right:2px;" font-size:14px;></i> Princière'
	];
	if(isset($mission_type[$i])){
	    return $mission_type[$i];
	}else return "";
}
//END :: CODE BRUT 


//GET

	//ACCUEIL
	Route::get('/', [
		'uses' => 'UsersController@login',
		'as' => 'login'
	]);
	//LOGOUT
	Route::get('logout', [
		'uses' => 'UsersController@logout',
		'as' => 'logout'
	]);
	//CHECKLIST_ITEM - LISTING
	Route::get('/checklists/{id}',[
		'before' => 'auth',
		'uses' => 'ChecklistsController@show_front',
		'as' => 'pages.checklists'
	]);
	

//POST

	//LOGIN
	Route::post('login',[
		'before' => 'csrf',
		'uses' => 'UsersController@loginaction',
		'as' => 'login'
	]);

	//CHECKLIST - JOIN
	Route::get('/admin/checklists/{checklist_id}/join',[
		'before' => 'auth',
		'uses' => 'ChecklistUsersController@join',
		'as' => 'checklist_users.join'
	]);

	//CHECKLIST - AJOUT
	Route::post('/admin/dashboard/create',[
		'before' => 'auth',
		'uses' => 'ChecklistsController@store',
		'as' => 'checklists.store'
	]);

	//CHECKLIST - EDITION
	Route::put('/admin/dashboard/edit/{id}',[
		'before' => 'auth',
		'uses' => 'ChecklistsController@update',
		'as' => 'checklists.update'
	]);

	//CHECKLIST - DELETE
	Route::get('/destroy/{id}',[
		'before' => 'auth',
		'uses' => 'ChecklistsController@destroy',
		'as' => 'checklists.destroy'
	]);

	//CHECKLIST USER - EDITION
	Route::post('/checklists/edit',[
		'before' => 'auth',
		'uses' => 'ChecklistUsersController@edit',
		'as' => 'checklist_users.edit'
	]);

	//CHECKLIST USER ITEMS - AJOUT
	Route::get('/admin/{checklist_users_id}/{item_id}/{status}',[
		'before' => 'auth',
		'uses' => 'ChecklistUserItemsController@create',
		'as' => 'checklist_user_items.create'
	]);

	//CHECKLIST USER ITEMS - EDITION
	Route::get('/admin/{id}/{status}',[
		'before' => 'auth',
		'uses' => 'ChecklistUserItemsController@update',
		'as' => 'checklist_user_items.update'
	]);

	//ITEMS - AJOUT
	Route::post('/admin/checklists/{checklist_id}/items/create',[
		'before' => 'auth',
		'uses' => 'ItemsController@store',
		'as' => 'items.store'
	]);

	//ITEMS - DELETE
	Route::get('/admin/checklists/{checklist_id}/items/destroy/{id}',[
		'before' => 'auth',
		'uses' => 'ItemsController@destroy',
		'as' => 'items.destroy'
	]);