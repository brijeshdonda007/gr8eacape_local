<?php echo $this->load->view('buyer/buyer_heading');?>



<section class="mainContent">

  <div class="wrapper clearfix">

    <div class="row-fluid clearfix"> 

      <!-- LEFT SIDE STARTS-->

      <?php $this->load->view('buyer/buyer_left_menu');?>

      

      <!-- RIGHT SIDE STARTS-->

      <?php

                if($this->session->userdata('msg'))

                {

                ?>

      <div class="span9">    

                <div class="message" ><?php echo $this->session->userdata('msg');$this->session->unset_userdata(array('msg'=>''));?><br /></div>

      </div>

                    <?php



                }

                ?>

      <?php echo $this->load->view('buyer/about_buyer');?>

      <?php echo $this->load->view('buyer/ratings_reviews');?>

    </div>

  </div>

</section>