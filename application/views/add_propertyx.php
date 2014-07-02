<?php $this->load->view('public/header');?>
<body>
	<div class="inner-container">
	<?php $this->load->view('user/user-header');?>
		<section class="mainContent">
			<div class="wrapper clearfix">
				<div class="row-fluid clearfix">
					<div class="span12">
					<?php if($this->session->userdata('msg_upgraded')){ ?>
						<div class="message" >
						<?php echo $this->session->userdata('msg_upgraded');$this->session->unset_userdata(array('msg_upgraded'=>''));?><br />
						</div>
					<?php } ?>
					<?php $this->load->view($add_property); ?>
					</div>
				</div>
			</div>
		</section>
	</div>
	<?php $this->load->view('public/footer'); ?>
</body>
</html>