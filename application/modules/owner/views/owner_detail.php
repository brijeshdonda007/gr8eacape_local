<?php echo $this->load->view('owner/owner_heading');?>



<section class="mainContent">

  <div class="wrapper clearfix">

    <div class="row-fluid clearfix"> 

      <!-- LEFT SIDE STARTS-->

      <?php echo $this->load->view('owner/owner_left_menu');?>

      

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

      <?php echo $this->load->view('owner/about_owner');?>

      <?php

      if($owner_detail->user_type == 2)

      {

      ?>

      <div class="span9">
  
          <h1 class="profileTitle">My Escapes</h1>

              <?php echo $this->load->view('owner/owner_listing');?>

      </div>

      <?php

      }

      ?>

    </div>

  </div>

</section>