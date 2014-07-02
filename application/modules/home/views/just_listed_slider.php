<h1 class="title"> <img src="<?php echo base_url(); ?>assets/frontend/images/new.png" alt="new" /> Just Listed</h1>
<div class="row-fluid clearfix">
	<!-- Place somewhere in the <body> of your page -->
	<div id="slider" class="flexslider">
		<ul class="widget-blue slides">
	    <?php foreach($just_listed_property as $jlp)
	    {?>
			<li class="span3">
				<div class="img"><a href="<?php echo site_url('escapedetails/'.$jlp->custom_url);?>"> <img src="<?php echo base_url(); ?>images/property_img/featured/thumb/<?php echo $jlp->featured_image;?>" alt="list accomodation" /> </a> </div>
				<h4> <a href="<?php echo site_url('escapedetails/'.$jlp->custom_url);?>"><?php echo $jlp->title;?></a></h4>
				<span><a href="#">NZ <?php echo $jlp->price_night;?>/night </a> </span>
			</li>
		<?php }?>
		</ul>
	</div>
</div>
<link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/woothemes-FlexSlider/flexslider1.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/woothemes-FlexSlider/demo/css/demo1.css" type="text/css" media="screen" /> 
<script type="text/javascript">
// Can also be used with $(document).ready()
$(window).load(function() {
  $('.flexslider').flexslider({
    animation: "slide",
    animationLoop: true,
    itemWidth: 210,
    itemMargin: 5,
    minItems: 5,
    maxItems: 5
  });
});
  </script>