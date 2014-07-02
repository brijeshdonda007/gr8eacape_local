<h4 class="marginNone">My Profile Details</h4>
<div class="triangleArrow top"></div>
<div class="Block clearfix">
	<div class="row-fluid clearfix">
		<div class="span10">
			<h4><?php echo @$user_profile_info->first_name.' '.@$user_profile_info->last_name;?></h4>
			<p class="span4 marginNone mediumParagraph"> <strong class="mediumStrong">Mailing Address:</strong> <br />
				Street Number: <?php echo @$user_profile_info->street_no;?><br />
				Street Name: <?php echo @$user_profile_info->street_name;?><br />
				Suburb: <?php echo @$user_profile_info->suburb;?><br/>
				City: <?php echo @$user_profile_info->city;?><br/>
				Region: <?php echo @$user_profile_info->region;?><br/>
				Country: <?php echo @$user_country->countryname;?><br/>
				Post Code: <?php echo @$user_profile_info->post_code;?><br/>
				Phone: <?php echo @$user_profile_info->phone;?><br/>
				Mobile: <?php echo @$user_profile_info->mobile;?><br/>
			</p>
		</div>
    	<div class="span2 marginNone"> 
			<?php if($this->session->userdata('Fb_user') && empty($user_profile_info->profile_picture)){  ?>
			<img src="https://graph.facebook.com/<?php echo $fb_arr['id'] ;?>/picture" width="100" height="84" class="img-polaroid pull-left" alt="user dashboard imgae" />
			<?php } elseif(!empty($user_profile_info->profile_picture)){ ?>
			<img src="<?php echo base_url();?>images/profile_img/thumb/<?php echo @$user_profile_info->profile_picture;?>" class="img-polaroid pull-left" alt="user dashboard imgae" /> 
			<?php }else{ ?>
			<img src="<?php echo base_url();?>assets/frontend/images/no-image.png" class="img-polaroid pull-left" alt="user dashboard imgae" /> 
			<?php } ?>


			<?php $total_avgl = 0;
			    if (!empty($ratings_cat)){

                    foreach($ratings_cat as $rc)
                    {
                        $eachcat_avg_rate = $this->user_model->avgRateByCatID($rc->id, $this->session->userdata('user_id'));
                        $total_avgl      +=  $eachcat_avg_rate->avgr;
                    }
				    $ovarall_ratingsl = ($total_avgl/count($ratings_cat));
			    } ?>
			<div class="stars-overall-top" style="margin-top: 10px; clear: both;"><?php echo @$ovarall_ratingsl;?></div>

      		<div class="clear"></div>
      		<small>(<?php if(count($total_reviews) > 0) { echo count($total_reviews); } else{ echo '0'; }?>) Guest Reviews)</small> <a href="<?php echo site_url('user/editProfile');?>"><strong>EDIT PROFILE</strong></a>
		</div>
		<div class="clear"></div>
		<p style="margin-top:10px;"> <strong class="mediumStrong">About Myself</strong><br />
  		<?php echo @$user_profile_info->about_yourself;?> </p>
	</div>
</div>
<?php $this->load->view('user/booking-requests-buyer') ?>
<script>
jQuery(function() {
    jQuery('div.stars-overall-top').starsOverallTop();
});
jQuery.fn.starsOverallTop = function() {
    return jQuery(this).each(function() {
        var val = parseFloat(jQuery(this).html());
        var size = Math.max(0, (Math.min(5, val))) * 15;
        var $span = jQuery('<span />').width(size);
        jQuery(this).html($span);
    });
}
</script>