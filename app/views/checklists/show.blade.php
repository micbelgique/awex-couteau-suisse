<p><a href="{{ URL::route('checklists.index') }}">&bull; Retour</a></p>

<h1>{{ $checklist->name }}</h1> <a href="{{ URL::route('checklists.edit', ['id' => $checklist->id ]) }}" style="float:right; margin-top:-30px;">Editer la liste</a>

<p><a href="{{ URL::route('items.create', ['checklist_id' => $checklist->id ]) }}">Ajouter un élément</a></p>

@foreach ($array_item as $item)
	<div style="background-color:#f6f6f6; margin:10px 0px; padding:5px;">
		<h2 style="display:inline-block; margin:0px;">
			<a href="{{ URL::route('items.show',array ('checklist_id' => $item->checklist_id, 'id' => $item->id)) }}">
				&bull; {{ $item->name }}
			</a>
			<span style="font-size:12px;">
			@if(isset($item->status))
				@if($item->status->status==1)
					(Status: Fait)
				@elseif($item->status->status==2)
					(Status: Pas fait)
				@endif
			@else
					(Status: En cours)
			@endif
			</span>
		</h2>
		<p>
			{{ $item->description }}
		</p>

		<div style="float:right; margin-top:-20px;"><a class="confirm_box" href="{{ URL::route('items.destroy',['checklist_id' => $item->checklist_id,'id' => $item->id]); }}" style="color:#F00;">supprimer</a></div>

		@if($checklist_user->id)
			@if(isset($item->status))
				@if($item->status->status==2 || $item->status->status==0)
					<p><a href="{{ URL::route('checklist_user_items.update',['id' => $item->status->id,'status' => 1]); }}" style="color:#F00;">Fait</a></p>
				@elseif ($item->status->status==1 || $item->status->status==0)
					<p><a href="{{ URL::route('checklist_user_items.update',['id' => $item->status->id,'status' => 2]); }}" style="color:#F00;">Pas fait</a></p>
				@endif

			@else
				<p><a href="{{ URL::route('checklist_user_items.create',['checklist_users_id' => $checklist_user->id,'item_id' => $item->id,'status' => 1]); }}" style="color:#F00;">Fait</a></p>
				<p><a href="{{ URL::route('checklist_user_items.create',['checklist_users_id' => $checklist_user->id,'item_id' => $item->id,'status' => 2]); }}" style="color:#F00;">Pas fait</a></p>
			@endif


		@endif

	</div>
@endforeach