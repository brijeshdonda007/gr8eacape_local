<div class="userBanner">

  <div class="wrapper clearfix">

    <div class="pull-left span4"> 

        <?php

        if(!empty($user_profile_info->profile_picture))

        {

        ?>

        <img src="<?php echo base_url();?>images/profile_img/thumb/<?php echo $user_profile_info->profile_picture;?>" width="100" height="84" class="img-polaroid pull-left" alt="user dashboard imgae" />

      <?php

        }

        else

        {

        ?>

        <img src="<?php echo base_url();?>assets/frontend/images/no-image.jpg" width="100" height="84" class="img-polaroid pull-left" alt="user dashboard imgae" />

        <?php

        }

        ?>

        <div class="profileName"> <span>Welcome</span><br />

        <?php echo $user_profile_info->first_name;?><br />

        <a href="<?php echo site_url('user/editProfile');?>">Edit My Profile</a> </div>

    </div>

    <div class="pull-right userNav">

      <ul>

        <li><a href="#"><img src="<?php echo base_url(); ?>assets/frontend/images/dashboard.jpg" alt="dashboard" /> Dashboard</a></li>

        <li><a href="#"><img src="<?php echo base_url(); ?>assets/frontend/images/myaccount.jpg" alt="my account" /> My account</a></li>

        <li><a href="#"><img src="<?php echo base_url(); ?>assets/frontend/images/inbox.jpg" alt="inbox" /> inbox </a>

          <div class="inboxNotificationwrapper">

            <p class="inboxNotification">12</p>

          </div>

        </li>

        <!-- <li><a href="#"><img src="<?php echo base_url(); ?>assets/frontend/images/earning.jpg" alt="earning" /> EarNing: <span>$200</span></a></li> -->

      </ul>

    </div>

  </div>

</div>