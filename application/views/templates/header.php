<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-combined.min.css" rel="stylesheet">
<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet" />
<link href="<?php echo base_url();?>static/css/admin-home/default.css" rel="stylesheet" type="text/css" media="all" />
<link href="<?php echo base_url();?>static/css/admin-home/fonts.css" rel="stylesheet" type="text/css" media="all" />
<link href="<?php echo base_url();?>static/css/admin-home/style.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="<?php echo base_url();?>static/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>static/js/jquery.jqprint-0.3.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>static/js/main.js"></script>

<!--[if IE 6]><link href="default_ie6.css" rel="stylesheet" type="text/css" /><![endif]-->

</head>
<body>
<div id="page" class="container">
	<div class="adler-logo">
		<p>Adler</p>
	</div>
	<div id="header">
		<div id="menu">
			<ul>
				<li value="1"  class="current_page_item" onclick="currentPage(this)" id="menu-home">Home</li>
				<li value="3" onclick="currentPage(this)" id="menu-status">Order Status</li>
				<li value="4"  onclick="currentPage(this)" id="menu-event">Create Event</li>
				<li value="5"  onclick="currentPage(this)" id="menu-report">Report</li>
				<li value="6" onclick="currentPage(this)" id="menu-cart"><!-- <a href="#" accesskey="6" title=""> -->Shopping Cart<!-- </a> --></li>
				
				<li id="logout-btn"><?php echo anchor('admin/logout', 'Logout'); ?></li>
				<li value="2" onclick="currentPage(this)" id="admin-user">User</li>
				<li id="login-name"><a><?php echo $username; ?></a></li>
			</ul>
		</div>
	</div>
	
	
	<div id="main">
