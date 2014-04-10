<html>
	<head>
		<?php include 'config.php';?>
		<meta name="mobile-web-app-capable" content="yes">
		<link rel="icon" sizes="196x196" href="img/logo-196.png">
		<link rel="apple-touch-icon" sizes="57x57" href="img/logo-57.png" />
		<link rel="apple-touch-icon" sizes="72x72" href="img/logo-72.png" />
		<link rel="apple-touch-icon" sizes="114x114" href="img/logo-114.png" />
		<link rel="apple-touch-icon" sizes="144x144" href="img/logo-144.png" />
		<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico" />
		<meta name="viewport" content="width=device-width">
		<title><?php echo $TITLE;?></title>
		<link rel="stylesheet" type="text/css" href="css/style.css"/>
		<script src="js/jquery-1.11.0.min.js" type="text/javascript" ></script>
		<script src="js/jquery.session.js" type="text/javascript" ></script>
		<script src="js/jquery.cookie.js" type="text/javascript" ></script>
		<script src="js/main.js" type="text/javascript" ></script>
	</head>
	<body>
		<div id="header">
			<img id="logo" alt="<?php echo $TITLE;?>" src="img/logo-48.png"/> 
			<span id="headline"><?php echo $TITLE;?> v<?php echo $VERSION;?></span> 
			<span id="powered">powered by</span>	
			<a id="wdlogo" href="http://webdad.eu/tools"><img alt="WebDaD-Tools" src="http://webdad.eu/images/logos/webdad_tools.png"/></a>	
		</div>
		<div id="content">
			<div id="input_data">
				<h1>Welcome to myBodyData!</h1> 
				<input class="tinput" id="weight" name="weight" type="text" placeholder="Weight"/> 
				<input class="tinput" id="size" name="size" type="text" placeholder="Size"/>  
				<span class="button" id="btn_submitdata">Submit</span>
			</div>
			<div id="thank_you">
				<h1>Thank you for the Input! Data Reading will be avaiable soon.</h1>
			</div>
			<div id="login">
				<h1>Please Login</h1>
				<input class="tinput" id="user" name="user" type="text" placeholder="Username"/>  
				<input class="tinput" id="password" name="password" type="password" placeholder="Password"/>
				<span class="button" id="btn_login">Submit</span>
			</div>
		</div>
		<div id="footer">
			<a id="impressum" href="http://webdad.eu/wd-impressum" >Impressum</a>	
			<a id="webdad" href="http://webdad.eu/"><img alt="WebDaD" src="http://webdad.eu/templates/webdad/images/logo.png"/></a> 	
		</div>
	</body>
</html>