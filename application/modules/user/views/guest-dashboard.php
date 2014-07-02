<?php $this->load->view('user/guest-header'); ?>

<section class="mainContent">

    <div class="wrapper clearfix">

        <div class="row-fluid clearfix">

            <?php $this->load->view('user/guest-left-sidebar'); ?>

            

            <div class="span9">

                <?php $this->load->view($dashboard_content); ?>

            </div>

        </div>

    </div>

</section>