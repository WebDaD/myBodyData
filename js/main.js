/**
 * 
 */
$( document ).ready(function() {

	if($.session.get('mbd_user_id') !== undefined || $.cookie('mbd_user_id') !== undefined){
		
		if($.session.get('mbd_user_id') === undefined){$.session.set('mbd_user_id', $.cookie('mbd_user_id'));}
		if($.cookie('mbd_user_id') === undefined){$.cookie('mbd_user_id', $.session.get('mbd_user_id'), { expires: 7, path: '/' });}
		
		$("#login").hide();
		$("#input_data").show();
	} 

	
	 $('#content').on('click', '#btn_display_register', function(evt) {
	    	evt.preventDefault();
	    	$("#login").fadeOut("slow");
	    	$("#register").fadeIn("slow");
	 });
	 
	 $('#content').on('click', '#btn_display_password', function(evt) {
	    	evt.preventDefault();
	    	$("#input_data").fadeOut("slow");
	    	$("#edit_password").fadeIn("slow");
	 });
	
	 $('#content').on('click', '#btn_register', function(evt) {
	    	evt.preventDefault();
	    	var error = false;
	    	$("#email").removeClass("error");
	    	$("#username").removeClass("error");
	    	
	    	if($("#email").val()==""){
	    		$("#email").addClass("error");
	    		error=true;
	    	}
	    	
	    	if($("#username").val()==""){
	    		$("#username").addClass("error");
	    		error=true;
	    	}
	    	if(error)return;
	    	$.post( "php/register.php", { username: $("#username").val(), email: $("#email").val() })
	    		.done(function( data ) {
	    			if(data==0){
	    			alert("An E-Mail has been sent to the adress you provided, containing the password.");
	    			$("#register").fadeOut("slow");
	    			$("#login").fadeIn("slow");
	    			} else {
	    				alert(data);
	    			}
	    	});
	 });

	 $('#content').on('click', '#btn_login', function(evt) {
	    	evt.preventDefault();
	    	var error = false;
	    	$("#user").removeClass("error");
	    	$("#password").removeClass("error");
	    	
	    	if($("#user").val()==""){
	    		$("#user").addClass("error");
	    		error=true;
	    	}
	    	
	    	if($("#password").val()==""){
	    		$("#password").addClass("error");
	    		error=true;
	    	}
	    	if(error)return;
	    	$.post( "php/checkLogin.php", { user: $("#user").val(), pwd: $.md5($("#password").val()) })
	    		.done(function( data ) {
	    			if(data != 0){
	    				$.session.set('mbd_user_id', data);
	    				$.cookie('mbd_user_id', data, { expires: 7, path: '/' });
	    				$("#login").fadeOut("slow");
	    				$("#input_data").fadeIn("slow");
	    			} else {
	    				$("#user").addClass("error");
	    				$("#password").addClass("error");
	    			}
	    	});
	 });
	
	 $('#content').on('click', '#btn_password', function(evt) {
	    	evt.preventDefault();
	    	var error = false;
	    	$("#old_pwd").removeClass("error");
	    	$("#new_pwd").removeClass("error");
	    	$("#rep_pwd").removeClass("error");
	    	
	    	if($("#old_pwd").val()==""){
	    		$("#old_pwd").addClass("error");
	    		error=true;
	    	}
	    	
	    	if($("#new_pwd").val()==""){
	    		$("#new_pwd").addClass("error");
	    		error=true;
	    	}
	    	
	    	if($("#rep_pwd").val()==""){
	    		$("#rep_pwd").addClass("error");
	    		error=true;
	    	}
	    	
	    	if($("#rep_pwd").val() != $("#new_pwd").val()){
	    		$("#new_pwd").addClass("error");
	    		$("#rep_pwd").addClass("error");
	    		error=true;
	    	}
	    	
	    	if(error)return;
	    	$.post( "php/edit_passwd.php", { old_pwd: $.md5($("#old_pwd").val()), new_pwd: $.md5($("#new_pwd").val()), user_id:$.session.get("mbd_user_id") })
	    		.done(function( data ) {
	    			if(data == 0){ //Pwd has been changed
	    				alert("Your password has been changed.");
	    				$("#edit_password").fadeOut("slow");
	    				$("#input_data").fadeIn("slow");
	    			} else { //Error
	    				$("#old_pwd").addClass("error");
	    				$("#new_pwd").addClass("error");
	    				$("#rep_pwd").addClass("error");
	    			}
	    	});
	 });
	 
	 $('#content').on('click', '#btn_submitdata', function(evt) {
	    	evt.preventDefault();
	    	var error = false;
	    	$("#weight").removeClass("error");
	    	$("#size").removeClass("error");
	    	
	    	if($("#weight").val()==""){
	    		$("#weight").addClass("error");
	    		error=true;
	    	}
	    	
	    	if($("#size").val()==""){
	    		$("#size").addClass("error");
	    		error=true;
	    	}
	    	if(error)return;
	    	$.post( "php/writeData.php", { weight: $("#weight").val(), size: $("#size").val(), user_id:$.session.get("mbd_user_id") })
	    		.done(function( data ) {
	    			if(data != 1){ //All OK
	    				$("#input_data").fadeOut("slow");
	    				$("#results").html(data);
	    				$("#thank_you").fadeIn("slow");
	    			} else { //Error
	    				$("#size").addClass("error");
	    				$("#weight").addClass("error");
	    				alert("An Error has occured during the Save.");
	    			}
	    	});
	 });
	
});