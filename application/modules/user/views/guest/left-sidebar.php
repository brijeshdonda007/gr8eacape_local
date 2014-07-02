<div class="span3">
	<div class="Block">
		<h1 class="blockHeader"> <img src="<?php echo base_url(); ?>assets/frontend/images/login-icon-small.png" alt="login icon" />My Profile </h1>
		<ul class="leftBlock">
			<li><a href="<?php echo site_url('buyer/detail/'.$this->session->userdata('user_id'));?>">View Profile</a></li>
			<li><a href="<?php echo site_url('guest/editProfile');?>">Edit Profile</a></li>
			<?php if(!@($this->session->userdata('Fb_user'))): ?>
			<li><a href="<?php echo site_url('guest/changePassword');?>">Change Password</a></li>
			<?php endif ?>
		</ul>
	</div>
	<div class="Block">
		<h1 class="blockHeader"> <img src="<?php echo base_url(); ?>assets/frontend/images/myListing.png" alt="my Listing" />Mail</h1>
		<ul class="leftBlock">
			<li><a href="<?php echo site_url('mail/message/inbox') ?>">Inbox</a></li>
            <li><a href="<?php echo site_url('mail/message/outbox') ?>">Outbox</a></li>
			<li><a href="<?php echo site_url('guest/notifications') ?>">Notifications </a><?php if($unread_notifications) {?><span class="unreadcount"><?php echo '('.$unread_notifications.')';?></span><?php  }?></li>
		</ul>
	</div>
	<div class="Block">
		<h1 class="blockHeader"> <img src="<?php echo base_url(); ?>assets/frontend/images/mypurchase.png" alt="my purchase" />My Purchases </h1>
		<ul class="leftBlock">
			<li><a href="<?php echo site_url('guest/allrequestBuyer');?>">My Bookings</a></li>
			<li><a href="#">Just Viewed</a></li>
			<li><a href="#">Watchlist</a></li>
		</ul>
	</div>
</div>

