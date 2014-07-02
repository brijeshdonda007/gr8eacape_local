<aside id="sidebar">
	<div id="sidebar-menu">
		<ul class="nav sidebar-nav">
			<li <?php if($this->uri->segment(2) == 'dashboard'){ echo 'class="active"';} ?>><a href="<?php echo site_url('admin/dashboard'); ?>"><span class="glyphicons glyphicons-dashboard"></span> <span class="sidebar-title">Dashboard</span></a></li>
			<li <?php if(($this->uri->segment(2) == 'admins')){ echo 'class="active"';} ?>><a href="<?php echo site_url('admin/admins/list'); ?>"><span class="glyphicons glyphicons-vcard"></span> <span class="sidebar-title">Administrators</span></a></li>
			<li <?php if(($this->uri->segment(2) == 'users') || ($this->uri->segment(2) == 'groups')){ echo 'class="active"';} ?>><a class="accordion-toggle <?php if(($this->uri->segment(2) == 'users') || ($this->uri->segment(2) == 'groups')){ echo 'menu-open';} ?>" href="#users"><span class="glyphicons glyphicons-user"></span> <span class="sidebar-title">Users</span><span class="caret"></span></a>
				<ul id="users" class="nav sub-nav">
					<li <?php if(($this->uri->segment(2) == 'users')){ echo 'class="active"';} ?>><a href="<?php echo site_url('admin/users/list'); ?>"><span class="glyphicons glyphicons-user"></span> Users</a></li>
					<li <?php if(($this->uri->segment(2) == 'groups')){ echo 'class="active"';} ?>><a href="<?php echo site_url('admin/groups/list'); ?>"><span class="glyphicons glyphicons-group"></span> User Groups</a></li>
				</ul>
			</li>
			<li <?php if($this->uri->segment(2) == 'booking'){ echo 'class="active"';} ?>><a href="<?php echo site_url('admin/booking/list'); ?>"><span class="glyphicons glyphicons-nameplate"></span> <span class="sidebar-title">All Bookings</span></a></li>
			<li <?php if(($this->uri->segment(2) == 'location')){ echo 'class="active"';} ?>><a class="accordion-toggle <?php if(($this->uri->segment(2) == 'location')){ echo 'menu-open';} ?>" href="#location"><span class="glyphicons glyphicons-direction"></span> <span class="sidebar-title">Location</span><span class="caret"></span></a>
				<ul id="location" class="nav sub-nav">
					<li <?php if(($this->uri->segment(3) == 'country')){ echo 'class="active"';} ?>><a href="<?php echo site_url('admin/location/country/list');?>"><span class="glyphicons glyphicons-globe"></span> Country </a></li>
					<li <?php if(($this->uri->segment(3) == 'region')){ echo 'class="active"';} ?>><a href="<?php echo site_url('admin/location/region/list');?>"> <span class="glyphicons glyphicons-globe"></span> Regions/States </a></li>
					<li <?php if(($this->uri->segment(3) == 'city')){ echo 'class="active"';} ?>><a href="<?php echo site_url('admin/location/city/list');?>"> <span class="glyphicons glyphicons-globe"></span> City </a></li> </a></li>
					<li <?php if(($this->uri->segment(3) == 'suburb')){ echo 'class="active"';} ?>><a href="<?php echo site_url('admin/location/suburb/list');?>"> <span class="glyphicons glyphicons-globe"></span> Suburb/Area </a></li> </a></li>
				</ul>
			</li>
                        <li <?php if(($this->uri->segment(2) == 'categories')){ echo 'class="active"';} ?>><a class="accordion-toggle <?php if(($this->uri->segment(2) == 'categories')){ echo 'menu-open';} ?>" href="#category"><span class="glyphicons glyphicons-bullets"></span> <span class="sidebar-title">Category</span><span class="caret"></span></a>
			<!--<li <?php if(($this->uri->segment(2) == 'categories')){ echo 'class="active"';} ?>><a class="accordion-toggle <?php if(($this->uri->segment(2) == 'categories')){ echo 'menu-open';} ?>" href="#category"><span class="glyphicons glyphicons-bullets"></span> <span class="sidebar-title">Category</span><span class="caret"></span></a>
				<ul class="nav sub-nav" id="category">
					<li <?php if(($this->uri->segment(2) == 'categories') && ($this->uri->segment(3) == 'add')){ echo 'class="active"';} ?>><a href="<?php echo site_url('admin/categories/add');?>"><span class="glyphicons glyphicons-circle_plus"></span> Add Category </a></li>
					<li <?php if(($this->uri->segment(2) == 'categories') && ($this->uri->segment(3) == 'list')){ echo 'class="active"';} ?>><a href="<?php echo site_url('admin/categories/list');?>"><span class="glyphicons glyphicons-circle_info"></span> Categories </a></li>
				</ul>
			</li> -->
		<!--	<li <?php if(($this->uri->segment(2) == 'categories') && ($this->uri->segment(3) == 'list')){ echo 'class="active"';} ?>><a href="<?php echo site_url('admin/categories/list');?>"><span class="glyphicons glyphicons-circle_info"></span> Categories </a></li>
			<li><a href="<?php echo site_url('admin/categories/escapes/facilities');?>"><span class="glyphicons glyphicons-circle_info"></span> TEST </a></li> -->
			
			
			<li <?php if(($this->uri->segment(2) == 'escapes') || ($this->uri->segment(2) == 'categories') || ($this->uri->segment(2) == 'verification') ){ echo 'class="active"';} ?>><a class="accordion-toggle <?php if(($this->uri->segment(2) == 'escapes') || ($this->uri->segment(2) == 'categories') || ($this->uri->segment(2) == 'verification')){ echo 'menu-open';} ?>" href="#"><span class="glyphicons glyphicons-bullets"></span> <span class="sidebar-title">Escapes</span><span class="caret"></span></a>
				<ul class="nav sub-nav" id="category">
                                        <li <?php if(($this->uri->segment(2) == 'escapes')){ echo 'class="active"';} ?>><a href="<?php echo site_url('admin/escapes/list'); ?>"><span class="glyphicons glyphicons-list"></span> Listed Escapes </a></li>
                                        <li <?php if(($this->uri->segment(2) == 'categories') && ($this->uri->segment(3) == 'list')){ echo 'class="active"';} ?>><a href="<?php echo site_url('admin/categories/list');?>"><span class="glyphicons glyphicons-circle_info"></span> Categories </a></li>
					<li <?php if(($this->uri->segment(4) == 'facilities')){ echo 'class="active"';} ?>><a href="<?php echo site_url('admin/categories/escapes/facilities'); ?>"><span class="glyphicons glyphicons-circle_info"></span> Facilities </a></li>
					<li <?php if(($this->uri->segment(4) == 'skychannels')){ echo 'class="active"';} ?>><a href="<?php echo site_url('admin/categories/escapes/skychannels'); ?>"><span class="glyphicons glyphicons-circle_info"></span> Sky Channels </a></li>
                    <li <?php if(($this->uri->segment(2) == 'verification')){ echo 'class="active"';} ?>><a href="<?php echo site_url('admin/verification/'); ?>"><span class="glyphicons glyphicons-circle_info"></span> Verification </a></li>
				</ul>
			</li>
			
			<!--<li <?php if(($this->uri->segment(2) == 'skyChannels')){ echo 'class="active"';} ?>><a class="accordion-toggle <?php if(($this->uri->segment(2) == 'skyChannels')){ echo 'menu-open';} ?>" href="#category"><span class="glyphicons glyphicons-bullets"></span> <span class="sidebar-title">SKY Channels</span><span class="caret"></span></a>
				<ul class="nav sub-nav" id="category">
					<li <?php if(($this->uri->segment(2) == 'skyChannels')){ echo 'class="active"';} ?>><a href="<?php echo site_url('admin/skyChannels');?>"><span class="glyphicons glyphicons-circle_info"></span> Channels </a></li>
				</ul>
			</li>
			-->
			
			<li <?php if(($this->uri->segment(2) == 'banners') || ($this->uri->segment(2) == 'escapeImages')){ echo 'class="active"';} ?>><a class="accordion-toggle <?php if(($this->uri->segment(2) == 'banners') || ($this->uri->segment(2) == 'escapeImages')){ echo 'menu-open';} ?>" href="#image_management"><span class="glyphicons glyphicons-picture"></span> <span class="sidebar-title">Image Management</span><span class="caret"></span></a>
				<ul class="nav sub-nav" id="image_management">
					<li <?php if(($this->uri->segment(2) == 'banners')){ echo 'class="active"';} ?>><a href="<?php echo site_url('admin/banners/list'); ?>"><span class="glyphicons glyphicons-picture"></span> Homepage</a></li>
					<li <?php if(($this->uri->segment(2) == 'escapeImages')){ echo 'class="active"';} ?>><a href="<?php echo site_url('admin/escapeImages'); ?>"><span class="glyphicons glyphicons-picture"></span> Escape Images</a></li>
				</ul>
			</li>
			<li <?php if(($this->uri->segment(2) == 'pages')){ echo 'class="active"';} ?>><a href="<?php echo site_url('admin/pages/list'); ?>"><span class="glyphicons glyphicons-book"></span> <span class="sidebar-title">Pages</span></a></li>
			<!--<li <?php //if($this->uri->segment(2) == 'earning'){ echo 'class="active"';} ?>><a href="<?php //echo site_url('admin/earning/list');?>"><span class="glyphicons glyphicons-usd"></span> <span class="sidebar-title">Earning</span></a></li>-->
			<!--<li <?php //if($this->uri->segment(2) == 'chart'){ echo 'class="active"';} ?>><a href="<?php //echo site_url('admin/chart');?>"><span class="glyphicons glyphicons-charts"></span> <span class="sidebar-title">Charts</span></a></li>-->
			<li <?php echo (strpos($this->uri->segment(2),'reports') === false)? '' : 'class="active"'; ?>><a class="accordion-toggle <?php echo (strpos($this->uri->segment(2),'reports') === false)? '' : 'menu-open'; ?>" href="#reports"><span class="glyphicons glyphicons-charts"></span> <span class="sidebar-title">Reports</span><span class="caret"></span></a>
				<ul class="nav sub-nav" id="reports">
					<li <?php if(($this->uri->segment(2) == 'reports_escapes')){ echo 'class="active"';} ?>><a href="<?php echo site_url('admin/reports_escapes');?>"><span class="glyphicons glyphicons-lock"></span> Escapes </a></li>
                    <li <?php if(($this->uri->segment(2) == 'reports_bookings')){ echo 'class="active"';} ?>><a href="<?php echo site_url('admin/reports_bookings');?>"><span class="glyphicons glyphicons-calendar"></span> Bookings </a></li>
                    <li <?php if(($this->uri->segment(2) == 'reports_income')){ echo 'class="active"';} ?>><a href="<?php echo site_url('admin/reports_income');?>"><span class="glyphicons glyphicons-usd"></span> Income </a></li>
				</ul>
			</li>
			<li <?php if($this->uri->segment(2) == 'settings'){ echo 'class="active"';} ?>><a href="<?php echo site_url('admin/settings'); ?>"><span class="glyphicons glyphicons-settings"></span> <span class="sidebar-title">Settings</span></a></li>
			<li <?php if(($this->uri->segment(2) == 'testimonials')){ echo 'class="active"';} ?>><a href="<?php echo site_url('admin/testimonials/list');?>"><span class="glyphicons glyphicons-notes_2"></span> <span class="sidebar-title">Testimonials</span></a></li>
			<li <?php if($this->uri->segment(2) == 'subscribers'){ echo 'class="active"';} ?>><a href="<?php echo site_url('admin/subscribers/list');?>"><img src="<?php echo base_url(); ?>assets/backend/images/icon-subscribers.png" alt="subscribers" /><span class="glyphicons glyphicons-circle_arrow_right"></span> <span class="sidebar-title">Subscribers</span></a></li>
			<li <?php if($this->uri->segment(2) == 'knowledge'){ echo 'class="active"';} ?>><a href="<?php echo site_url('admin/knowledge');?>"><span class="glyphicons glyphicons-pencil"></span> <span class="sidebar-title">Knowledge Base</span></a></li>
                        <li <?php if($this->uri->segment(2) == 'email_template'){ echo 'class="active"';} ?>><a href="<?php echo site_url('admin/email_template/list');?>"><span class="glyphicons glyphicons-list"></span> <span class="sidebar-title">Email Templates</span></a></li>
			<li <?php if($this->uri->segment(2) == 'menu'){ echo 'class="active"';} ?>><a href="<?php echo site_url('admin/menu/section/list');?>"><span class="glyphicons glyphicons-list"></span> <span class="sidebar-title">Menus</span></a></li>
			<li><a href="<?php echo site_url('admin/logout'); ?>"><span class="glyphicons glyphicons-share"></span> <span class="sidebar-title">Logout</span></a></li>
		</ul>
	</div>
</aside>