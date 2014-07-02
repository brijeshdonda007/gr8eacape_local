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
<link href="<?php echo base_url(); ?>assets/frontend/css/bootstrap.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/frontend/css/style.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/frontend/css/bootstrap-responsive.css" rel="stylesheet">
</style>
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
    <![endif]-->
<!-- Le fav and touch icons -->
<link rel="shortcut icon" href="favicon.png">
</head>
<body data-spy="scroll" data-target=".bs-docs-sidebar">
	<header>
		<div class="wrapper login clearfix">
			<div class="row-fluid">
				<h1 class="title">ADMIN PASSWORD RESET</h1>
			</div>
		</div>
	</header> 
	<section class="mainContent">
		<div class="wrapper clearfix">
			<div class="row-fluid login">
				<h1 class="logo"><a href="http://clients.responsive-pixel.com/greatescapes/home"><span>GR8 Escapes</span></a></h1>
			</div>
			<div class="row">

				<div class="span6">

				    <?php if($this->session->userdata('msg')):?>

				    <?php echo $this->session->userdata('msg');$this->session->unset_userdata(array('msg'=>'')); ?>

				    <h5><?php echo $this->session->userdata('msg');$this->session->unset_userdata(array('msg'=>'')); ?></h5>

				    <?php endif;?>

				    <form class="form-horizontal" name="change_password" id="change_password" method="post" action="<?php echo site_url('/admin/change_process/'.$email)?>">

				  

				  <div class="control-group">

				    <label class="control-label"> New password<span>*</span></label>

				    <div class="controls">

				      <input type="password" placeholder="Enter password" class="input-xlarge" name="password" id="password">

				       <?php echo form_error('password'); ?>

				    </div>

				  </div>

				  <div class="control-group">

				    <label class="control-label">Confirm password<span>*</span></label>

				    <div class="controls">

				      <input type="password" placeholder="Confirm password" class="input-xlarge" name="confirmation">

				    </div>

				  </div>

				  <input type="submit" class="btn buttonRed" value="Change your password">

				</form>

		

				<form class="form-horizontal login-signup">

					<div class="control-group">

				    	<div class="controls">

					

					</div>

				    </div>

				</form>

			    </div>

			</div>

			  </div>
			<div class="row-fluid login">
				<p class="copyright">Copyright Â© 2013 Gr8escapes.com. All Rights Reserved</p>
			</div>
		</div>
	</section>
</body>
</html>
