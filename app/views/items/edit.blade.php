<p><a href="{{ URL::route('checklists.show',['id' => $item->checklist_id ]) }}">&bull; Retour</a></p>

{{ Form::model($item,[
	'url' => 
	$item->id ? 
		URL::route('items.update',['checklist_id' => $item->checklist_id, 'id' => $item->id])
	:
		URL::route('items.store',['checklist_id' => $item->checklist_id])

	,'method' => $item->id ? 'PUT' :  'POST'
]) }}

	@foreach ($editable as $key => $value)

		
		<div class="form-group">

			@if ($value[1]!='hidden')
			{{ Form::label($key,$value[0],['class' => 'form-label'])}}
			@endif

			{{ Form::$value[1]($key,null,['class' => 'form-control'])}}
			@if ($errors->has($key))
				<p><!--{{ $errors->first($key) }}-->Le champ <strong>{{ $value[0] }}</strong> est obligatoire</p>
			@endif
			
		</div>

	@endforeach

		<div class="form-group">
			{{ Form::label('dday_prev','Delai d\'exécution',['class' => 'form-label'])}}
			{{ Form::selectRange('dday_prev', -20, 20)}}
		</div>

		<div class="form-group">
			{{ Form::label('dedicated_to','Élément dédié à',['class' => 'form-label'])}}
			{{ Form::select('dedicated_to', array('0' => 'Utilisateur', '1' => 'Awex'))}}
		</div>
	
	<br>
	{{ Form::submit(
			$item->id ? "Sauvegarder" : "Ajouter"
	,['class' => 'btn btn-primary']) }}

{{ Form::close() }}