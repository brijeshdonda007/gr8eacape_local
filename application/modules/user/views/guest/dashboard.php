<?php $this->load->view('user/guest/header'); ?>
<section class="mainContent">
    <div class="wrapper clearfix">
        <div class="row-fluid clearfix">
            <?php $this->load->view($left_sidebar); ?>
            
            <div class="span9">
                <?php if($this->session->userdata('msg')): ?>
                <div class="message" >
                    <?php echo $this->session->userdata('msg');
                          $this->session->unset_userdata(array('msg'=>''));?>
                    <br />
                </div>
                <?php endif ?>
                <?php if($this->session->flashdata('success_msg')): ?>
                    <div class="message" >
                    <?php echo $this->session->flashdata('success_msg') ?><br />
                </div>
                <?php endif ?>
                <?php $this->load->view($dashboard_content); ?>
            </div>
        </div>
    </div>
</section>