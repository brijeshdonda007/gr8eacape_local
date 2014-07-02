<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<script type="text/javascript"> var base_url = '<?php echo base_url(); ?>'; </script>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="description" content="<?php echo @$settings->meta_description ?>" />
		<meta name="keywords" content="<?php echo @$settings->meta_keyword; ?>" />
		<?php $site_title = @$settings->site_title; ?>
		<title><?php echo $page_title; ?> | GR8 Escapes</title>
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/frontend/css/bootstrap.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/frontend/css/style.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/frontend/nivo-slider/themes/default/default.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/frontend/nivo-slider/themes/light/light.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/frontend/nivo-slider/themes/dark/dark.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/frontend/nivo-slider/themes/bar/bar.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/frontend/nivo-slider/nivo-slider.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/frontend/css/bootstrap-responsive.css" />
		
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
		
		
		<!--[if IE 6]><link rel="stylesheet" type="text/css" href="js/lightbox/themes/default/jquery.lightbox.ie6.css" /><![endif]-->
		<!-- <script type="text/javascript" src="<?php echo base_url(); ?>assets/frontend/js/bootstrap-carousel.js"></script> -->
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/frontend/js/jQuery-1.9.1.min.js"></script>
<!--<script type="text/javascript" src="<?=base_url()?>assets/frontend/js/jquery.rating.pack.js"></script>-->
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/frontend/js/jquery.validate.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/frontend/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/frontend/js/modernizr.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/frontend/nivo-slider/jquery.nivo.slider.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/frontend/js/jquery-autotab.js"></script>
		<script defer src="<?php echo base_url();?>assets/frontend/woothemes-FlexSlider/jquery.flexslider1.js"></script>
		<script  type="text/javascript" src="<?php echo base_url();?>assets/frontend/js/custom.js"></script>
		
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
		    $(window).load(function() {
		        $('#slider').nivoSlider();
		    });
		</script>
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600|Titillium+Web:400,700' rel='stylesheet' type='text/css' />
	</head>
<header>
	<div class="wrapper clearfix">
		<h1 class="logo"><a href="<?php echo site_url('home'); ?>"><span>GR8 Escapes</span></a></h1>
		<div class="span8 pull-right">
		<?php 
		if($this->session->userdata('user_id')) {
		?>
			<div class="header-welcome">Welcome! <?php echo $user_profile_info->first_name;?> || <a href="<?php echo site_url('user/index');?>">Dashboard</a></div>
			<div class="clear"></div>
      	<?php
		}
		?>
      <?php if($this->session->userdata('user_id')){
          if(($user_profile_info->user_type == 2) || ($user_profile_info->user_type == 1))
          {
              if($user_profile_info->user_type == 1)
              {
                 ?>
      <a href="<?php echo site_url('user/editProfile/tolist');?>"><input type="button" value="LIST YOUR ESCAPE" /></a>
                  <?php
              }
 else {
          ?>
        <a href="<?php echo site_url('user/addescape');?>"><input type="button" value="LIST YOUR ESCAPE" /></a>
    <?php
      }
          }
      }
      else{
          ?>
        <a href="<?php echo site_url('login');?>"><input type="button" value="LIST YOUR ESCAPE" /></a>
        <?php
      }
    ?>
      <nav>
        <ul>
          <!--enter your links and pages-->
          <li><a href="<?php echo site_url('search');?>">Search Escapes</a></li>
          <!--<li><a href="<?php echo site_url('home/faq') ?>">FAQ</a></li>-->
          <li><a href="<?php echo site_url('how-it-works') ?>">how it works</a></li>
          <?php if(!$this->session->userdata('user_id')){ ?>
          <li><a href="<?php echo site_url('login'); ?>">sign in /</a> <a href="<?php echo site_url('register'); ?>">sign up</a></li>
          <?php } else { ?>
          <li><a href="<?php echo site_url('user/logout') ?>">Logout</a></li>
          <?php } ?>
        </ul>
      </nav>
    </div>
  </div>
</header>
