<div class="userBanner">

<div class="wrapper clearfix">

<div class="pull-left span6">

        <div class="userprofileName"> <span><?php if($this->uri->segment(3) == @$this->session->userdata('user_id')) { ?>Welcome<?php }?></span><br />

        <?php echo $owner_detail->first_name . ' ' . $owner_detail->last_name;?><br />

        <a href="#">Member Since: <?php echo date('d/m/Y', strtotime($owner_detail->user_created_date));?></a> </div>

</div>

</div>

</div>