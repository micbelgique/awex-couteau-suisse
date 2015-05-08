@if(Auth::user()->group==1)
<!-- MODAL
  ================================================== -->

<div id="add_checklist" class="supercontainer modal">
<div class="container">
<div class="sixteen columns" style="padding:40px 0;">

<div class="modal-close modal-open-btn" rel="add_checklist">
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
# 
@if($checklist->id) Éditer @else Ajouter @endif
une mission
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
{{ Form::textarea('small_description',null,['style' => 'min-height:75px;','placeholder' => 'Description courte du projet'])}}
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

<!-- End modal 
  ================================================== -->
@endif


<div class="container main-container">
    
    <div class="sixteen columns">
    
    <div class="dashboard-intro">
    <span class="slogan-header">Feel organised<br /></span><div class="slogan-subheader">ORGANISER.LISTER.CHECKER</div><br><br><br />Assurez-vous d'avoir accompli l'ensemble de vos tâches avant / pendant et après votre voyage...</div><!--dashboard-intro-->
   
<?php $j=1; $class=""; ?>

@foreach($checklists as $checklist_view)

    @if($j==1)
        <div class="row" style="margin-bottom:0;">
        <?php $class="alpha"; ?>
    @elseif($j==2)
        <?php $class=""; ?>
    @elseif($j==3)
        <?php $class="omega"; ?>
    @endif

    {{-- HARD-CODE --}}
    @if($checklist_view->name=="More_foifjioqfjdmq")
        @if(Auth::user()->group==1)
         <div class="one-third column omega dashboard-liste-btn add-bottom">
        <a href="#" class="modal-open-btn" rel="add_checklist"><i class="fa fa-plus-square-o" style=""></i></a>
        </div><!--one-third dashboard-liste-->
        @endif
    @else

        <div class="one-third column {{ $class }} dashboard-liste add-bottom">
        @if(Auth::user()->group==0 && $checklist_view->isIn==true)
            <div class="ribbon-wrapper-green"><div class="ribbon-green">INSCRIT</div></div>
        @endif

        @if($checklist_view->id==8 && Auth::user()->group==0)
            <div class="ribbon-wrapper-orange"><div class="ribbon-orange">INVIT&Eacute;</div></div>
        @endif

        <div class="dashboard-titre">{{ $checklist_view->name }}
            @if(Auth::user()->group==1)
            <div style="display:inline-block; margin-left:5px;"><a class="confirm_box" href="{{ URL::route('checklists.destroy',['id' => $checklist_view->id]); }}"><i class="fa fa-trash-o" style="font-size:14px; color:#FFF;"></i></a> </div><!--right-->
            @endif
        <br class="clear"></div><!--dashboard-titre-->
        <a href="{{ URL::route('pages.checklists',['id'=>$checklist_view->id]) }}"><div class="dashboard-list-content">
        <span style="display:block; margin-bottom:15px;font-size:13px;"><em>{{ $checklist_view->small_description }}</em></span>

        @if(Auth::user()->group==1)
            <span style="display:block; font-size:28px;font-weight:700;"><span style="color:#AAA;">{{ sizeof($checklist_view->checklistuser) }} <i class="fa fa @if(Auth::user()->group==1) fa-group @else fa-cog @endif" style="margin-right:5px; font-size:24px;"></i></span></span>
        @else
            <span style="display:block; font-size:28px;font-weight:700;"><span style="color:#0C0;">{{ $checklist_view->numDone }}</span><span style="color:#AAA;">/{{ sizeof($checklist_view->item) }} <i class="fa fa @if(Auth::user()->group==1) fa-group @else fa-cog @endif" style="margin-right:5px; font-size:24px;"></i></span></span>
        @endif

        </div><!--dashboard-list-content--></a>  

        <div class="dashboard-list-type">
        
        {{--
        <div class="left"><i class="fa fa-check-square-o" style="margin-right:2px;" font-size:14px;></i> XX/XX/XX | <i class="fa fa-calendar" style="margin-right:2px;" font-size:14px;></i> XX/XX/XX </div><!--right-->
        --}}
        <div class="right">{{ getMissionType($checklist_view->mission_type); }} </div><!--right-->
        <br class="clear">
        </div><!--dashboard-list-type-->
        </div><!--one-third dashboard-liste-->
    @endif


    @if($j==3 or end($checklists)==$checklist_view)
        <?php $j=0; ?>
        </div>
    @endif

    <?php $j++; ?>

@endforeach

    </div><!--row-->
    
 </div><!--sixteen-->
    
</div><!--container main-container-->



 