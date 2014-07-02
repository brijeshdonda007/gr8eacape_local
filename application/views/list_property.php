<?php $this->load->view('public/header');?>
<body>
    <div class="inner-container">
      <?php $this->load->view('user/user-header');?>  
<section class="mainContent">
    <div class="wrapper clearfix">
        <div class="row-fluid clearfix">
            <?php $this->load->view('user/user-left-sidebar'); ?>
            <div class="span9">
                <?php
                if($this->session->userdata('msg'))
                {
                ?>
                <div class="message" ><?php echo $this->session->userdata('msg');$this->session->unset_userdata(array('msg'=>''));?><br /></div>
                <?php
                }
                ?>
                <?php $this->load->view($list_property_view); ?>
            </div>
        </div>
    </div>
</section>
    </div>
	<?php $this->load->view('public/footer'); ?>
</body>
</html>