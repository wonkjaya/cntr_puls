<head>
	<meta charset="utf-8">
	<title>Login Kasir</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="reload pulsa murah">
	<meta name="author" content="REZ reload">

	<!-- The styles -->
	<link id="bs-css" href="<?php echo baseUrlCounter('css','bootstrap-cerulean.css');?>" rel="stylesheet">
	<style type="text/css">
	  body {
		padding-bottom: 40px;
	  }
	  .sidebar-nav {
		padding: 9px 0;
	  }
	</style>
	<link href="<?php echo baseUrlCounter('css','bootstrap-responsive.css');?>" rel="stylesheet">
	<link href="<?php echo baseUrlCounter('css','charisma-app.css');?>" rel="stylesheet">
	<link href="<?php echo baseUrlCounter('css','jquery-ui-1.8.21.custom.css');?>" rel="stylesheet">
	<link href="<?php echo baseUrlCounter('css','fullcalendar.css');?>" rel="stylesheet">
	<link href="<?php echo baseUrlCounter('css','bootstrap-classic.css');?>" rel="stylesheet">
	<link href="<?php echo baseUrlCounter('css','chosen.css');?>" rel="stylesheet">
	<link href="<?php echo baseUrlCounter('css','uniform.default.css');?>" rel="stylesheet">
	<link href="<?php echo baseUrlCounter('css','colorbox.css');?>" rel="stylesheet">
	<link href="<?php echo baseUrlCounter('css','jquery.cleditor.css');?>" rel="stylesheet">
	<link href="<?php echo baseUrlCounter('css','jquery.noty.css');?>" rel="stylesheet">
	<link href="<?php echo baseUrlCounter('css','noty_theme_default.css');?>" rel="stylesheet">
	<link href="<?php echo baseUrlCounter('css','elfinder.min.css');?>" rel="stylesheet">
	<link href="<?php echo baseUrlCounter('css','elfinder.theme.css');?>" rel="stylesheet">
	<link href="<?php echo baseUrlCounter('css','jquery.iphone.toggle.css');?>" rel="stylesheet">
	<link href="<?php echo baseUrlCounter('css','opa-icons.css');?>" rel="stylesheet">
	<link href="<?php echo baseUrlCounter('css','uploadify.css');?>" rel="stylesheet">

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- The fav icon -->
	<link rel="shortcut icon" href="<?php echo baseUrlCounter('image','favicon.ico');?>">
		
</head>

<body>
		<div class="container-fluid">
		<div class="row-fluid">
		
			<div class="row-fluid">
				<div class="span12 center login-header">
					<h2>REZ reload</h2>
				</div><!--/span-->
			</div><!--/row-->
			
			<div class="row-fluid">
				<div class="well span5 center login-box">
					<div class="alert alert-info">
						<?php
						if(isset($err) AND $err!=""){
						 echo $err;
						}else{
						 echo "Please login with your Username and Password.";
						}
						?>
					</div>
					<form class="form-horizontal" action="<?php echo siteUrlCounter('login'); ?>" method="post">
						<fieldset>
							<div class="input-prepend" title="Username" data-rel="tooltip">
								<span class="add-on"><i class="icon-user"></i></span>
								<input autofocus class="input-large span10" name="kasir_username" id="username" type="text" />
							</div>
							<div class="clearfix"></div>

							<div class="input-prepend" title="Password" data-rel="tooltip">
								<span class="add-on"><i class="icon-lock"></i></span>
								<input class="input-large span10" name="kasir_password" id="password" type="password" />
							</div>
							<div class="clearfix"></div>


							<p class="center span5">
							<button type="submit" class="btn btn-primary">Login</button>
							</p>
						</fieldset>
					</form>
				</div><!--/span-->
			</div><!--/row-->
				</div><!--/fluid-row-->
		
	</div><!--/.fluid-container-->
