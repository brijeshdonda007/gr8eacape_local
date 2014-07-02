<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta name="description" content="<?php echo @$settings->meta_description ?>" />

<meta name="keywords" content="<?php echo @$settings->meta_keyword; ?>" />

<?php $site_title = @$settings->site_title; ?>

<title>Great Escapes</title>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/frontend/css/bootstrap.css" />

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/frontend/css/bootstrap-responsive.css" />

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/frontend/css/style.css" />

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/frontend/nivo-slider/themes/default/default.css" type="text/css" media="screen" />

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/frontend/nivo-slider/themes/light/light.css" type="text/css" media="screen" />

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/frontend/nivo-slider/themes/dark/dark.css" type="text/css" media="screen" />

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/frontend/nivo-slider/themes/bar/bar.css" type="text/css" media="screen" />

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/frontend/nivo-slider/nivo-slider.css" type="text/css" media="screen" />

<!--[if IE 6]>

<link rel="stylesheet" type="text/css" href="js/lightbox/themes/default/jquery.lightbox.ie6.css" />

<![endif]-->

<!-- <script type="text/javascript" src="<?php echo base_url(); ?>assets/frontend/js/bootstrap-carousel.js"></script> -->

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

<!--<script type="text/javascript" src="<?php echo base_url(); ?>assets/frontend/js/jQuery-1.9.1.min.js"></script>-->

<script type="text/javascript" src="<?php echo base_url(); ?>assets/frontend/js/jquery.validate.min.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/frontend/js/bootstrap.min.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/frontend/js/modernizr.min.js"></script>

<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600|Titillium+Web:400,700' rel='stylesheet' type='text/css' />







</head>



<body>

    <?php $this->load->view('public/header');?>

    <div class="inner-container">

      <?php $this->load->view('user/user-header');?>  

<section class="mainContent">

    <div class="wrapper clearfix">

        <div class="row-fluid clearfix">

            

            <div class="span9">

                <?php $this->load->view($add_property); ?>

            </div>

        </div>

    </div>

</section>

    </div>

	<?php $this->load->view('public/footer'); ?>

</body>

</html>