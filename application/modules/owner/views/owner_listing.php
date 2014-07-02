<?php

if($total_property > 0)

{

?>

<div id="wrapper" class="span9">

        <div id="pageData">

            <div class="row-fluid clearfix">

                    <ul class="widgets">

                        <?php

                        $i=1;

                        foreach($escape_listings as $pl)
                        {

                         if($i%3 == 1){ $liclass = 'marginLeft-none clear';} else{ $liclass = '';} 

#                         if($pl->admin_action == 'verified'){$pink_tick_class = 'pinkTick';}

                        ?>

                      <li class="span4 <?php echo @$liclass;?>">

                        <div class="img"><a href="<?php echo site_url('escapedetails/'.$pl->custom_url);?>"><img src="<?php echo base_url(); ?>images/property_img/featured/thumb/<?php echo $pl->featured_image;?>" alt="<?php echo $pl->title;?>"/></a></div>

                        <h4><a href="<?php echo site_url('escapedetails/'.$pl->custom_url);?>"><?php echo $pl->title;?></a></a></h4>

                        <div class="left">

                          <h5>NZ <?php echo $pl->price_night;?>/night</h5>

                          <?php

                            $total_avgt = 0;

                            foreach($ratings_cat as $rc)

                            {

                             $eachcat_avg_rate = $this->owner_model->avgRateByCatID_prop($rc->id, $pl->id);   

                             $total_avgt +=  $eachcat_avg_rate->avgr;

                             }

                            $ovarall_ratingst = ($total_avgt/count($ratings_cat));

                            $total_reviews = $this->owner_model->geAllReviews_prop($pl->id);

                            ?>

                          <div class="stars-overall-top"><?php echo $ovarall_ratingst;?></div>

                            <div><?php if(count($total_reviews) > 0){?>(<?php echo count($total_reviews); ?> Guest Reviews)<?php } else { echo '(No Reviews)'; }?></div>

                        </div>

                        <div class="owner"> <a href="<?php echo site_url('owner/detail/'.$pl->owner_id);?>"><img src="<?php echo base_url(); ?>images/profile_img/thumb/<?php echo $pl->owner_pic;?>" alt="profile" /> <?php echo $pl->owner_name;?> </a> </div>

                        <?php if($pl->admin_action == 'verified'){?>

                        <!--<div class="<?php echo @$pink_tick_class;?>"><img src="<?php echo base_url(); ?>assets/frontend/images/pinkTick.png" alt="pink tick" /></div>-->

                        <?php } ?>

                          </li>

                      <?php

                        $i++;}

                      ?>

                    </ul>



      </div>

        </div>

    </div>

<div class="pagination"><?php echo $links; ?></div>

<?php

}

else

{

?>

  <p class="profile_detail">Sorry I do not have any escapes listed</p>

<?php

}

?>

<script type="text/javascript">

function loadData(pageLimit){

     $(".flash").show();

     $(".flash").fadeIn(400).html

            ('<img src="<?php echo base_url();?>assets/frontend/images/ajax-loading.gif" />');

     var dataString = 'pageLimit='+ pageLimit;

     $.ajax({

            type: "POST",

            url: "<?php echo site_url();?>ajax/loadMore_owner/"+'<?php echo $this->uri->segment(3);?>',

            data: dataString,

            cache: false,

            success: function(result){ 

            $(".flash").hide();

            $(".load_more_link").addClass('noneLink');

            $("#pageData").append(result);

      }

  });

}

</script>

<style>

    .noneLink{display:none;}

</style>



<!--<script type="text/javascript" src="<?php echo base_url(); ?>assets/frontend/js/jquery.min.js"></script>-->

<script>

//$.noConflict();

$(document).ready(function($) {

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
