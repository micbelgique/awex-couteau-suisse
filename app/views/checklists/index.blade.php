<h1>Toutes les listes</h1>

<p><a href="{{ URL::route('checklists.create') }}">Créer une liste</a></p>

@foreach ($checklists as $checklist)
	<div style="background-color:#f6f6f6; margin:10px 0px; padding:5px;">
		<h2 style="display:inline-block; margin:0px;">
			<a href="{{ URL::route('checklists.show',array ('id' => $checklist->id)) }}">
				&bull; {{ $checklist->name }}
			</a>
		</h2>

		<a href="{{ URL::route('checklist_users.join',['id' => $checklist->id]) }}">Rejoindre la liste</a>

		<div style="float:right; margin-top:7px;"><a class="confirm_box" href="{{ URL::route('checklists.destroy',['id' => $checklist->id]); }}" style="color:#F00;">supprimer</a></div>
	</div>
@endforeach