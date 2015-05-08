@if(Auth::user()->group==1)
<!-- MODAL
  ================================================== -->

<div id="modal_edit" class="supercontainer modal">
<div class="container">
<div class="sixteen columns" style="padding:40px 0;">

<div class="modal-close modal-open-btn" rel="modal_edit">
<i class="fa  fa-angle-double-down "></i>
</div><!--modal-close-->


{{ Form::model($checklist,[
    'url' => 
    $checklist->id ? 
        URL::route('checklists.update',['id' => $checklist->id])
    :
        URL::route('checklists.store')

    ,'method' => $checklist->id ? 'PUT' :  'POST'
]) }}

<div class="titre-main" style="color:#202020">
@if($checklist->id) # Éditer une mission
@else # Ajouter une mission
@endif

</div><!--titre-main-->

<div class="row" style="margin-bottom:0;">

    <div class="eight columns alpha">
    {{ Form::text('name',null,[
        'class' => $errors->has("name") ? "error" : "",
        'placeholder' => 'Nom de la mission'
    ])}}
    </div>

    <div class="eight columns omega">
        {{ Form::select('user_id', $managers, $checklist->user_id)}}
    </div>

</div><!--row-->


<div class="row">

<style> label{ display:inline; cursor: pointer; } </style>

<span class="left" style="color:#202020; font-weight:700; margin-right:10px;">Type de mission : </span>
<span class="left" style="color:#202020; margin-right:30px;">
    {{ Form::radio('mission_type', '3', false,['id'=>'id_princ']) }}
    <label for="id_princ"><i class="fa fa-star-o" style="margin-right:2px; margin-left:5px; font-size:14px;"></i> Princière</label>
</span>
<span class="left" style="color:#202020; margin-right:30px;">
    {{ Form::radio('mission_type', '2', false,['id'=>'id_collective']) }}
    <label for="id_collective"><i class="fa fa-group" style="margin-right:2px; margin-left:5px; font-size:14px;"></i> Collective</label>
</span>
<span class="left" style="color:#202020;">
    {{ Form::radio('mission_type', '1', false,['id'=>'id_solo']) }}
    <label for="id_solo"><i class="fa fa-user" style="margin-right:2px; margin-left:5px; font-size:14px;"></i> Solo</label>
</span>
<br class="clear">
</div><!--row-->

<div class="row" style="margin-bottom:0;">
<div class="sixteen columns alpha">
{{ Form::textarea('small_description',null,['style' => 'min-height:75px;','placeholder' => 'Descritpion courte du projet'])}}
</div></div><!--row-->



<div class="row" style="margin-bottom:0;">
<div class="sixteen columns alpha">
{{ Form::textarea('big_description',null,['style' => 'min-height:200px', 'placeholder' => 'Description longue du projet'])}}
</div>
</div><!--row-->

<div class="row">
    {{ Form::submit($checklist->id ? "Éditer la mission" : "Créer la mission") }}
</div><!--row-->

{{ Form::close() }}

</div><!--sixteen-->
</div><!--container-->
</div><!--supercontainer-->





<div class="supercontainer modal" id="modal-tache">
<div class="container">
<div class="sixteen columns" style="padding:40px 0;">

<div class="modal-close modal-open-btn" rel="modal-tache">
<i class="fa  fa-angle-double-down "></i>
</div><!--modal-close-->
    

{{ Form::model(null,[
  'url' => URL::route('items.store',['checklist_id' => $checklist->id])
  ,'method' => 'POST'
]) }}
  
  {{ Form::hidden("checklist_id", $checklist->id) }}

  <div class="row" style="font-size:22px; color:#333; display:block; padding-right:75px;font-weight:700;">
  # Ajouter une tâche
  <br>

 <span style="color:#306695; font-size:16px; display:block; margin-top:10px;">
  {{ Form::text("name",null,['placeholder' => 'Titre de l\'item'])}}
</span>

{{ Form::textarea("description",null,['placeholder' => 'Description', 'style' => 'min-height:150px;']) }}


      {{ Form::label('dday_prev','Delai d\'exécution',['class' => 'form-label'])}}
      {{ Form::selectRange('dday_prev', -20, 20, 0)}}


      {{ Form::label('dedicated_to','Élément dédié à',['class' => 'form-label'])}}
      {{ Form::select('dedicated_to', array('0' => 'Utilisateur', '1' => 'Awex'))}}



  {{ Form::submit("Ajouter",['style' => 'display:inline-block;']) }}

