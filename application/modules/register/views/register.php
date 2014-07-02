<section id="content">
<div class="wrapper clearfix signup">

<ul class="breadcrumb">

  <li><a href="<?php echo site_url();?>"><img src="<?php echo base_url();?>assets/frontend/images/home-breadcrumb.png" /></a></li>

  <li><a href="<?php echo site_url();?>" >Home</a> <span class="divider"><img src="<?php echo base_url();?>assets/frontend/images/breadcrumb-divider.png" alt="" /></span></li>

  <li>Sign up</li>

</ul>

<h2>

  <img src="<?php echo base_url();?>assets/frontend/images/signup-icon.png" alt="gr8 escapes signup" />

  Create an account

  </h2>
    <div class="row-fluid" style="width:40%;float:left;padding-left:7%;">
		<div class="form-horizontal">
			<div class="control-group">
				<div class="controls">
	              <input type="radio" name="user_type" value="1" class="input-xlarge" checked id="personal" onchange="onchange_handler(this, 'personal');" onmouseup="onchange_handler(this, 'personal');" <?php if((@$user_type == '1') or !isset($user_type)){ echo 'checked';}?>> Looking to Escape?
	              &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="user_type" value="2" class="input-xlarge" id="corporate" onchange="onchange_handler(this, 'corporate');" onmouseup="onchange_handler(this, 'corporate');" <?php if(@$user_type == '2') {  echo 'checked';}?>> List an Escape!
				</div>
			</div>
        </div>
        <div id="personal_form_fields" <?php if((@$user_type == '1') or !isset($user_type)) {?>style="display: block;"<?php } else {?>style="display: none;"<?php }?>>
        <form class="form-horizontal" id="register_frm1" method="post" action="<?php echo site_url('register/newMember');?>" enctype="multipart/form-data" >
			<div class="row-fluid">
				<div class="span12">
					<div class="control-group">
						<label class="control-label">First Name<span class="important">*</span></label>
						<div class="controls">
							<input type="text" class="input-xlarge" name="first_name" value="<?php echo set_value('first_name'); ?>">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Last Name<span class="important">*</span></label>
						<div class="controls">
							<input type="text"  class="input-xlarge" name="last_name" value="<?php echo set_value('last_name'); ?>">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Email Address<span class="important">*</span></label>
						<div class="controls">
							<input type="text"  class="input-xlarge" name="email" value="<?php echo set_value('email'); ?>">
							<?php echo form_error('email'); ?>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Username<span class="important">*</span></label>
						<div class="controls">
							<input type="text"  class="input-xlarge" name="username" value="<?php echo set_value('username'); ?>">
							<br/><span class="form_fields_note">Ex. ready2escape</span>
							<?php echo form_error('username'); ?>
						</div>
					</div>
          			<div class="control-group">
            			<label class="control-label"> Choose a password<span class="important">*</span></label>
            			<div class="controls">
							<input type="password"  class="input-xlarge" name="password" id="password">
              				<br/><span class="form_fields_note">Ex. luckyme2013</span>
							<?php echo form_error('password'); ?>
						</div>
          			</div>
          			<div class="control-group">
            			<label class="control-label">Confirm Password<span class="important">*</span></label>
						<div class="controls">
              				<input type="password"  class="input-xlarge" name="confirmation">
            			</div>
          			</div>
          			<div class="control-group" rel="owner_fields">
            			<label class="control-label">Contact Phone<span class="important">*</span></label>
			            <div class="controls">
              				<input type="text"  class="input-xlarge" name="phone" value="<?php echo set_value('phone'); ?>">
			            </div>
          			</div>
          			<div class="control-group" rel="owner_fields">
            			<label class="control-label">Mobile Phone</label>
            			<div class="controls">
              				<input type="text"  class="input-xlarge" name="mobile" value="<?php echo set_value('mobile'); ?>">
			            </div>
					</div>
				</div>
			</div>
    		<div class="row-fluid">
				<div class="control-group align-center" style="margin-top:0;">
					<div class="controls" style="text-align:left;">
						<input type="hidden" name="user_type" value="1"/>
              			<input type="submit" class="btn buttonBlue" id="mybutton" value="Create an account" style="width:40%;">
            		</div>
          		</div>
    		</div>
		</form>
		</div>

        <div id="corporate_form_fields" <?php if(@$user_type == '2') {?>style="display: block;"<?php } else {?>style="display: none;"<?php }?>>
        <form class="form-horizontal" id="register_frm2" method="post" action="<?php echo site_url('register/newMember');?>" enctype="multipart/form-data" >
			<div class="row-fluid">
				<div class="span12">
          			<div class="control-group">
						<label class="control-label">First Name<span class="important">*</span></label>
            			<div class="controls">
              				<input type="text"  class="input-xlarge" name="first_name" value="<?php echo set_value('first_name'); ?>">
            			</div>
          			</div>
            		<div class="control-group">
            			<label class="control-label">Last Name<span class="important">*</span></label>
            			<div class="controls">
              				<input type="text"  class="input-xlarge" name="last_name" value="<?php echo set_value('last_name'); ?>">
            			</div>
          			</div>
            		<div class="control-group">
            			<label class="control-label">Email Address<span class="important">*</span></label>
            			<div class="controls">
              				<input type="text"  class="input-xlarge" name="email" value="<?php echo set_value('email'); ?>">
              				<?php echo form_error('email'); ?>
            			</div>
          			</div>
            		<div class="control-group">
            			<label class="control-label">Username<span class="important">*</span></label>
            			<div class="controls">
              				<input type="text"  class="input-xlarge" name="username" value="<?php echo set_value('username'); ?>">
              				<br/><span class="form_fields_note">Ex. ready2escape</span>
              				<?php echo form_error('username'); ?>
            			</div>
          			</div>
          			<div class="control-group">
            			<label class="control-label"> Choose a password<span class="important">*</span></label>
            			<div class="controls">
              				<input type="password"  class="input-xlarge" name="password" id="password1">
               				<br/><span class="form_fields_note">Ex. luckyme2013</span>
                  			<?php echo form_error('password'); ?>
            			</div>
          			</div>
          			<div class="control-group">
            			<label class="control-label">Confirm Password<span class="important">*</span></label>
            			<div class="controls">
              				<input type="password" class="input-xlarge" name="confirmation">
            			</div>
          			</div>
          			<div class="control-group" rel="owner_fields">
            			<label class="control-label">Contact Phone<span class="important">*</span></label>
            			<div class="controls">
              				<input type="text"  class="input-xlarge" name="phone" value="<?php echo set_value('phone'); ?>">
            			</div>
          			</div>
          			<div class="control-group" rel="owner_fields">
            			<label class="control-label">Mobile Phone</label>
            				<div class="controls">
              					<input type="text"  class="input-xlarge" name="mobile" value="<?php echo set_value('mobile'); ?>">
            				</div>
          			</div>
          			<div class="control-group" rel="owner_fields">
            			<label class="control-label">
					<input type="checkbox" name="is_business" id="is_business" /> Is your holiday escape set up as a business? </label>
          			</div>

    			</div>
    		</div>
			<div class="row-fluid">
				<div class="control-group align-center" style="margin-top:0;">
		            <div class="controls" style="text-align:left;">
						<input type="hidden" name="user_type" value="2"/>
              			<input type="submit" class="btn buttonBlue" id="mybutton" value="Create an account" style="width:40%;">
            		</div>
          		</div>
    		</div>
        </form>
		</div>
    </div>

    <div class="row-fluid" style="width:50%;float:left;margin-top:5%;">
        <div class="span6" style="width:78.93617%;margin-left:2.127659574468085%;margin-bottom:3%;">
            <div class="signin-link pull-right" style="margin-right:0;padding:24px 37px;text-align:center;">
		        <h5>Create an account using Facebook</h5>
				<button class="btn-facebook" id="facebook"><img src="<?php echo base_url(); ?>assets/frontend/images/facebook-icon.png" alt="facebook gr8 escape" /> Connect with Facebook</button>
            </div>
        </div>
        <div class="span6 signin-append" style="width:78.93617%;margin-top:5%;">
            <div class="signin-link pull-right" style="margin-right:0;">
            <h5>Already have an account?</h5>
            <a class="btn buttonBlue" href="<?php echo site_url('login');?>">Sign In</a>
            </div>
        </div>
    </div>


  </div>
