<section id="content">

<div class="wrapper clearfix">

<ul class="breadcrumb">

  <li><img src="<?php echo base_url();?>assets/frontend/images/home-breadcrumb.png" /></li>

  <li><a href="<?php echo site_url();?>" >Home</a> <span class="divider"><img src="<?php echo base_url();?>assets/frontend/images/breadcrumb-divider.png" alt="" /></span></li>

  <li><a href="#" class="active">Change Password</a> <span class="divider"><img src="<?php echo base_url();?>assets/frontend/images/breadcrumb-divider.png" alt="" /></span></li>

</ul>

<h2>

  <img src="<?php echo base_url();?>assets/frontend/images/user-icon.png"  alt="popular icon" />

  Change Password

  </h2>

<div class="row">

	<div class="span6">

            <?php if($this->session->userdata('msg')):?>

            <?php echo $this->session->userdata('msg');$this->session->unset_userdata(array('msg'=>'')); ?>

            <h5><?php echo $this->session->userdata('msg');$this->session->unset_userdata(array('msg'=>'')); ?></h5>

            <?php endif;?>

            <form class="form-horizontal" name="change_password" id="change_password" method="post" action="<?php echo site_url('/forgotpassword/change_process/'.$email)?>">

          

          <div class="control-group">

            <label class="control-label"> New password<span>*</span></label>

            <div class="controls">

              <input type="password" placeholder="Enter password" class="input-xlarge" name="password" id="password">

               <?php echo form_error('password'); ?>

            </div>

          </div>

          <div class="control-group">

            <label class="control-label">Confirm password<span>*</span></label>

            <div class="controls">

              <input type="password" placeholder="Confirm password" class="input-xlarge" name="confirmation">

            </div>

          </div>

          <input type="submit" class="btn buttonRed" value="Change your password">

        </form>

        

        <form class="form-horizontal login-signup">

        	<div class="control-group">

            	<div class="controls">

                	

                </div>

            </div>

        </form>

    </div>

</div>

  </div>

  

</div>

</section>

<script type="text/javascript">

$(document).ready(function() {

    $.validator.addMethod('alphanumeric', function(value, element) {

            return this.optional(element) || (value.match(/[a-zA-Z]/) && value.match(/[0-9]/));

        },

        'Password must contain at least one numeric and one alphabetic character.');

	$('#change_password').validate({

		rules: {

			

			password: {

				required: true,

				minlength: 6,

                                alphanumeric: true

			},

			confirmation: {

				required: true,

				minlength: 6,

				equalTo: "#password"

			}

			

                        

                        

		},

		messages: {

			

			password: {

				required: "Please enter a password",

				minlength: "Your password must be at least 6 characters long"

			},

			confirmation: {

				required: "Please enter a password confirmation",

				minlength: "Your password must be at least 6 characters long",

				equalTo: "Sorry your passwords do not match try again!"

			}

							

		}

	});

});

</script>