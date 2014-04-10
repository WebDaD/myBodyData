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
		<script src="js/main.js" type="text/javascript" ></script>
	</head>
	<body>
		<div id="header"> <!-- TODO: bg black, height:50px-->
			<img id="logo" alt="<?php echo $TITLE;?>" src="img/logo-48.png"/> <!-- TODO: Left attached -->
			<span id="headline"><?php echo $TITLE;?></span> <!-- TODO: Left attached -->
			<span id="version"><?php echo $VERSION;?></span>	<!-- TODO: Left attached -->
			<span id="powered">powered by</span><!-- TODO: right attached -->	
			<a id="wdlogo" href="<!-- TODO: Link -->"><img alt="WebDaD-Tools" src="<!-- TODO: Link -->"/></a><!-- TODO: right attached -->	
		</div>
		<div id="content">
			<div id="input_data">
				<h1>Welcome to myBodyData!</h1> <!-- TODO: centered -->
				<input id="weight" name="weight" type="text" placeholder="Weight"/>  <!-- TODO: centered -->
				<input id="size" name="size" type="text" placeholder="Size"/>  <!-- TODO: centered -->
				<span id="btn_submitdata">Submit</span><!-- TODO: centered -->
			</div>
			<div id="thank_you">
				<h1>Thank you for the Input! Data Reading will be avaible soon.</h1> <!-- TODO: centered -->
			</div>
			<div id="login">
				<h1>Please Login</h1> <!-- TODO: centered -->
				<input id="user" name="user" type="text" placeholder="Username"/>  <!-- TODO: centered -->
				<input id="password" name="password" type="password" placeholder="Password"/>  <!-- TODO: centered -->
				<span id="btn_login">Submit</span><!-- TODO: centered -->
			</div>
		</div>
		<div id="footer"> <!-- TODO: bg black, height:50px -->
			<a id="impressum" href="<!-- TODO: Link -->" >Impressum</a> <!-- TODO: left attached -->	
			<a id="webdad" href="<!-- TODO: Link -->"><img alt="WebDaD" src="<!-- TODO: Link -->"/></a> <!-- TODO: right attached -->	
		</div>
	</body>
</html>