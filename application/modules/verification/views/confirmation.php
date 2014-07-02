<section id="content">
	<div class="wrapper clearfix">
		<ul class="breadcrumb">
		  <li><a href="<?php echo site_url('home'); ?>"><img src="<?php echo base_url(); ?>assets/frontend/images/home-breadcrumb.png" /></a></li>
		  <li><a href="<?php echo site_url('home'); ?>">Home</a> <span class="divider"><img src="<?php echo base_url(); ?>assets/frontend/images/breadcrumb-divider.png" alt="" /></span></li>
		  <li>Redirection</li>
		</ul>
		<p>
			<img src="<?php echo base_url(); ?>assets/frontend/images/user-icon.png"  alt="popular icon" />

            You are now being transferred to our secure payment gateway. If you are not redirected within 5 seconds <a href="<?php echo base_url() ?>verification/payment/booking_and_pay">click here</a>

		</p>

	</div>
</section>



<script type="text/javascript">

function redirect(){
   window.location = "<?php echo base_url() ?>verification/payment/booking_and_pay";
}
setTimeout(redirect, 5000);

</script>