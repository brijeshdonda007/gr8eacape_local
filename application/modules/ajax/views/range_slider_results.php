    <?php

    if(count($search_results) > 0)

    {

    ?>

    <div class="count_results"><?php echo count($search_results).' accomadtions found.';?></div>

    	<ul class="widgets">

            <?php 

            

            $i=1;

            foreach($search_results as $pl)

            {

           if($i%3 == 1){ $liclass = 'marginLeft-none';} else{ $liclass = '';} 

#           if($pl->pink_tick == '1'){$pink_tick_class = 'pinkTick';}

                $owner_rs = $this->ajax_model->getOwnerByID($pl->owner_id);

            ?>

        <li class="span4  <?php echo @$liclass;?>">

          <div class="img"><a href="<?php echo site_url('escapedetails/'.$pl->custom_url);?>"><img src="<?php echo base_url(); ?>images/property_img/featured/thumb/<?php echo $pl->featured_image;?>" alt="<?php echo $pl->title;?>"/></a></div>

          <h4><a href="<?php echo site_url('escapedetails/'.$pl->custom_url);?>"><?php echo $pl->title;?></a></a></h4>

          <div class="left">

            <h5>NZ <?php echo $pl->price_night;?>/night</h5>

            <img src="<?php echo base_url(); ?>assets/frontend/images/rating-star.png" alt="rating star" />

            <div>(3 Guest Reviews)</div>

          </div>

          <div class="owner"> <a href="#"><img src="<?php echo base_url(); ?>images/profile_img/thumb/<?php echo $owner_rs->profile_picture;?>" alt="profile" /> <?php echo $owner_rs->first_name;?> </a> </div>

          <?php if($pl->pink_tick == '1'){?>

          <!--<div class="<?php echo @$pink_tick_class;?>"><img src="<?php echo base_url(); ?>assets/frontend/images/pinkTick.png" alt="pink tick" /></div>-->

          <?php } ?>

            </li>

        <?php $i++; }?>

        

        </ul>

    <?php

    

    }

    else

    {

    ?>

    No Results found!

    <?php

    }

    ?>

