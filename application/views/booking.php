<?php $this->load->view('public/header');?>
<body onload="initialize()">
    <div class="inner-container">
    <?php $this->load->view($main_client_view); ?>
    </div>
	<?php $this->load->view('public/footer'); ?>
</body>
</html>