<section class="content">
  <div class="wrapper clearfix">
<!-- POPULAR ACCOMODATION RESTING LISTS-->
	<?php if (empty($city_lists)){ ?>
    <h1 class="title"> 
    	<img src="<?php echo base_url(); ?>assets/frontend/images/popular-icon.png"  alt="popular icon" />
    	No escapes found
    </h1>
    <?php } else { ?>
    <h1 class="title"> 
    	<img src="<?php echo base_url(); ?>assets/frontend/images/popular-icon.png"  alt="popular icon" /> Listing <?php echo count($city_lists);?> <strong> Cities</strong> under <?php echo $region_name->region_name;?> 
    </h1>
    <div id="wrapper">
        <div id="pageData">
           <div class="row-fluid clearfix">
				<ul class="widgets city-list">
					<?php
					$i=1;
					foreach($city_lists as $rr)
					{
					 if($i%4 == 1){ $liclass = 'marginLeft-none clear';} else{ $liclass = '';} 
					?>
					<li class="span3 <?php echo @$liclass;?>">
					  <?php if($rr->featured_image)
					  {
					   $photo = base_url().'images/city/thumb/'.$rr->featured_image;
					  }
					  else
					  {
					   $photo = base_url().'assets/frontend/images/no-image-location.png';   
					  }
					 ?>
					    <div class="img"><a href="<?php echo site_url('region/' . $region_name->region_name .'/city/'. $rr->city_name);?>"><img src="<?php echo $photo;?>" alt="<?php echo $rr->city_name;?>" title="<?php echo $rr->city_name;?>"/></a></div>
					    <div class="title"><a href="<?php echo site_url('region/' . $region_name->region_name .'/city/'. $rr->city_name);?>"><?php echo $rr->city_name;?></a></div>
					  </li>
					<?php
					$i++;}
					?>
				</ul>
				<div class="clear"></div>
			</div>
		</div>
	</div>
	<?php } ?>
  </div>
</section>