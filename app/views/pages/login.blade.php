<div class="login">
  
  <div class="header-logo-accueil"><i class="fa fa-check-square-o"></i> <span style="font-family: 'Pacifico', cursive;">Checklist</span></div>

{{ Form::model($user,[
	'url' => URL::to('login'),
	'method' => 'POST'
]) }}

	{{ Form::text("email",null,[
		'class' => $errors->has("email") ? "error" : "", 
		'style' => 'text-align:center;', 
		'placeholder' => 'Veuillez entrer un email'
	])}}
	{{ Form::password("password",[
		'class' => ($errors->has("password") or $errors->has("email")) ? "error" : "", 
		'style' => 'text-align:center;', 
		'placeholder' => 'Veuillez entrer un mot de passe'
	])}}

	{{ Form::submit("Valider" ,['class' => 'button']) }}
	
{{ Form::close() }}

</div><!-- login -->