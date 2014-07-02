<?php
if(isset($_POST['pageLimit']) && !empty($_POST['pageLimit'])){
	$pageLimit=$_POST['pageLimit'];
}else{
	$pageLimit=3;
}
$pageLimit=$pageLimit;
?>
<div class="count_results"><img src="<?php echo base_url(); ?>assets/frontend/images/search-home.png" /><span class="result-first"><?php echo (($total_ajax_search > 0)?$total_ajax_search:'No');?></span> escapes found <?php if($this->input->post('keywords')) {?>in <span class="result-last"><?php echo $this->ajax_model->capitalizeWords($this->input->post('keywords'));?></span><?php }?></div>
<?php
    if(count($total_ajax_search) > 0)
    {
    ?>
	<ul class="widgets">
	    <?php 
	    $i=1;
	    foreach($search_results as $pl)
	    {
	   if($i%3 == 1){ $liclass = 'marginLeft-none clear';} else{ $liclass = '';} 
#	   if($pl->admin_action == 'verified'){$pink_tick_class = 'pinkTick';}
	    $total_avgt = 0;
	        foreach($ratings_cat as $rc)
	        {
	         $eachcat_avg_rate = $this->ajax_model->avgRateByCatID($rc->id, $pl->id);   
	         $total_avgt +=  $eachcat_avg_rate->avgr;
	         }
	        $ovarall_ratingst = ($total_avgt/count($ratings_cat));
	        $total_reviews = $this->ajax_model->geAllReviews($pl->id);
	    ?>
		<li class="span4  <?php echo @$liclass;?>">
			<div class="img"><a href="<?php echo site_url('escapedetails/'.$pl->custom_url);?>"><img src="<?php echo base_url(); ?>images/property_img/featured/thumb/<?php echo $pl->featured_image;?>" alt="<?php echo $pl->title;?>"/></a></div>
			<h4><a href="<?php echo site_url('escapedetails/'.$pl->custom_url);?>"><?php echo $pl->title;?></a></a></h4>
			<div class="left">
				<h5>NZ <?php echo $pl->price_night;?>/night</h5>
				<div class="stars-overall-top"><?php echo $ovarall_ratingst;?></div>
				<div><?php if(count($total_reviews) > 0){?>(<?php echo count($total_reviews); ?> Guest Reviews)<?php } else { echo '(No Reviews)'; }?></div>
			</div>
			<div class="owner"> <a href="#"><img src="<?php echo base_url(); ?>images/profile_img/thumb/<?php echo $pl->profile_picture;?>" alt="profile" /> <?php echo $pl->first_name;?> </a> </div>
			<?php if($pl->admin_action == 'verified'){?>
			<!--<div class="<?php echo @$pink_tick_class;?>"><img src="<?php echo base_url(); ?>assets/frontend/images/pinkTick.png" alt="pink tick" /></div>-->
			<?php } ?>
		</li>
	<?php $i++; }?>
	</ul>
<?php
    }
    $per_page = 3;
    $loadCount=$pageLimit+3;
    if($total_ajax_search > $pageLimit){
    ?>
	<div class="clear"></div>
	<div class="load_more_link">
		<button id="loadmorex" class="btn btn-large btn-block buttonGreen" onclick="loadRefineSearchedData('<?php echo $loadCount;?>')">Show me more accomodations <span class="flash"></span></button>
	</div>
    <?php
         }
        else{
//               echo 'No Data Found';
        }
    ?>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/frontend/js/jquery.min.js"></script>
<script>
$.noConflict();
jQuery(document).ready(function($) {
$(function() {
    $('div.stars-overall-top').starsOverallTop();
});
$.fn.starsOverallTop = function() {
    return $(this).each(function() {
        var val = parseFloat($(this).html());
        var size = Math.max(0, (Math.min(5, val))) * 15;
        var $span = $('<span />').width(size);
        $(this).html($span);
    });
}
});
</script>