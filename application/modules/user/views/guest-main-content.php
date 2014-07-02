

        <h4 class="marginNone">My Profile Details</h4>

        <div class="triangleArrow top"></div>

        <div class="Block clearfix">

          <div class="row-fluid clearfix">

            <div class="span10">

              <h4><?php echo $user_profile_info->first_name.' '.$user_profile_info->last_name;?></h4>

              <p class="span4 marginNone mediumParagraph"> <strong class="mediumStrong">Mailing Address:</strong> <br />

                Street Number: <?php echo $user_profile_info->street_no;?><br />

                Street Name: <?php echo $user_profile_info->street_name;?><br />

                Avenue: <?php echo $user_profile_info->avenue;?><br/>

                Suburb: <?php echo $user_profile_info->suburb;?><br/>

                City: <?php if($user_profile_info->user_type==1){?><?php echo $user_profile_info->city;?><?php } else { ?><?php echo $city->city_name;?><?php }?><br/>

                Country Name: <?php if($user_profile_info->user_type==1){?><?php echo $user_profile_info->country_title;} else {?><?php echo $country->country_name;?><?php }?><br/>

                Post Code: <?php echo $user_profile_info->post_code;?><br/>

                Phone: <?php echo $user_profile_info->phone;?><br/>

                Mobile: <?php echo $user_profile_info->mobile;?><br/>

              </p>

              

            </div>

            <div class="span2 marginNone"> 

                <?php

                if(!empty($user_profile_info->profile_picture))

                {

                ?>

                <img src="<?php echo base_url();?>images/profile_img/thumb/<?php echo $user_profile_info->profile_picture;?>" class="img-polaroid pull-left" alt="user dashboard imgae" /> 

                <?php

                }

                else

                {

                ?>

                <img src="<?php echo base_url();?>assets/frontend/images/no-image.jpg" class="img-polaroid pull-left" alt="user dashboard imgae" /> 

                <?php

                }

                ?>

                <img src="<?php echo base_url();?>assets/frontend/images/rating-star.png" alt="rating star"  />

              <div class="clear"></div>

              <small>(3 Guest Reviews)</small> <a href="<?php echo site_url('user/editProfile');?>"><strong>EDIT PROFILE</strong></a> </div>

            <div class="clear"></div>

            <p> <strong class="mediumStrong">About Myself</strong><br />

              <?php echo @$user_profile_info->about_yourself;?> </p>

          </div>

        </div>

        <div class="Block clearfix"> <a href="#" class="pull-right"><strong>VIEW ALL</strong></a>

          <h4>My Purchase</h4>

          <table class="table table-striped">

            <thead>

              <tr>

                <th>Purchase Code</th>

                <th>Item Purchased</th>

                <th>Starting Date</th>

                <th>Amount</th>

                <th>Action</th>

              </tr>

            </thead>

            <tbody>

              <tr>

                <td>12ACG%3</td>

                <td>Bach in Auckland for 2 nights</td>

                <td>05-04-2013 </td>

                <td><strong>NZ 2000</strong></td>

                <td><div class="hyperlink"><img src="<?php echo base_url(); ?>assets/frontend/images/cross.png" alt="cross" class="pull-left" /> <a href="#">Cancel Booking</a></div>

                  <div class="hyperlink"> <img src="<?php echo base_url(); ?>assets/frontend/images/email.png" alt="cross" class="pull-left" /> <a href="#">Contact Owner</a> </div></td>

              </tr>

              <tr>

                <td>12ACG%3</td>

                <td>Bach in Auckland for 2 nights</td>

                <td>05-04-2013 </td>

                <td><strong>NZ 2000</strong></td>

                <td><div class="hyperlink"><img src="<?php echo base_url(); ?>assets/frontend/images/cross.png" alt="cross" class="pull-left" /> <a href="#">Cancel Booking</a></div>

                  <div class="hyperlink"> <img src="<?php echo base_url(); ?>assets/frontend/images/email.png" alt="cross" class="pull-left" /> <a href="#">Contact Owner</a> </div></td>

              </tr>

              <tr>

                <td>12ACG%3</td>

                <td>Bach in Auckland for 2 nights</td>

                <td>05-04-2013 </td>

                <td><strong>NZ 2000</strong></td>

                <td><div class="hyperlink"><img src="<?php echo base_url(); ?>assets/frontend/images/cross.png" alt="cross" class="pull-left" /> <a href="#">Cancel Booking</a></div>

                  <div class="hyperlink"> <img src="<?php echo base_url(); ?>assets/frontend/images/email.png" alt="cross" class="pull-left" /> <a href="#">Contact Owner</a> </div></td>

              </tr>

              <tr>

                <td>12ACG%3</td>

                <td>Bach in Auckland for 2 nights</td>

                <td>05-04-2013 </td>

                <td><strong>NZ 2000</strong></td>

                <td><div class="hyperlink"><img src="<?php echo base_url(); ?>assets/frontend/images/cross.png" alt="cross" class="pull-left" /> <a href="#">Cancel Booking</a></div>

                  <div class="hyperlink"> <img src="<?php echo base_url(); ?>assets/frontend/images/email.png" alt="cross" class="pull-left" /> <a href="#">Contact Owner</a> </div></td>

              </tr>

              <tr>

                <td>12ACG%3</td>

                <td>Bach in Auckland for 2 nights</td>

                <td>05-04-2013 </td>

                <td><strong>NZ 2000</strong></td>

                <td><div class="hyperlink"><img src="<?php echo base_url(); ?>assets/frontend/images/cross.png" alt="cross" class="pull-left" /> <a href="#">Cancel Booking</a></div>

                  <div class="hyperlink"> <img src="<?php echo base_url(); ?>assets/frontend/images/email.png" alt="cross" class="pull-left" /> <a href="#">Contact Owner</a> </div></td>

              </tr>

              <tr>

                <td>12ACG%3</td>

                <td>Bach in Auckland for 2 nights</td>

                <td>05-04-2013 </td>

                <td><strong>NZ 2000</strong></td>

                <td><div class="hyperlink"><img src="<?php echo base_url(); ?>assets/frontend/images/cross.png" alt="cross" class="pull-left" /> <a href="#">Cancel Booking</a></div>

                  <div class="hyperlink"> <img src="<?php echo base_url(); ?>assets/frontend/images/email.png" alt="cross" class="pull-left" /> <a href="#">Contact Owner</a> </div></td>

              </tr>

            </tbody>

          </table>

        </div>