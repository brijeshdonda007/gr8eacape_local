<script src="<?php echo base_url();?>assets/frontend/js/flowplayer-3.2.12.min.js"></script>
<div class="tabbable">
	<ul class="nav nav-tabs">
		<li class="active"><a href="#tab6" data-toggle="tab">Gallery</a></li>
		<?php if (!empty($property_detail->youtube_video_id)){ ?>
		<li class=""><a href="#tab7" data-toggle="tab">Video</a></li>
		<?php } ?>
	</ul>
	<div class="tab-content">
		<div class="tab-pane active" id="tab6">
			<ul id="pikame" class="jcarousel-skin-pika">
			      <?php foreach($property_gallery as $pgal): ?>
				    <li>
			  	    	<a href="http://gr8escapes.com"><img src="<?php echo base_url();?>images/property_img/gallery/<?php echo $pgal->image;?>" /></a>
				    </li>
			    <?php endforeach ?>
			</ul>
		</div>
		<?php if ( !empty($property_detail->youtube_video_id)): ?>
		<div class="tab-pane" id="tab7">
            <iframe width="690" height="480" src="http://www.youtube.com/embed/<?php echo $property_detail->youtube_video_id; ?>" frameborder="0"> </iframe>
		</div>
		<?php endif ?>
	</div>
</div>
	<link type="text/css" href="<?php echo base_url();?>assets/frontend/picka/styles/bottom.css" rel="stylesheet" />
        <script type="text/javascript" src="<?php echo base_url();?>assets/frontend/picka/lib/jquery.jcarousel.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/frontend/picka/lib/jquery.pikachoose.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#pikame").PikaChoose({carousel:true,speed:4000});
	});
</script>
<!--<?php if (!empty($property_video)){ ?>
<script language="JavaScript">
flowplayer("player", "<?php echo base_url();?>assets/frontend/js/flowplayer-3.2.16.swf");
</script>
<?php } ?>-->
<!--<script>
 $(window).load(function() {
  // The slider being synced must be initialized first
  $('#carousel').flexslider({
    animation: "slide",
    controlNav: false,
    animationLoop: false,
    slideshow: true,
    itemWidth: 110,
    itemMargin: 5,
    asNavFor: '#slider',
  });
  $('#slider').flexslider({
    animation: "fade",
    controlNav: false,
    animationLoop: true,
    slideshow: true,
    sync: "#carousel"
  });
});
</script>
<link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/woothemes-FlexSlider/flexslider.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/woothemes-FlexSlider/demo/css/demo.css" type="text/css" media="screen" /> 
<script defer src="<?php echo base_url();?>assets/frontend/woothemes-FlexSlider/jquery.flexslider.js"></script>-->