<?php 
$this->load->view('public/header');
?>
<body>
	<div class="inner-container">
	<?php $this->load->view('user/user-header');?>
		<section class="mainContent">
			<div class="wrapper clearfix">
				<div class="row-fluid clearfix">
					<div class="span12">
					<?php $this->load->view($view); ?>
					</div>
				</div>
			</div>
		</section>
	</div>
	<?php $this->load->view('public/footer'); ?>
</body>
</html>