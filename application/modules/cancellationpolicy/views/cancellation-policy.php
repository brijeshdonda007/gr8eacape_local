<section id="content">

<div class="wrapper clearfix">

<ul class="breadcrumb">

  <li><img src="<?php echo base_url(); ?>assets/frontend/images/home-breadcrumb.png" /></li>

  <li><a href="<?php echo site_url('home'); ?>">Home</a> <span class="divider"><img src="<?php echo base_url(); ?>assets/frontend/images/breadcrumb-divider.png" alt="" /></span></li>

  <li><?php echo @$cancel->page_name; ?></li>

</ul>

<div class=" row-fluid">

	<div class="span12">

    	<?php echo @$cancel->page_description; ?>

    </div>

</div>

</div>

</section>