{{ Form::close() }}

  </div><!--row-->

</div><!--sixteen-->
</div><!--container-->
</div><!--supercontainer-->



<!-- END MODAL 
 ==================================================-->
@endif



<div class="container main-container">
  <div class="sixteen columns">

    <div class="titre-main"># {{ $checklist->name }} <div class="right add-bottom">

    @if(Auth::user()->group==1)
      <a href="#" class="modal-open-btn" rel="modal_edit" style="font-size:14px; line-height:22px;"><i class="fa fa-edit" style="margin-right:6px;"></i>Editer</a>
    @elseif(!isset($checklist_user->id) || !$checklist_user->id)
      <a href="{{ URL::route('checklist_users.join',['id' => $checklist->id]) }}" style="font-size:22px; line-height:22px;"><i class="fa fa-plus-square-o" style="margin-right:6px;"></i>S'INSCRIRE &Agrave; LA MISSION</a>
    @endif

    <br class="clear"></div></div>
    <!--titre-main-->
    
    <div class="row" style="margin-bottom:50px;">
      <span style="color:#FFF;">{{ $checklist->big_description }}</span>
    </div><!--row-->

    @if(Auth::user()->group==1)
      <div class="row" style="margin-bottom:50px;">
        <a href="#" class="modal-open-btn" rel="modal-tache" style="font-size:22px; line-height:22px; font-weight:700;"><i class="fa fa-plus-square-o" style="margin-right:10px;"></i>AJOUTER UNE TÂCHE</a>
      </div><!--row-->
    @endif

    @foreach ($date_list as $date_view)
    
    <div class="row" style="margin-bottom:0;">
      <div class="one columns alpha add-bottom"><div class="checklist-date">
        <div class="checklist-date-desktop"><span>
          <?php 
          if(isset($checklist_user->id) && $checklist_user->id && $checklist_user->dday!="0000-00-00"){
            $time=strtotime($checklist_user->dday);
            $decal=$date_view->dday_prev;
            $unJour = 3600 * 24;
            $time_format = $time-($decal*$unJour);
            echo date("M",$time_format);
          }else{
            echo "Jour";
          }
          ?>
        </span>
          <?php
          if(isset($checklist_user->id) && $checklist_user->id && $checklist_user->dday!="0000-00-00"){
            echo date("d",$time_format);
          }else{
            echo $date_view->dday_prev;
          }
          ?>
          <?php if($date_view->dday_prev==0){ ?><i class="fa fa-flag" style="color:#009900; font-size:14px;"></i><?php } ?>
        </div>
        <!--checklist-date-desktop--><div class="checklist-date-mobile"><?php 
          if(isset($checklist_user->id) && $checklist_user->id && $checklist_user->dday!="0000-00-00"){ 
            echo date("M - d",$time_format); 
          }else{ 
            echo  "Jour ".$date_view->dday_prev; 
          }?></div><!--checklist-date-mobile-->
        </div><!--checklist-date-->
      <div class="date-btn-plus" style="display:none; text-align:center; margin-top:10px;"><a href="ajout-item.html" style="color:#FFF; font-weight:700;"><i class="fa fa-plus-square-o"></i></a></div>
      </div><!--one-->
      <div class="fifteen columns omega add-bottom">

        <?php $j=1; $class=""; ?>

        @foreach ($array_item as $item_view)

            <?php if($item_view->dday_prev!=$date_view->dday_prev) continue; ?>

            @if($j==1)
                <div class="row" style="margin-bottom:0;">
                <?php $class="alpha"; ?>
            @elseif($j==2)
                <?php $class=""; ?>
            @elseif($j==3)
                <?php $class="omega"; ?>
            @endif

                {{-- HARD-CODE --}}
                @if($item_view->name=="More_foifjioqfjdmq")
                    @if(Auth::user()->group==0 && (isset($checklist_user->id) && $checklist_user->id) && $checklist->mission_type==1)
                    <div class="five columns {{ $class }} checklist-item add-bottom">
                
                      {{ Form::model(null,[
                        'url' => URL::route('checklist_users.edit')
                        ,'method' => 'POST'
                      ]) }}

                      {{ Form::hidden("id", $checklist_user->id) }}
                      {{ Form::text("dday",$checklist_user->dday,["placeholder" => "Date jour j","id" => "datepicker"]) }}
                      {{ Form::submit("Enregistrer",['style' => 'display:inline-block;']) }}
                      
                    {{ Form::close() }}

                    </div>
                    <!--five checklist-item-->
                    @endif

                @else

                  <div class="five columns {{ $class }} checklist-item add-bottom">
                    <div class="dashboard-liste">

                      @if($item_view->dedicated_to==1)
                        <div class="ribbon-wrapper-green"><div class="ribbon-green">AWEX</div></div>
                      @endif

                      <div class="dashboard-titre">{{ $item_view->name }}</div><!--dashboard-titre-->

                      <div class="dashboard-list-content"> <span style="display:block;"><em>{{ $item_view->description }}</em></span>

                          @if(Auth::user()->group==1)
                              <span style="display:block; font-size:32px;font-weight:700; margin-top:15px;"><span style="color:#0C0;">{{$item_view->numDone}}</span><span style="color:#AAA;">/{{$item_view->numInscrit}} <i class="fa fa-group" style="margin-right:5px; font-size:24px;"></i></span></span>
                          @else

                            <div class="checklist-statut right" style="margin-top:15px;">

                            @if(isset($checklist_user->id) && $checklist_user->id)

                              @if(isset($item_view->status))

                                  @if($item_view->status->status==1)

                                    @if($item_view->dedicated_to==0)
                                    <a href="{{ URL::route('checklist_user_items.update',['id' => $item_view->status->id,'status' => 2]); }}" style="color:#F00;">
                                    <i class="fa fa-check-square-o" style="color:#009900; font-size:32px;"></i></a>
                                    @else
                                    <i class="fa fa-check-square-o" style="color:#009900; font-size:32px;"></i>
                                    @endif

                                  @elseif($item_view->status->status==2)  

                                    @if($item_view->dedicated_to==0)
                                    <a href="{{ URL::route('checklist_user_items.update',['id' => $item_view->status->id,'status' => 0]); }}" style="color:#F00;">
                                    <i class="fa fa-square" style="color:#CCC; font-size:32px;"></i></a>
                                    @else
                                    <i class="fa fa-square" style="color:#CCC; font-size:32px;"></i>
                                    @endif

                                  @elseif($item_view->status->status==0)

                                    @if($item_view->dedicated_to==0)
                                    <a href="{{ URL::route('checklist_user_items.update',['id' => $item_view->status->id,'status' => 1]); }}" style="color:#F00;">
                                    <i class="fa fa-square-o" style="color:#CCC; font-size:32px;"></i></a>
                                    @else
                                    <i class="fa fa-square-o" style="color:#CCC; font-size:32px;"></i>
                                    @endif

                                  @endif

                              @else

                                  @if($item_view->dedicated_to==0)
                                    <a href="{{ URL::route('checklist_user_items.create',['checklist_users_id' => $checklist_user->id,'item_id' => $item_view->id,'status' => 1]); }}" style="color:#F00;">
                                    <i class="fa fa-square-o" style="color:#AAA; font-size:32px;"></i></a>
                                  @else
                                    <i class="fa fa-square-o" style="color:#AAA; font-size:32px;"></i>
                                  @endif

                              @endif

                            @endif

                            </div><!--statut-->
                            <br class="clear">

                          @endif

                      </div>
                      <!--dashboard-list-content </a>-->

                       <div class="dashboard-list-type">
                      
                      <div class="left">
                      @if(Auth::user()->group==1)
                      <a class="confirm_box" href="{{ URL::route('items.destroy',['checklist_id' => $item->checklist_id,'id' => $item_view->id]); }}"><i class="fa fa-trash-o" style="font-size:14px; color:#FFF;"></i></a> 
                      @endif
                      </div>
                      <!--left-->  
                      
                      <div class="right">
                        @if(isset($checklist_user->id) && $checklist_user->id)
                          @if(isset($item_view->status))
                            @if($item_view->status->status==1)
                              Terminé
                            @elseif($item_view->status->status==2)
                              Non applicable
                            @elseif($item_view->status->status==0)
                              En cours
                            @endif
                          @else
                              En cours
                          @endif
                        @endif
                        </div>
                        <!--right--> 

                        <br class="clear">
                      </div>
                      <!--dashboard-list-type--> 

                    </div>
                  <!--dashboard-list--> 
                </div>
                <!--five checklist-item-->
                    
              @endif

           @if($j==3 or end($array_item)==$item)
                <?php $j=0; ?>
                </div>
            @endif

            <?php $j++; ?>
        @endforeach
        
      </div>
      <!--fifteen--> 
      
    </div>
    <!--row--> 
   
   @endforeach
    
  </div>
  <!--sixteen--> 
  
</div>
<!--container main-container--> 
