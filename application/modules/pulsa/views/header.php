<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php if(isset($title)){echo $title;}else{echo "belom di set";} ?></title>
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
	<link href="<?php echo baseUrlCounter('css','bootstrap-classic.css');?>" rel="stylesheet">
	<link href="<?php echo baseUrlCounter('css','jquery-ui-1.8.21.custom.css');?>" rel="stylesheet">
	<!-- jQuery -->
	<script src="<?php echo base_url('assets/js/jquery-1.7.2.min.js');?>"></script>
	<!-- jQuery UI -->
	<script src="<?php echo base_url('assets/js/jquery-ui-1.8.21.custom.min.js');?>"></script>
	<!-- transition / effect library -->
	<!-- The fav icon -->
	<link rel="shortcut icon" href="<?php echo baseUrlCounter('image','favicon.ico');?>">
		
</head>

<body>
		<!-- topbar starts -->
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="index.html"> <img alt="Charisma Logo" src="<?php echo baseUrlCounter('image','logo.png') ?>" /> <span>REZ Reload</span></a>
				
				<!-- theme selector starts -->
				<!-- theme selector ends -->
				<div class="top-nav nav-collapse">
					<ul class="nav">
						<li></li>
						<li></li>
					</ul>
				</div><!--/.nav-collapse -->
			</div>
		</div>
	</div>
	<!-- topbar ends -->

