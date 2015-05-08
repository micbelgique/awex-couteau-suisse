<p><a href="{{ URL::route('checklists.show', ['id' => $item->checklist_id]) }}">&bull; Retour à la liste</a></p>

<h1>{{ $item->name }}</h1> <a href="{{ URL::route('items.edit', ['checklist_id' => $item->checklist_id, 'id' => $item->id ]) }}" style="float:right; margin-top:-30px;">Editer l'élément</a>

<p>{{ $item->description }}</p>