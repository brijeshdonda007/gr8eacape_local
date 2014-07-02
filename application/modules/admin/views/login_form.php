<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html class="not-ie" lang="en">
<!--<![endif]-->
<head>
<meta charset="utf-8">
<title><?php echo $page_title; ?> | GR8 Escapes</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="content-language" content="en">
<meta name="author" content="">
<meta name="description" content="">
<!-- Le styles -->
<!--<link href="<?php echo base_url(); ?>assets/frontend/css/bootstrap.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/frontend/css/style.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/frontend/css/bootstrap-responsive.css" rel="stylesheet">
</style>-->
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
    <![endif]-->
<!-- Le fav and touch icons -->
<!-- Font CSS  -->
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:400,600,700">

<!-- Core CSS  -->
<link rel="stylesheet" type="text/css" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/backend/fonts/glyphicons_pro/glyphicons.min.css">

<!-- Theme CSS -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/backend/css/theme.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/backend/css/pages.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/backend/css/plugins.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/backend/css/responsive.css">

<!-- Boxed-Layout CSS -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/backend/css/boxed.css">

<!-- Demonstration CSS -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/backend/css/demo.css">

<!-- Your Custom CSS -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/backend/css/custom.css">

<!-- Favicon -->
<link rel="shortcut icon" href="img/favicon.ico">

<link rel="shortcut icon" href="favicon.png">
</head>
<body data-spy="scroll" data-target=".bs-docs-sidebar" class="login-page">
	<div class="row">
		<div id="page-logo" style="text-align:center;">
			<a href="http://clients.responsive-pixel.com/greatescapes/home"><img src="<?php echo base_url(); ?>assets/frontend/images/logo.png" /></a>
		</div>
	</div>
	<section class="mainContent">
		<div class="wrapper clearfix">
			<div class="panel">
				<div class="panel-heading">
					<div class="panel-title">
						<i class="fa fa-lock"></i> Login to Admin
					</div>
				</div>
				<form name="admin_login" action="<?php echo site_url('admin/login')?>" method="post">
					<div class="panel-body">
						<div style="padding:10px 0 0 30px; color:red;">
							<?php if($this->session->flashdata('message')) echo $this->session->flashdata('message');?>
						</div>
						<div id="namefields">
							<div class="input-group margin-bottom"><span class="input-group-addon"><i class="fa fa-user"></i> </span>
								<input type="text" class="form-control" name="username" placeholder="username">
							</div>
				            <div class="clear"></div>
							<div class="input-group margin-bottom"><span class="input-group-addon"><i class="fa fa-key"></i> </span>
								<input type="password" class="form-control nm_txtfield" name="password" placeholder="password">
							</div>
							<div class="clear"></div>
						</div>
					</div>
					<div class="panel-footer">
						<span class="panel-title-sm pull-left">
							<input type="checkbox" id="c1" name="remember_me" value="1" />
							<label for="c1"><span></span>Remember me</label><br/>
							<a href="<?php echo site_url('admin/forgotpassword')?>" class="forgot">Forgot Password</a>
						</span>
						<div class="form-group margin-bottom-none">
							<button type="submit" class="btn btn-blue pull-right" value="Login">Log in</button>
							<div class="clearfix"></div>
						</div>
					</div>
				</form>
			</div>
			<div class="row-fluid login">
				<p class="copyright" style="text-align:center;">Copyright © 2014 Gr8escapes.com. All Rights Reserved</p>
			</div>
		</div>
	</section>
</body>
</html>
