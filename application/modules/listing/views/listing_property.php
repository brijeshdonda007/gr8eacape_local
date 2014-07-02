<section class="content">

  <div class="wrapper clearfix">

<?php

    if($total_rows > 0){

?>

    <h1 class="title"> <img src="<?php echo base_url(); ?>assets/frontend/images/popular-icon.png"  alt="popular icon" /> <?php echo $total_rows;?> <strong>Escapes</strong> under <?php echo $suburb_rs->suburb_name;?> renting right now </h1>

    <div id="wrapper">

        <div id="pageData">

         

                           <div class="row-fluid clearfix">

                                <ul class="widgets">

                                    <?php

                                    $i=1;

                                    foreach($property_lists as $pl)

                                    {

                                     if($i%4 == 1){ $liclass = 'marginLeft-none clear';} else{ $liclass = '';} 

#                                     if($pl->admin_action == 'verified'){$pink_tick_class = 'pinkTick';}

                                    ?>

                                  <li class="span3 <?php echo @$liclass;?>">

                                    <div class="img"><a href="<?php echo site_url('escapedetails/'.$pl->custom_url);?>"><img src="<?php echo base_url(); ?>images/property_img/featured/thumb/<?php echo $pl->featured_image;?>" alt="<?php echo $pl->title;?>"/></a></div>

                                    <h4><a href="<?php echo site_url('escapedetails/'.$pl->custom_url);?>"><?php echo $pl->title;?></a></a></h4>

                                    <div class="left">

                                      <h5>NZ <?php echo $pl->price_night;?>/night</h5>

                                      <?php

                                        $total_avgt = 0;

                                        foreach($ratings_cat as $rc)

                                        {

                                         $eachcat_avg_rate = $this->listing_model->avgRateByCatID($rc->id, $pl->id);   

                                         $total_avgt +=  $eachcat_avg_rate->avgr;

                                         }

                                        $ovarall_ratingst = ($total_avgt/count($ratings_cat));

                                        $total_reviews = $this->listing_model->geAllReviews($pl->id);

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

                  <div class="clear"></div>

                  </div>

            <div class="pagination"><?php echo $links; ?></div>

                       

        </div>

    </div>

<?php

    }

    else

    {

    ?>

    <h1 class="title"> <img src="<?php echo base_url(); ?>assets/frontend/images/popular-icon.png"  alt="popular icon" /> <strong>Sorry</strong>, but no Escapes are available in <strong><?php echo $suburb_rs->suburb_name;?></strong> during your requested check in/check out dates </h1>

    <?php

    }

?>

  </div>

</section>



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

