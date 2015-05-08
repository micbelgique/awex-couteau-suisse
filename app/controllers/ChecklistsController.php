<?php

class ChecklistsController extends BaseController {

	public $rules = [
		'name' => 'required|min:4',
		'mission_type' => 'required',
		'user_id' => 'required'
	];
	public $mission_type = [
		0 => 'Type de mission',
		1 => 'Mission solo',
		2 => 'Mission collective',
		3 => 'Mission princière'
	];
	

	public function index(){
		$checklists = Checklist::get();
		$this->layout->nest('content','checklists.index', compact('checklists'));
	}

	public function show($id){
		$checklist = Checklist::findOrFail($id);
		$user_id = Auth::user()->id;

		$checklist_user = ChecklistUser::where('checklist_id', '=', $id)->where('user_id', '=', $user_id)->first();

		$array_item=array();
		foreach($checklist->item as $item){
			if($checklist_user){
				$item->status=ChecklistUserItem::where('item_id','=', $item->id)->where('checklist_users_id','=', $checklist_user->id)->first();
			}
			$array_item[]=$item;
		}

		$this->layout->nest('content','checklists.show', ["checklist" => $checklist, "array_item" => $array_item, "checklist_user" => $checklist_user]);
	}

	public function show_front($id){
		$checklist = Checklist::findOrFail($id);
		$user_id = Auth::user()->id;

		$user = new User();
		$managers = $user->getManagers();

		$item = new Item();

		$user_id = Auth::user()->id;
		$checklist_user = ChecklistUser::where('checklist_id', '=', $id)->where('user_id', '=', $user_id)->first();
		
		$numInscrit=sizeof($checklist->checklistuser);

		$array_item=array();
		foreach($checklist->item as $item){
			if($checklist_user){
				$item->status=ChecklistUserItem::where('item_id','=', $item->id)->where('checklist_users_id','=', $checklist_user->id)->first();
			}

			// GET NUM DE TACHE REALISEE / NUM D'INSCRIT
			$item->numInscrit=$numInscrit;

			$numDone=ChecklistUserItem::where('item_id','=', $item->id)->distinct()->get();
			$item->numDone=sizeof($numDone);

			$array_item[]=$item;
		}

		//CODE BRUT
		$array_item[]= new ChecklistUserItem(["name" => "More_foifjioqfjdmq"]);
		
		$date_list = DB::table('items')->where('checklist_id','=',$id)->select('dday_prev')->distinct()->orderBy('dday_prev')->get();

		$this->layout->nest('content','pages.checklists', ["checklist" => $checklist, 'managers' => $managers, 'item' => $item, "array_item" => $array_item, "checklist_user" => $checklist_user, 'date_list' => $date_list]);
	}

	public function update($id){
		$v = Validator::make(Input::all(),$this->rules);

		if($v->fails()){
			return Redirect::back()->withInput()->withErrors($v->errors())->with(['error' => 'Champs obligatoires']);
		}else{
			$post = Checklist::findOrFail($id);
			$post->update(Input::all());
			return Redirect::back()->with(['success' => 'Modification bien réalisée']);
		}
	}

	public function create(){
		$checklist = new Checklist();
		$user = new User();
		$managers = $user->getManagers();
		$this->layout->nest('content','checklists.edit', ["checklist"=>$checklist, 'mission_type' => $this->mission_type, 'managers' => $managers]);
	}

	public function edit($id){
		$checklist = Checklist::findOrFail($id);
		$user = new User();
		$managers = $user->getManagers();
		
		$this->layout->nest('content','checklists.edit', ["checklist" => $checklist, 'mission_type' => $this->mission_type, 'managers' => $managers]);
	}

	public function store(){
		$checklist = Checklist::create(Input::all());
		//return Redirect::route('checklists.edit',$checklist->id)->with(['success'=>'Création bien réalisée']);
		return Redirect::to('/');
	}

	public function destroy($id){
		Checklist::destroy($id);
		return Redirect::back()->with(['success' => 'Suppression bien réalisée']);
	}

}
