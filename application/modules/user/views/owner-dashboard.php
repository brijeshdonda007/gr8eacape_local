<?php $this->load->view('user/owner-header'); ?>
<section class="mainContent">
    <div class="wrapper clearfix">
        <div class="row-fluid clearfix">
            <?php $this->load->view('user/owner-left-sidebar'); ?>
            
            <div class="span9">
                <?php $this->load->view($dashboard_content); ?>
            </div>
        </div>
    </div>
</section>