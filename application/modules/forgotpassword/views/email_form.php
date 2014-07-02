<script type="text/javascript">

$(document).ready(function() {

	$('#email_form').validate({

		rules: {

			

			email: {

				required: true,

				email: true

			}



                        

                        

		},

		messages: {

			

			email: "Please enter a valid email address"

							

		}

	});

        

});



</script>

<section id="content">

<div class="wrapper clearfix">

<ul class="breadcrumb">

  <li><img src="<?php echo base_url();?>assets/frontend/images/home-breadcrumb.png" /></li>

  <li><a href="<?php echo site_url();?>" >Home</a> <span class="divider"><img src="<?php echo base_url();?>assets/frontend/images/breadcrumb-divider.png" alt="" /></span></li>

  <li>Change Password</li>

</ul>

<h2>Change your password</h2>


<div class="row">

 

	<div class="span6">

            <?php if($this->session->userdata('msg')):?>

      <?php // echo $this->session->userdata('msg');$this->session->unset_userdata(array('msg'=>'')); ?>

            <h5><?php echo $this->session->userdata('msg');$this->session->unset_userdata(array('msg'=>'')); ?></h5>

            <?php endif;?> 

    	<form class="form-horizontal" method="post" name="email_form" id="email_form" action="<?php echo site_url('forgotpassword/get_password')?>">

          <div class="control-group">

            <label class="control-label">Email Address</label>

            <div class="controls">

              <input type="text" placeholder="Enter your email address" class="input-large" name="email" value="<?php echo set_value('email'); ?>">

              <?php echo form_error('email'); ?>

            </div>

          </div>

          <div class="control-group">

            <div class="controls">

              <input type="submit" class="btn buttonBlue" value="Change your password">

            </div>

          </div>

        </form>

    </div>

</div>

  </div>

  

</div>

</section>