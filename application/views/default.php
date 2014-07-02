<?php

if(!$this->session->userdata('admin_user_id')){

        redirect('admin');

} ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta name="description" content="GR8 Escapes - Site Administrator" />

<title>GR8 Escapes - Site Administrator</title>


<!--<link rel="stylesheet" href="<?php echo base_url(); ?>assets/frontend/css/bootstrap.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/backend/css/style.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/frontend/css/bootstrap-responsive.css" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:600,400' rel='stylesheet' type='text/css' />
<script type="text/javascript" src="//code.jquery.com/jquery-1.8.1.min.js"></script>-->
<!-- Font CSS  -->
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:400,600,700">

<!-- Core CSS  -->
<link rel="stylesheet" type="text/css" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/backend/fonts/glyphicons_pro/glyphicons.min.css">

<!-- Plugin CSS -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/backend/vendor/plugins/calendar/fullcalendar.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/backend/vendor/plugins/datatables/css/datatables.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/backend/css/animate.css">

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

<!--	Array of CSS Files	-->
		
<?php 
if(isset($csstyles)){
foreach ($csstyles as $css){ ?>
	<link href="<?php echo $css; ?>" rel="stylesheet" type="text/css">
<?php 
	}
}
 ?>
<!--	Array of CSS Files ENDS	-->


<!-- Core Javascript - via CDN -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>

<!-- Plugins - Via CDN -->
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/flot/0.8.1/jquery.flot.min.js"></script>
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery-sparklines/2.1.2/jquery.sparkline.min.js"></script>
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/fullcalendar/1.6.4/fullcalendar.min.js"></script>

<!-- Plugins - Via Local Storage
<script type="text/javascript" src="vendor/plugins/jqueryflot/jquery.flot.min"></script>
<script type="text/javascript" src="vendor/plugins/sparkline/jquery.sparkline.min.js"></script>
<script type="text/javascript" src="vendor/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="vendor/plugins/calendar/fullcalendar.min.js"></script>
-->

<!-- Plugins -->
<script type="text/javascript" src="<?php echo base_url();?>assets/backend/vendor/plugins/calendar/gcal.js"></script><!-- Calendar Addon -->
<script type="text/javascript" src="<?php echo base_url();?>assets/backend/vendor/plugins/jqueryflot/jquery.flot.resize.min.js"></script><!-- Flot Charts Addon -->
<script type="text/javascript" src="<?php echo base_url();?>assets/backend/vendor/plugins/datatables/js/jquery.dataTables.js"></script><!-- Datatable Bootstrap Addon -->

<!-- Theme Javascript -->
<script type="text/javascript" src="<?php echo base_url();?>assets/backend/js/uniform.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/backend/js/main.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/backend/js/bootbox.min.js"></script>
<!--<script type="text/javascript" src="js/plugins.js"></script>-->
<script type="text/javascript" src="<?php echo base_url();?>assets/backend/vendor/plugins/validate/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/backend/js/custom.js"></script>

<!--	Array of Page JS Files	-->
<?php 
if(isset($javascriptsArray)){
	foreach ($javascriptsArray as $javascript){ ?>
		<script src="<?php echo $javascript; ?>" type="text/javascript"></script>
<?php 
	}
}
 ?>	
<!--	Array of Page JS Files ENDS	-->	

<script type="text/javascript">
jQuery(document).ready(function() {
	  
	// Init Theme Core 	  
	Core.init();
});
 </script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/page.js"></script>

</head>


<body>
	<?php $this->load->view('admin/header'); ?>
	<div id="main">
		<?php $this->load->view('admin/sidebar'); ?>
		<?php if($this->session->userdata('msg')):?>
		<div class="system_msg" style="display:block;"><?php echo $this->session->userdata('msg');$this->session->unset_userdata(array('msg'=>'')); ?></div>
		<?php endif;?>
		<section id="content_wrap">
			<div class="container">
				<?php $this->load->view($main_content_view); ?>
			</div>
		</section>
	</div>
	<div class="clear"></div>
	<div class="wrapperfooter">
		<?php $this->load->view('admin/footer'); ?>
	</div>
</body>
</html>