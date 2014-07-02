<?php
if(isset($_POST['pageLimit']) && !empty($_POST['pageLimit'])){
    $pageLimit=$_POST['pageLimit'];
}else{
    $pageLimit=3;
}
$pageLimit=$pageLimit;
?>
<div class="count_results"><?php echo (($prop_count_bycat > 0)?$prop_count_bycat:'No').' accomadtions found.';?></div>
<?php
	if(count($prop_count_bycat) > 0)
    {
    ?>
    	<ul class="widgets">
            <?php 
            $i=1;
            foreach($search_results as $pl)
            {
           if($i%3 == 1){ $liclass = 'marginLeft-none clear';} else{ $liclass = '';} 
#           if($pl->pink_tick == '1'){$pink_tick_class = 'pinkTick';}
            ?>
        <li class="span4  <?php echo @$liclass;?>">
          <div class="img"><a href="<?php echo site_url('escapedetails/'.$pl->custom_url);?>"><img src="<?php echo base_url(); ?>images/property_img/featured/thumb/<?php echo $pl->featured_image;?>" alt="<?php echo $pl->title;?>"/></a></div>
          <h4><a href="<?php echo site_url('escapedetails/'.$pl->custom_url);?>"><?php echo $pl->title;?></a></a></h4>
          <div class="left">
            <h5>NZ <?php echo $pl->price_night;?>/night</h5>
            <img src="<?php echo base_url(); ?>assets/frontend/images/rating-star.png" alt="rating star" />
            <div>(3 Guest Reviews)</div>
          </div>
          <div class="owner"> <a href="<?php echo site_url('owner/detail/'.$pl->owner_id);?>"><img src="<?php echo base_url(); ?>images/profile_img/thumb/<?php echo $pl->owner_picture;?>" alt="profile" /> <?php echo $pl->owner_name;?> </a> </div>
          <?php if($pl->pink_tick == '1'){?>
          <!--<div class="<?php echo @$pink_tick_class;?>"><img src="<?php echo base_url(); ?>assets/frontend/images/pinkTick.png" alt="pink tick" /></div>-->
          <?php } ?>
            </li>
        <?php $i++; }?>
        </ul>
<?php
    }
   $loadCount=$pageLimit+3;
//   echo $loadCount;
    if(($prop_count_bycat) >= $loadCount){
    ?>
    <div class="clear"></div>
<div class="load_more_link">
<button id="loadmorex" class="btn btn-large btn-block buttonGreen" onclick="loadCategoryData('<?php echo $loadCount;?>')">Show me more accomodations <span class="flash"></span></button>
</div>
    <?php
         }
        else{
//               echo 'No Data Found';
        }
    ?>