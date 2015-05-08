@if($checklist->id>0)
<p><a href="{{ URL::route('checklists.show',['id' => $checklist->id ]) }}">&bull; Retour</a></p>
@else
<p><a href="{{ URL::route('checklists.index') }}">&bull; Retour</a></p>
@endif

{{ Form::model($checklist,[
	'url' => 
	$checklist->id ? 
		URL::route('checklists.update',['id' => $checklist->id])
	:
		URL::route('checklists.store')

	,'method' => $checklist->id ? 'PUT' :  'POST'
]) }}

	<div class="form-group">
		{{ Form::label('name','Nom de la liste',['class' => 'form-label'])}}
		{{ Form::text('name',null,['class' => 'form-control'])}}
		@if ($errors->has('name'))
			<p><!--{{ $errors->first($key) }}-->Le champ <strong>nom</strong> est obligatoire</p>
		@endif
	</div>

	<div class="form-group">
		{{ Form::label('mission_type','Type de mission',['class' => 'form-label'])}}
		{{ Form::select('mission_type', $mission_type, $checklist->mission_type)}}
		@if ($errors->has('mission_type'))
			<p><!--{{ $errors->first($key) }}-->Le champ <strong>type de mission</strong> est obligatoire</p>
		@endif
	</div>

	<div class="form-group">
		{{ Form::label('user_id','Gestionnaire',['class' => 'form-label'])}}
		{{ Form::select('user_id', $managers, $checklist->user_id)}}
		@if ($errors->has('user_id'))
			<p><!--{{ $errors->first($key) }}-->Le champ <strong>type de mission</strong> est obligatoire</p>
		@endif
	</div>

	<div class="form-group">
		{{ Form::label('small_description','Description courte du projet',['class' => 'form-label'])}}
		{{ Form::textarea('small_description',null,['class' => 'form-control'])}}
		@if ($errors->has('small_description'))
			<p><!--{{ $errors->first($key) }}-->Le champ <strong>description courte du projet</strong> est obligatoire</p>
		@endif
	</div>

	<div class="form-group">
		{{ Form::label('big_description','Description longue du projet',['class' => 'form-label'])}}
		{{ Form::textarea('big_description',null,['class' => 'form-control'])}}
		@if ($errors->has('big_description'))
			<p><!--{{ $errors->first($key) }}-->Le champ <strong>description longue du projet</strong> est obligatoire</p>
		@endif
	</div>
	
	<br>
	{{ Form::submit(
			$checklist->id ? "Sauvegarder" : "Ajouter"
	,['class' => 'btn btn-primary']) }}

{{ Form::close() }}