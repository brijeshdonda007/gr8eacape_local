<?php if($this->session->userdata('user_type') == 2) :
?>
<div class="span3">
	<div class="Block">
		<h1 class="blockHeader"> <img src="<?php echo base_url(); ?>assets/frontend/images/login-icon-small.png" alt="login icon" />My Profile </h1>
		<ul class="leftBlock">
			<li><a href="<?php echo site_url('owner/detail/'.$this->session->userdata('user_id'));?>">View Profile</a></li>
			<li><a href="<?php echo site_url('user/editProfile');?>">Edit Profile</a></li>
			<?php  	if (!@($this->session->userdata('Fb_user'))) : ?>
			<li><a href="<?php echo site_url('user/changePassword');?>">Change Password</a></li>
            <?php endif ?>
		</ul>
	</div>
	<?php if($this->session->userdata('user_type') == 2): ?>

            <div class="Block">
         	 <h1 class="blockHeader"> <img src="<?php echo base_url(); ?>assets/frontend/images/setting.png" alt="login icon" />My Account </h1>

          <ul class="leftBlock">
            <li><a href="<?php echo site_url('user/account/billing'); ?>">Billing Information</a></li>
            <li><a href="<?php echo site_url('user/account/company'); ?>">Company Information</a></li>
            <li><a href="<?php echo site_url('verification'); ?>">Verification</a></li>
          </ul>
        </div>
       <?php endif ?>
	<div class="Block">
		<h1 class="blockHeader"> <img src="<?php echo base_url(); ?>assets/frontend/images/myListing.png" alt="my Listing" />My Escapes </h1>
		<ul class="leftBlock">
			<li><a href="<?php echo site_url('user/escapeList');?>">View Escapes</a></li>
			<li><a href="<?php echo site_url('owner/escape/add');?>">Add A New Escape</a></li>
			<li><a href="#">Active Bookings</a></li>
			<li><a href="<?php echo site_url('user/bookingRequests');?>">Booking Requests</a></li>
		</ul>
	</div>
	<div class="Block">
		<h1 class="blockHeader"> <img src="<?php echo base_url(); ?>assets/frontend/images/myListing.png" alt="my Listing" />Mail</h1>
		<ul class="leftBlock">
			<li><a href="<?php echo site_url('mail/message/inbox') ?>">Inbox</a></li>
            <li><a href="<?php echo site_url('mail/message/outbox') ?>">Outbox</a></li>
			<li><a href="<?php echo site_url('user/notifications') ?>">Notifications </a><?php if($unread_notifications) {?><span class="unreadcount"><?php echo '('.$unread_notifications.')';?></span><?php  }?></li>
		</ul>
	</div>
	<div class="Block">
		<h1 class="blockHeader"> <img src="<?php echo base_url(); ?>assets/frontend/images/mypurchase.png" alt="My Purchases" />My Purchases </h1>
		<ul class="leftBlock">
			<li><a href="<?php echo site_url('user/allrequestBuyer/');?>">My Bookings</a></li>
			<li><a href="#">Just Viewed</a></li>
			<li><a href="#">Watchlist</a></li>
		</ul>
	</div>
    <?php if ($this->session->userdata('user_type') == 2) :?>
	<div class="Block">
		<h1 class="blockHeader"> <img src="<?php echo base_url(); ?>assets/frontend/images/earnings.png" alt="my purchase" />My Earnings</h1>
		<ul class="leftBlock">
			<li><a href="<?php echo site_url('owner/mainEarning');?>">Earnings</a></li>
			<li><a href="<?php echo site_url('user/allTransCurrMnth');?>">View Balance</a></li>
			<li><a href="<?php echo site_url('user/allPendingTransCurrMnth');?>">Pending Balance</a></li>
		</ul>
	</div>
    <?php endif ?>
	<div class="Block">
		<h1 class="blockHeader"> <img src="<?php echo base_url(); ?>assets/frontend/images/setting.png" alt="my purchase" />Settings </h1>
		<ul class="leftBlock">
			<li><a href="<?php echo site_url('contactsupport');?>">Contact Support</a></li>
			<li><a href="<?php echo site_url('user/logout'); ?>">Log Out</a></li>
		</ul>
	</div>
</div>
<?php else: ?>
<div class="span3">
	<div class="Block">
		<h1 class="blockHeader"> <img src="<?php echo base_url(); ?>assets/frontend/images/login-icon-small.png" alt="login icon" />My Profile </h1>
		<ul class="leftBlock">
			<li><a href="<?php echo site_url('buyer/detail/'.$this->session->userdata('user_id'));?>">View Profile</a></li>
			<li><a href="<?php echo site_url('user/editProfile');?>">Edit Profile</a></li>
			<?php 
			if(!@($this->session->userdata('Fb_user')))
			{?>
			<li><a href="<?php echo site_url('user/changePassword');?>">Change Password</a></li>
			<?php }?>
		</ul>
	</div>
	<div class="Block">
		<h1 class="blockHeader"> <img src="<?php echo base_url(); ?>assets/frontend/images/myListing.png" alt="my Listing" />Mail</h1>
		<ul class="leftBlock">
			<li><a href="<?php echo site_url('mail/message/inbox') ?>">Inbox</a></li>
            <li><a href="<?php echo site_url('mail/message/outbox') ?>">Outbox</a></li>
			<li><a href="<?php echo site_url('user/notifications') ?>">Notifications </a><?php if($unread_notifications) {?><span class="unreadcount"><?php echo '('.$unread_notifications.')';?></span><?php  }?></li>
		</ul>
	</div>
	<div class="Block">
		<h1 class="blockHeader"> <img src="<?php echo base_url(); ?>assets/frontend/images/mypurchase.png" alt="my purchase" />My Purchases </h1>
		<ul class="leftBlock">
			<li><a href="<?php echo site_url('user/allrequestBuyer/');?>">My Bookings</a></li>
			<li><a href="#">Just Viewed</a></li>
			<li><a href="#">Watchlist</a></li>
		</ul>
	</div>
</div>
<?php endif ?>
