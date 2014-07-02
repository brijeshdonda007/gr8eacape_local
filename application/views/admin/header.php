<header class="navbar navbar-fixed-top">
	<script>
	var base_url = '<?php echo base_url(); ?>';	
	</script>
  <div class="pull-left"> <a class="navbar-brand" href="<?php echo base_url();?>admin/dashboard">
    <div class="navbar-logo"><img src="<?php echo base_url(); ?>assets/backend/images/logo_small.png" class="img-responsive" alt="logo"/></div>
    </a> </div>
  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#collapse-1"></button>
  <div class="pull-right header-btns">
    <div class="messages-menu">
      <a href="<?php echo base_url();?>admin/settings" class="btn btn-sm btn-default btn-gradient"><span class="glyphicons glyphicons-settings"></span> <b>Settings</b> </a>
    </div>
    <div class="alerts-menu">
      <a href="<?php echo base_url();?>admin/dashboard" class="btn btn-sm btn-default btn-gradient"><span class="glyphicons glyphicons-dashboard"></span> <b>Dashboard</b> </a>
    </div>
    <div class="tasks-menu">
      <a href="<?php echo base_url();?>admin/dashboard" class="btn btn-sm btn-default btn-gradient"><span class="imoon imoon-notification"></span> <b>Notification</b> </a>
    </div>
    <div class="msg-menu">
      <a href="<?php echo base_url();?>admin/dashboard" class="btn btn-sm btn-default btn-gradient"><span class="glyphicons glyphicons-message_flag"></span> <b>Message</b> </a>
    </div>
    <div class="btn-group user-menu">
      <button type="button" class="btn btn-orange btn-sm" data-toggle="dropdown"> <span class="glyphicons glyphicons-user"></span> <b><?php echo ucfirst($this->session->userdata('admin_first_name')); ?></b> </button>
      <ul class="dropdown-menu checkbox-persist" role="menu">
        <li class="menu-arrow">
          <div class="menu-arrow-up"></div>
        </li>
        <li class="dropdown-header">Your Account <span class="pull-right glyphicons glyphicons-user"></span></li>
        <li>
          <ul class="dropdown-items">
            <li>
              <div class="item-icon"><i class="fa fa-envelope-o"></i> </div>
              <a class="item-message" href="<?php echo base_url();?>admin/dashboard">Messages</a> </li>
            <li class="border-bottom-none">
              <div class="item-icon"><i class="fa fa-cog"></i> </div>
              <a class="item-message" href="<?php echo base_url();?>admin/settings">Settings</a> </li>
            <li class="padding-none">
              <div class="dropdown-signout"><i class="fa fa-sign-out"></i> <a href="<?php echo site_url('admin/logout'); ?>">Logout</a></div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</header>