<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title><?= $this->config->item('site_name') . ' - ' . $this->config->item('site_title') ?> | <? echo $title ?></title>

<meta name="keywords" content="<?= $this->config->item('site_meta_keywords') ?>" />

<meta name="description" content="<?= $this->config->item('site_meta_desc') ?>" />

<link REL="SHORTCUT ICON" href="<?=base_url()?>favicon.ico" />

<link href="<?=base_url()?>css/default.css" rel="stylesheet" type="text/css" />

<link href="<?=base_url()?>css/purerev.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/selectbox.css" />

<script src="<?=base_url()?>js/jquery.js" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript" src="<?=base_url()?>js/jquery.easing.1.3.js"></script>

<script type="text/javascript" src="<?=base_url()?>js/jquery.selectbox-0.5.js"></script>

<script type="text/javascript">

	$(document).ready(function() {

		$('.mini-width').selectbox({widthtop:37,widthcontainer:70});

		

	});

	</script>

<? echo $_styles ?>

<? echo $_scripts ?>    

</head>

<body>

            <div id="wrapper">    

                    <?php $this->load->view('common/header');?>

                   <div id="container">

                      	<div class="p-cnt">

                   		 <?= $content_top; ?> 

                         <?= $content_middle; ?> 

                       </div>     

  					</div>

                    

    		</div>  

            <?= $this->load->view('common/footer'); ?>

</body>        

       