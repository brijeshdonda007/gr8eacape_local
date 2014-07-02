<div class="userBanner">
    <div class="wrapper clearfix">
        <div class="pull-left span4">
            <?php

            if($this->session->userdata('Fb_user') && empty($user_profile_info->profile_picture)) {?>
                <img src="https://graph.facebook.com/<?php echo $fb_arr['id'] ;?>/picture" width="100" height="84" class="img-polaroid pull-left" alt="user dashboard imgae" />
            <?php } else {

                if(!empty($user_profile_info->profile_picture)){ ?>
                    <img src="<?php echo base_url();?>images/profile_img/medium/<?php echo $user_profile_info->profile_picture;?>" width="100" height="84" class="img-polaroid pull-left" alt="user dashboard imgae" />
                <?php } else{ ?>
                    <img src="<?php echo base_url();?>assets/frontend/images/no-image.png" width="100" height="84" class="img-polaroid pull-left" alt="user dashboard imgae" />
                <?php }
            }?>
            <div class="profileName"> <span>Welcome</span><br />
                <?php echo $user_profile_info->first_name.' '.$user_profile_info->last_name; ?>
                <br />
                <a href="<?php echo site_url('user/editProfile');?>">Edit My Profile</a> </div>
            </div>

        <div class="pull-right userNav">
            <ul>

                <li><a href="<?php echo ($user_profile_info->user_type == 2) ? site_url('owner') : site_url('user'); ?>"><img src="<?php echo base_url(); ?>assets/frontend/images/dashboard.jpg" alt="dashboard" /> My Dashboard</a></li>
                <li><a href="<?php echo site_url('mail/message/inbox') ?>"><img src="<?php echo base_url(); ?>assets/frontend/images/inbox.jpg" alt="inbox" /> inbox </a>

                    <div class="inboxNotificationwrapper">
                        <?php if((count(@$inbox_unread_items) != '') || (count(@$inbox_unread_items) != 0)): ?>
                            <p class="inboxNotification"><?php echo count(@$inbox_unread_items); ?></p>
                        <?php endif ?>
                    </div>
                </li>
                <?php
                if(@$this->earnings->grand_total) {
                    $earning_header = $this->earnings->grand_total;
                    $deductby = (10/100) * $earning_header;
                    $eactual_earns_header = $earning_header - $deductby; ?>
                    <li><a href="<?php echo site_url('user/allTransCurrMnth');?>"><img src="<?php echo base_url(); ?>assets/frontend/images/earning.jpg" alt="earning" /> EarNing: <span>$ <?php echo $eactual_earns_header; ?> NZ</span></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>