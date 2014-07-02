

<div id="one" style="display: block;">

        Two

    <form class="form-horizontal" id="register_frm" method="post" action="<?php echo site_url('register/newMember');?>" enctype="multipart/form-data" >

<div class="row">

	<div class="span6">

            

          <div class="control-group">

            <label class="control-label">Full Name<span>*</span></label>

            <div class="controls">

              <input type="text" placeholder="Enter your full name" class="input-xlarge" name="full_name" value="<?php echo set_value('full_name'); ?>">

            </div>

          </div>

          <div class="control-group">

            <label class="control-label">Email Address<span>*</span></label>

            <div class="controls">

              <input type="text" placeholder="Enter your email address" class="input-xlarge" name="email" value="<?php echo set_value('email'); ?>">

              <?php echo form_error('email'); ?>

            </div>

          </div>

            <div class="control-group">

            <label class="control-label">User Name<span>*</span></label>

            <div class="controls">

              <input type="text" placeholder="Enter your user name" class="input-xlarge" name="username" value="<?php echo set_value('username'); ?>">

              

              <?php echo form_error('username'); ?>

            </div>

          </div>

          <div class="control-group">

            <label class="control-label"> Choose a password<span>*</span></label>

            <div class="controls">

              <input type="password" placeholder="Enter password" class="input-xlarge" name="password" id="password">

               <?php echo form_error('password'); ?>

            </div>

          </div>

          <div class="control-group">

            <label class="control-label">Confirm Password<span>*</span></label>

            <div class="controls">

              <input type="password" placeholder="Confirm password" class="input-xlarge" name="confirmation">

            </div>

          </div>

          <div class="control-group">

            <label class="control-label">Contact Phone<span>*</span></label>

            <div class="controls">

              <input type="text" placeholder="Enter your phone number" class="input-xlarge" name="phone" value="<?php echo set_value('phone'); ?>">

            </div>

          </div>

          <div class="control-group">

            <label class="control-label">Mobile Phone</label>

            <div class="controls">

              <input type="text" placeholder="Enter your mobile number" class="input-xlarge" name="mobile" value="<?php echo set_value('mobile'); ?>">

            </div>

          </div>

          <div class="control-group">

            <label class="control-label">Date of Birth<span>*</span></label>

            <div class="controls">

                

            	<select placeholder="Date of Birth" class="input-small" name="year">

                    <option value="">Year</option>

                    <?php for($year = 1960; $year <=(date('Y')-18); $year++)

                    {

                    ?>

                    <option value="<?php echo $year; ?>"><?php echo $year; ?></option>

                    <?php }?>

                </select>

                <select placeholder="Date of Birth" class="input-small" name="month">

                    <option value="">Month</option>

                    <?php

                    for($month = 1; $month<=12; $month++)

                    {

                    ?>

                    <option value="<?php echo $month;?>"><?php echo $month;?></option>

                    <?php }?>

                  

                </select>

                <select placeholder="Date of Birth" class="input-small" name="day">

                    <option value="">Day</option>

                   <?php

                    for($day = 1; $day<=31; $day++)

                    {

                    ?>

                    <option value="<?php echo $day;?>"><?php echo $day;?></option>

                    <?php }?>

                </select>

            </div>

          </div>

    </div>

    <div class="span6">

          <div class="control-group">

            <label class="control-label">Gender<span>*</span></label>

            <div class="controls">

              <input type="radio" name="gender" value="1" class="input-xlarge" checked> Male

              <input type="radio" name="gender" value="0" class="input-xlarge"> Female

            </div>

          </div>

          <div class="control-group">

            <label class="control-label realupload">Profile Image</label>

            <div class="controls">

              <input type="file" placeholder="Select your image" class="input-large" name="profile_img">

            </div>

          </div>

          <div class="control-group">

            <label class="control-label">Address<span>*</span></label>

            <div class="controls">

              <textarea rows="6" class="input-xlarge" name="address"><?php echo set_value('address'); ?></textarea>

            </div>

          </div>

          <div class="control-group">

            <label class="control-label">City/Town/District</label>

            <div class="controls">

              <input type="text" placeholder="" class="input-xlarge" name="city" value="<?php echo set_value('city'); ?>">

            </div>

          </div>

          <div class="control-group">

            <label class="control-label">Country<span>*</span></label>

            <div class="controls">

              <select class="input-medium" id="country_id" name="country_id">

              	<option value="1">Australia</option>

                <option value="2">New Zealand</option>

                <option value="3">Pacific Island</option>

              </select>

            </div>

          </div>

          <div class="control-group">

            <label class="control-label">Postcode</label>

            <div class="controls">

              <input type="text" placeholder="Enter postcode" class="input-medium" name="post_code" value="<?php echo set_value('post_code'); ?>">

              

            </div>

          </div>

    </div>

    </div>

        <div class="span12">

    	<div class="control-group">

            <div class="controls">

              <input type="submit" class="btn buttonBlue" id="mybutton">Submit Message</button>

            </div>

          </div>

    </div>



        </form>

        </div>

<script type="text/javascript">

$(document).ready(function() {

	$('#register_frm').validate({

		rules: {

			full_name:"required", 

                        phone:'required',

			mobile:'required',

                        dob: "required",

			address:"required",

                        post_code:"required",

                        city:"required",

                        year:"required",

                        month:"required",

                        day:"required",

                        username: {

				required: true,

				minlength: 6

			},

			password: {

				required: true,

				minlength: 6

			},

			confirmation: {

				required: true,

				minlength: 6,

				equalTo: "#password"

			},

			email: {

				required: true,

				email: true

			}



                        

                        

		},

		messages: {

			full_name: "Please enter your full name",

                        phone: "Please enter your phone",

                        mobile: "Please enter your mobile",

//                        state: "Please enter your state",

                        address: "Please enter your address",

                        country_id: "Please select country",

                        post_code: "Please enter your postcode",

                        city: "Please enter your city",

                        year: "Please select year",

                        month: "Please select month",

                        day: "Please select day",

                        username: {

				required: "Please enter a username",

				minlength: "Your username must be at least 6 characters long"

			},

			password: {

				required: "Please enter a password",

				minlength: "Your password must be at least 6 characters long"

			},

			confirmation: {

				required: "Please enter a confirm password",

				minlength: "Your password must be at least 6 characters long",

				equalTo: "Please enter the same password as above"

			},

			email: "Please enter a valid email address"

							

		}

	});

        

});



</script>  