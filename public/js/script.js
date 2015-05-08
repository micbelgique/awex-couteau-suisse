$(document).ready(function(){

	$(".confirm_box").click(function(e){
		$test = confirm('Êtes vous sûr de confirmer l\'action ?');
		if(!$test){ e.preventDefault(); }
		return $test;
	});
	
	$("input[type=submit]").click(function(){
		$(this).val("...");
		$(this).attr("onclick","return false;");
	});

	$(".open-notif").click(function(e){
		e.preventDefault;
		$div=$(".notifications-panel");	

		if($(this).find("span").html()==0){ return false; }	
		
		if(parseInt($div.height())==0){
			$element=$(".notifications-panel .container");
			$size=$element.height()+parseInt($element.css("margin-top"))+parseInt($element.css("margin-bottom"));
			$div.css("height",$size);
		}else{
			$div.css("height","0px");
		}
		return false;
	});
	
	$(".modal-open-btn").click(function(e){
		e.preventDefault();
		$(".modal#"+$(this).attr("rel")).toggleClass("modal-open");
		$(".notifications-panel").css("height","0px");
	});

	if($( "#datepicker" ).size()>0){
		$( "#datepicker" ).datepicker({ dateFormat: "yy-mm-dd" });
	}
});
