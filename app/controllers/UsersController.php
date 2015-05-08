<?php

class UsersController extends BaseController {

	public $editable=array(
		'email' => ['Email','text'],
		'password' => ['Password','password'],
		'firstname' => ['Firstname','text'],
		'lastname' => ['Lastname','text']
	);

	/*CONNEXION*/
	public function login(){
		if(Auth::check()){
			
			$mission_type = [
				1 => 'Mission solo',
				2 => 'Mission collective',
				3 => 'Mission princière'
			];

			$checklists = Checklist::get();
			//CODE BRUT
			$checklists[]= new CheckList(["name" => "More_foifjioqfjdmq"]);

			$checklist = new Checklist(); $user = new User();
			$managers = $user->getManagers();

			$user_id = Auth::user()->id;

			$array_checklist=array();
			foreach($checklists as $checkL){
				$isIn =array();
				$isIn = ChecklistUser::where('checklist_id', '=', $checkL->id)->where('user_id', '=', $user_id)->first();

				if(sizeof($isIn)>0){
					$checkL->isIn = true;

					//RECUPERATION DES TACHES DEJA REALISEES
					$taskDone = ChecklistUserItem::where('checklist_users_id', '=', $isIn->id)->where('status', '=', 1)->distinct()->get();
					$checkL->numDone = sizeof($taskDone);

				}else{
					$checkL->isIn = false;
					$checkL->numDone = 0;
				}

				$array_checklist[]=$checkL;
			}

			$this->layout->nest('content','pages.dashboard', ["checklists"=>$array_checklist, "checklist"=>$checklist, 'mission_type' => $mission_type, 'managers' => $managers]);

		}else{
			$user = new User();
			$this->layout->nest('content','pages.login', compact('user'));
		}
	}
	public function register(){
		$user = array(
			'email' => Input::get('email'),
			'password' => Input::get('password'),
			'firstname' => Input::get('firstname'),
			'lastname' => Input::get('lastname')
		);

		$rules = [
			'email' => 'required|email|unique:users,email',
			'password' => 'required'
		];
		$v = Validator::make($user,$rules);

		$user['password']=Hash::make($user['password']);
		if($v->fails()){
			return Redirect::back()->withInput()->withErrors($v->errors())->with(['error' => 'Champs obligatoires']);
		}else{
			$user = User::create($user);
			return Redirect::back()->with(['success'=>'Inscription bien réalisée']);
		}
	}
	public function loginaction(){
		$user = array(
			'email' => Input::get('email'),
			'password' => Input::get('password')
		);
		$rules = [
			'email' => 'required',
			'password' => 'required'
		];
		$v = Validator::make($user,$rules);

		if(Auth::attempt($user)){
			return Redirect::to('/');
		}else{
			return Redirect::back()->withInput()->withErrors($v->errors());
		}

	}
	public function logout(){
		Auth::logout();
		return Redirect::to('/');
	}

	public function index(){
		$users = User::get();
		$this->layout->nest('content','users.index', compact('users'));
	}

	public function show($id){
		$user = User::findOrFail($id);
		$this->layout->nest('content','users.show', compact('user'));
	}

	public function edit($id){
		$user = User::findOrFail($id);
		$this->layout->nest('content','users.edit', ["user" => $user, "editable" => $this->editable]);
	}

	public function update($id){
		$user = array(
			'email' => Input::get('email'),
			'firstname' => Input::get('firstname'),
			'lastname' => Input::get('lastname')
		);
		$rules = [
			'email' => 'required|email|unique:users,email,'.$id
		];
		$v = Validator::make($user,$rules);
		
		$pass=Input::get('password');
		if(!empty($pass)){ $user["password"] = Hash::make($pass); }


		if($v->fails()){
			return Redirect::back()->withInput()->withErrors($v->errors())->with(['error' => 'Champs obligatoires']);
		}else{
			$post = User::findOrFail($id);
			$post->update($user);
			return Redirect::back()->with(['success' => 'Modification bien réalisée']);
		}
	}

	public function create(){
		$user = new User();
		$this->layout->nest('content','users.edit', ["user"=>$user,"editable"=>$this->editable]);
	}

	public function store(){
		$rules = [
			'email' => 'required|email|unique:users,email',
			'password' => 'required'
		];
		$v = Validator::make(Input::all(),$rules);

		if($v->fails()){
			return Redirect::back()->withInput()->withErrors($v->errors())->with(['error' => 'Champs obligatoires']);
		}else{
			$user = User::create(Input::all());
			return Redirect::route('users.edit',$user->id)->with(['success'=>'Création bien réalisée']);
		}
	}

	public function destroy($id){
		User::destroy($id);
		return Redirect::back()->with(['success' => 'Suppression bien réalisée']);
	}

}
