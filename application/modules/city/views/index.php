<section class="content">

  <div class="wrapper clearfix">

<!-- POPULAR ACCOMODATION RESTING LISTS-->
    <h1 class="title"> <img src="<?php echo base_url(); ?>assets/frontend/images/popular-icon.png"  alt="popular icon" /> Listing <?php echo count($suburb_lists);?> <strong> Suburbs</strong> under <?php echo $city_name->city_name;?> <?php echo $city_name->region_name; ?> </h1>

    <div id="wrapper">

        <div id="pageData">

      

                           <div class="row-fluid clearfix">

                                <ul class="widgets suburb-list">

                                    <?php

                                    $i=1;

                                    foreach($suburb_lists as $rr)

                                    {

                                     if($i%4 == 1){ $liclass = 'marginLeft-none clear';} else{ $liclass = '';} 

                                    ?>

                                  <li class="span3 <?php echo @$liclass;?>">

                                      <?php if($rr->featured_image)

                                      {

                                       $photo = base_url().'images/suburb/thumb/'.$rr->featured_image;

                                         

                                      }

                                      else

                                      {

                                       $photo = base_url().'assets/frontend/images/no-image-location.png';   

                                      }

                                     ?>

                                    <div class="img"><a href="<?php echo site_url('listing/index/'.$rr->id);?>"><img src="<?php echo $photo;?>" alt="<?php echo $rr->suburb_name;?>" title="<?php echo $rr->suburb_name;?>"/></a></div>

                                    <div class="title"><a href="<?php echo site_url('listing/index/'.$rr->id);?>"><?php echo $rr->suburb_name;?></a></div>

                                      </li>

                                  <?php

                                    $i++;}

                                  ?>

                                </ul>

                  <div class="clear"></div>

                  </div>

                       

           

        </div>

    </div>

  </div>

</section>



