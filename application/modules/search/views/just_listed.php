<div class="Block">

          <h1 class="blockHeader"><img src="<?php echo base_url(); ?>assets/frontend/images/icon-new.png" alt="gr8 escape Property list" />Just Listed </h1>

          

          <div class="event-new-listing">

        <ul>

            <?php

            foreach($just_listed_property as $jst)

            {

            

            ?>

            <li>

              <div><a href="<?php echo site_url('escapedetails/'.$jst->custom_url);?>"><img src="<?php echo base_url(); ?>images/property_img/featured/thumb/<?php echo $jst->featured_image;?>" alt="<?php echo $jst->title;?>"/></a></div>

              <h4><a href="<?php echo site_url('escapedetails/'.$jst->custom_url);?>"><?php echo $jst->title;?></a></h4>

              <div class="left">

                <h5>NZ <?php echo $jst->price_night;?>/night</h5>

              </div>

            </li>

            <?php

            }

            

            ?>

            

      </ul>

        </div>

          </div>