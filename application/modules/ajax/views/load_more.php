<?php

$per_page = 4;

if(isset($_POST['pageLimit']) && !empty($_POST['pageLimit'])){

    $pageLimit=$_POST['pageLimit'];

}else{

    $pageLimit=4;

}

$pageLimit=$pageLimit;       



if($property_count > 0){

     

               ?>

               <div class="row-fluid clearfix">

                    <ul class="widgets">

                        <?php

                        $i=1;

                        foreach($property_lists as $pl)

                        {

                         if($i%4 == 1){ $liclass = 'marginLeft-none clear';} else{ $liclass = '';} 

#                         if($pl->admin_action == 'verified'){$pink_tick_class = 'pinkTick';}

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

                             $eachcat_avg_rate = $this->ajax_model->avgRateByCatID($rc->id, $pl->id);   

                             $total_avgt +=  $eachcat_avg_rate->avgr;

                             }

                            $ovarall_ratingst = ($total_avgt/count($ratings_cat));

                            $total_reviews = $this->ajax_model->geAllReviews($pl->id);

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

            <?php

            }

            

         $loadCount=$pageLimit+$per_page;

         if($property_count > $loadCount){

             if($loadCount <= 12)

             {

               ?>

<div class="load_more_link">

<button id="loadmorex" class="btn btn-large btn-block buttonGreen" onclick="loadData('<?php echo $loadCount;?>')">Show me more accomodations <span class="flash"></span></button>

</div>

    <?php

         }

 else {

     ?>

<div class="pagination"><?php echo $links; ?></div>

<?php



 }

         }

         

        else{

               $HTML='No Data Found';

        }

        



?>



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