</section>

<script type="text/javascript">
$(document).ready(function() {
	$('#is_business').change(function(){
		if($(this).is(":checked")) {
			var html = '<div class = "caption">';
                html += '<strong>Is your escape registered for GST?<br/><br/> Please note that it is your responsibility to pay the GST portion received from your holiday bookings to the NZ Government as it is required under the current NZ law <br/><br/> For holiday escapes not in NZ please check with your country laws around what tax you may be required to pay on the holiday bookings you receive <br/><br/> If you are unsure and need help, please send us an email and one of our Holiday representatives will contact you to explain further </strong>';
                html += '</div>';
                html +='<div class="control-group company_name" rel="owner_fields">';
            		html += '<label class="control-label">Company Name</label>';
            		html +=	'<div class="controls">';
              		html += '<input type="text"  class="input-xlarge" name="company" value="">';
            		html += '</div></div>';
			html += '<div class="control-group gst_area" rel="owner_fields">';
            		html += '<label class="control-label">GST number</label>';
            		html +=	'<div class="controls">';
              		html += '<input type="text"  class="input-xlarge" name="gst_number" value="">';
            		html += '</div></div>';
			$(this).parent().parent().after(html);
		}else{
			$('.gst_area').remove();
			$('.company_name').remove();
		}
	});
     $.validator.addMethod('alphanumeric', function(value, element) {
            return this.optional(element) || (value.match(/[a-zA-Z]/) && value.match(/[0-9]/));
        },
        'Password must contain at least one numeric and one alphabetic character.');
	$('#register_frm1').validate({
		rules: {
			first_name: {
                required: true,
                maxlength: 30
            },
			last_name: {
                required: true,
                maxlength: 30
            },
			username: {
				required: true,
				minlength: 6
			},
			password: {
				required: true,
				minlength: 6,
                alphanumeric: true
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
            first_name: {
				required: "Please enter your first name",
				minlength: "Your first name must be less than 30 characters"
			},
            last_name: {
				required: "Please enter your last name",
				minlength: "Your last name must be less than 30 characters"
			},
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
    $('#register_frm2').validate({
		rules: {
			first_name: {
                required: true,
                maxlength: 30
            },
            last_name: {
                required: true,
                maxlength: 30
            },
            phone:'required',
			mobile:'required',
            username: {
				required: true,
				minlength: 6
			},
			password: {
				required: true,
				minlength: 6,
                alphanumeric: true
			},
			confirmation: {
				required: true,
				minlength: 6,
				equalTo: "#password1"
			},
			email: {
				required: true,
				email: true
			}
		},
		messages: {
			first_name: {
				required: "Please enter your first name",
				minlength: "Your first name must be less than 30 characters"
			},
            last_name: {
				required: "Please enter your last name",
				minlength: "Your last name must be less than 30 characters"
			},
            phone: "Please enter your phone",
            mobile: "Please enter your mobile",
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
<script type="text/javascript">
function onchange_handler(obj, id) {
   //alert(id);
    var other_id = (id == 'personal')? 'corporate' : 'personal';
    //alert(other_id);
    if(obj.checked) {
        document.getElementById(id + '_form_fields').style.display = 'block';
        document.getElementById(other_id + '_form_fields').style.display = 'none';
    } else {
        document.getElementById(id + '_form_fields').style.display = 'none';
        document.getElementById(other_id + '_form_fields').style.display = 'block';
    }
}
</script>
<script type="text/javascript">
  window.fbAsyncInit = function() {
	  //Initiallize the facebook using the facebook javascript sdk
     FB.init({ 
       appId:'<?php echo $this->config->item('appID'); ?>', // App ID 
	   cookie:true, // enable cookies to allow the server to access the session
           status:true, // check login status
	   xfbml:true, // parse XFBML
	   oauth : true //enable Oauth 
     });
   };
   //Read the baseurl from the config.php file
   (function(d){
           var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
           if (d.getElementById(id)) {return;}
           js = d.createElement('script'); js.id = id; js.async = true;
           js.src = "//connect.facebook.net/en_US/all.js";
           ref.parentNode.insertBefore(js, ref);
         }(document));
	//Onclick for fb login
 $('#facebook').click(function(e) {
    FB.login(function(response) {
	  if(response.authResponse) {
		  parent.location ='<?php echo site_url('login/fblogin');?>'; //redirect uri after closing the facebook popup
	  }
 },{scope: 'email,read_stream,publish_stream,user_birthday,user_location,user_work_history,user_hometown,user_photos'}); //permissions for facebook
});
</script>
