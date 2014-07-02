<section class="content">

  <div class="wrapper clearfix">

<!-- POPULAR ACCOMODATION RESTING LISTS-->

<?php
if($region_lists > 0)

{

?>

    <h1 class="title"> <img src="<?php echo base_url(); ?>assets/frontend/images/popular-icon.png"  alt="popular icon" /> Listing <?php echo $region_lists;?> <strong> Region</strong> under <?php echo $country_rs->country_name;?> </h1>

    <?php

}

else

{

    ?>

    <h1 class="title"> <img src="<?php echo base_url(); ?>assets/frontend/images/popular-icon.png"  alt="popular icon" /> No <strong>Region</strong> under <?php echo $country_rs->country_name;?> </h1>

    <?php

}

    ?>

    <?php

    if($region_lists > 0)

    {

    ?>

    <div id="wrapper">

        <div id="pageData">

      

                           <div class="row-fluid clearfix">

                                <ul class="widgets region-list">

                                    <?php

                                    $i=1;

                                    foreach($region_list as $rr)

                                    {

                                     if($i%4 == 1){ $liclass = 'marginLeft-none clear';} else{ $liclass = '';} 

                                    ?>

                                  <li class="span3 <?php echo @$liclass;?>">

                                      <?php if($rr->featured_image)

                                      {

                                       $photo = base_url().'images/region/thumb/'.$rr->featured_image;

                                         

                                      }

                                      else

                                      {

                                       $photo = base_url().'assets/frontend/images/no-image-location.png';   

                                      }

                                     ?>

                                    <div class="img"><a href="<?php echo site_url('city/index/'.$rr->id);?>"><img src="<?php echo $photo;?>" alt="<?php echo $rr->region_name;?>"/></a></div>

                                    <div class="title"><a href="<?php echo site_url('city/index/'.$rr->id);?>"><?php echo $rr->region_name;?></a></div>

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

    ?>

  </div>

</section>



