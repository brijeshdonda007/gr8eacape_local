<?php

if(!$this->session->userdata('admin_user_id')){

			redirect('admin');

		} ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/backend/css/style.css" type="text/css" />

<!--<link href='http://fonts.googleapis.com/css?family=Open+Sans:600,400' rel='stylesheet' type='text/css' />-->

<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/jQuery-1.9.1.min.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/page.js"></script>

<!--<script src="<?php echo base_url(); ?>assets/backend/ckeditor/ckeditor.js" type="text/javascript"></script>

<title>Great Escapes</title>

<script type="text/javascript" src="<?php echo base_url()?>assets/backend/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>

<script type="text/javascript">

tinymce.init({

    selector: "textarea"

    

 });

</script>-->



</head>



<body>

<div class="wrappertop">

<?php $this->load->view('admin/header'); ?>

</div>



<div class="wrapperleft">

<?php $this->load->view('admin/sidebar'); ?>

</div>



<div class="wrapperright">

<?php $this->load->view($main_content_view); ?>

</div>

<div class="clear"></div>



<div class="wrapperfooter">

<?php $this->load->view('admin/footer'); ?>

</div>



</body>

</html>