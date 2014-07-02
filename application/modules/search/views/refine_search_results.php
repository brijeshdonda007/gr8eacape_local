<div class="row-fluid clearfix">
<div class="count_results">
	<img src="<?php echo base_url(); ?>assets/frontend/images/search-home.png" />
	<span class="result-first"><?php echo (($total_num_search > 0)?$total_num_search:'No');?></span> escape<?php if ($total_num_search > 1) echo 's';?> found <?php if($this->input->post('keywords')) {?>in <span class="result-last"><?php echo $this->search_model->capitalizeWords($this->input->post('keywords'));?></span><?php }?></div>
<?php
    if(count($total_num_search) > 0)
    {
    ?>
    	<ul class="widgets">
            <?php 
            $i=1;
            foreach($search_results as $pl)
            {
           if($i%4 == 1){ $liclass = 'marginLeft-none clear';} else{ $liclass = '';} 
#           if($pl->admin_action == 'verified'){$pink_tick_class = 'pinkTick';}
           $total_avgt = 0;
                foreach($ratings_cat as $rc)
                {
                 $eachcat_avg_rate = $this->search_model->avgRateByCatID($rc->id, $pl->id);   
                 $total_avgt +=  $eachcat_avg_rate->avgr;
                 }
                $ovarall_ratingst = ($total_avgt/count($ratings_cat));
                $total_reviews = $this->search_model->geAllReviews($pl->id);
            ?>
        <li class="span3 <?php echo @$liclass;?>">
          <div class="img"><a href="<?php echo site_url('escapedetails/'.$pl->custom_url);?>"><img src="<?php echo base_url(); ?>images/property_img/featured/thumb/<?php echo $pl->featured_image;?>" alt="<?php echo $pl->title;?>"/></a></div>
          <h4><a href="<?php echo site_url('escapedetails/'.$pl->custom_url);?>"><?php echo $pl->title;?></a></a></h4>
          <div class="left">
            <h5>NZ <?php echo $pl->price_night;?>/night</h5>
            <div class="stars-overall-top"><?php echo $ovarall_ratingst;?></div>
                            <div><?php if(count($total_reviews) > 0){?>(<?php echo count($total_reviews); ?> Guest Reviews)<?php } else { echo '(No Reviews)'; }?></div>
          </div>
          <div class="owner"> <a href="<?php echo site_url('owner/detail/'.$pl->user_id)?>"><img src="<?php echo base_url(); ?>images/profile_img/thumb/<?php echo $pl->profile_picture;?>" alt="profile" /> <?php echo $pl->first_name;?> </a> </div>
          <?php if($pl->admin_action == 'verified'){?>
          <!--<div class="<?php echo @$pink_tick_class;?>"><img src="<?php echo base_url(); ?>assets/frontend/images/pinkTick.png" alt="pink tick" /></div>-->
          <?php } ?>
            </li>
        <?php $i++; }?>
        </ul>
    <?php
    }
    ?>
   <div class="clear"></div>
<div class="pagination"><?php echo $links; ?></div>
</div>
<script>
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
</script>
