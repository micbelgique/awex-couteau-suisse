<?php

class ItemsController extends BaseController {

	public $editable=array(
		'name' => ['name','text'],
		'description' => ['description','textarea'],
		'checklist_id' => ['checklist_id', 'hidden']
	);
	public $rules = [
		'name' => 'required|min:4'
	];

	public function index($checklist_id){
		$items = Checklist::find($checklist_id)->items;
		$this->layout->nest('content','items.index', compact('items'));
	}

	public function show($checklist_id, $id){
		$item = Item::findOrFail($id);
		$this->layout->nest('content','items.show', compact('item'));
	}

	public function edit($checklist_id, $id){
		$item = Item::findOrFail($id);
		
		$this->layout->nest('content','items.edit', ["item" => $item, "editable" => $this->editable]);
	}

	public function update($checklist_id, $id){
		$v = Validator::make(Input::all(),$this->rules);

		if($v->fails()){
			return Redirect::back()->withInput()->withErrors($v->errors())->with(['error' => 'Champs obligatoires']);
		}else{
			$post = Item::findOrFail($id);
			$post->update(Input::all());
			return Redirect::back()->with(['success' => 'Modification bien réalisée']);
		}
	}

	public function create($checklist_id){
		$item = new Item();
		$item->checklist_id = $checklist_id;
		$this->layout->nest('content','items.edit', ["item"=>$item,"editable"=>$this->editable]);
	}

	public function store(){
		$item = Item::create(Input::all());
		//return Redirect::route('items.edit', array("checklist_id"=>$item->checklist_id, "id"=>$item->id))->with(['success'=>'Création bien réalisée']);
		return Redirect::back()->with(['success'=>'Création bien réalisée']);
	}

	public function destroy($checklist_id, $id){
		Item::destroy($id);
		return Redirect::back()->with(['success'=>'Suppression de l\'elément bien réalisée']);
		//return Redirect::route('checklists.show', array("id"=>$checklist_id))->with(['success' => 'Suppression de l\'elément bien réalisée']);
	}

}
