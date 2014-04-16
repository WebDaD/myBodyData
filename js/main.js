/**
 * 
 */
//TODO: Replace FadeIn with nicer animation (from right, to left)
//TODO: Submit on Enter on passwd and size and pwd_rep and username
$( document ).ready(function() {

	if($.session.get('mbd_user_id') !== undefined || $.cookie('mbd_user_id') !== undefined){
		
		if($.session.get('mbd_user_id') === undefined){$.session.set('mbd_user_id', $.cookie('mbd_user_id'));}
		if($.cookie('mbd_user_id') === undefined){$.cookie('mbd_user_id', $.session.get('mbd_user_id'), { expires: 7});}
		
		$("#login").hide();
		$("#input_data").show();
	} 

	//TODO: btn_display_account
	//TODO: btn_cancel_acc
	//TODO: btn_save (account)
	
	//TODO: btn_display_forgot (pwd)
	//TODO: btn_send_password
	//TODO: btn_cancel_forgot
	
	
	//TODO: btn_stats
	
	$('#content').on('click', '#btn_logout', function(evt) {
    	evt.preventDefault();
    	$.removeCookie('mbd_user_id');
    	$.session.remove('mbd_user_id');
    	$.session.clear();
		$("#input_data").hide("slide",{direction:'right'},function(){$("#login").show("slide",{direction:'left'},500);});
	});
	
	 $('#content').on('click', '#btn_display_register', function(evt) {
	    	evt.preventDefault();
	    	$("#login").hide("slide",{direction:'right'},500, function(){$("#register").show("slide",{direction:'left'},500);});
	    	
	 });
	 
	 $('#content').on('click', '#btn_display_password', function(evt) {
	    	evt.preventDefault();
	    	$("#input_data").hide("slide",{direction:'left'},500, function(){$("#edit_password").show("slide",{direction:'right'},500);});
	 });
	 $('#content').on('click', '#btn_cancel', function(evt) {
	    	evt.preventDefault();
	    	$("#edit_password").hide("slide",{direction:'right'},500, function(){$("#input_data").show("slide",{direction:'left'},500);});
	    	
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
	    			$("#register").hide("slide",{direction:'left'},500, function(){$("#login").show("slide",{direction:'right'},500);});
	    			
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
	    	$.post( "php/checkLogin.php", { user: $("#user").val(), password: $.md5($("#password").val()) })
	    		.done(function( data ) {
	    			if(data.match("^Error")){
	    				$("#user").addClass("error");
	    				$("#password").addClass("error");
	    				alert(data);
	    			} else {
	    				$.session.set('mbd_user_id', data);
	    				$.cookie('mbd_user_id', data, { expires: 7 });
	    				$("#login").hide("slide",{direction:'left'},500, function(){$("#input_data").show("slide",{direction:'right'},500);});
	    				
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
	    				$("#edit_password").hide("slide",{direction:'right'},500, function(){$("#input_data").show("slide",{direction:'left'},500);});
	    				
	    			} else { //Error
	    				alert(data);
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
	    	//TODO: if size contains ',' -> '.' 
	    	if(error)return;
	    	$.post( "php/writeData.php", { weight: $("#weight").val(), size: $("#size").val(), user_id:$.session.get("mbd_user_id") })
	    		.done(function( data ) {
	    			if(data.match("^Error")){ //Error
	    				$("#size").addClass("error");
	    				$("#weight").addClass("error");
	    				alert(data);
	    			} else { //All OK
	    				$("#results").html(data);
	    				$("#input_data").hide("slide",{direction:'left'},500, function(){$("#thank_you").show("slide",{direction:'right'},500);});
	    			}
	    	});
	 });
	
});