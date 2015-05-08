<h1>Tous les éléments</h1>

<p><a href="{{ URL::route('items.create') }}">Créer un élément</a></p>

@foreach ($items as $item)
	<div style="background-color:#f6f6f6; margin:10px 0px; padding:5px;">
		<h2 style="display:inline-block; margin:0px;">
			<a href="{{ URL::route('checklists.show',array ('id' => $item->id)) }}">
				{{ $item->name }}
			</a>
		</h2>
		<div style="float:right; margin-top:7px;"><a class="confirm_box" href="{{ URL::route('checklists.destroy',['id' => $item->id]); }}" style="color:#F00;">supprimer</a></div>
	</div>
@endforeach