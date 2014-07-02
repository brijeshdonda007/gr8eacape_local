

        <h4 class="marginNone">Change Password</h4>

        <div class="triangleArrow top"></div>

        

        <div class="Block clearfix">

            <form class="form-horizontal" id="change_profile_pwd" method="post" action="<?php echo site_url('user/changePasswordProcess');?>" enctype="multipart/form-data" >

          <div class="row-fluid profileform clearfix">

              

            <div class="span10">

              <?php if(@$this->session->userdata('profile_edit_msg') != '') ?>

    <label class="error"><?php echo @$this->session->userdata('profile_edit_msg');  $this->session->unset_userdata(array('profile_edit_msg'=>''));?></label>

              

                <fieldset>

                <label>New Password: </label> <input type="password" name="password" id="password" value="" /></fieldset>

                <fieldset>

                <label> Confirm Password: </label> <input type="password" name="confirmation" value="" /></fieldset>

              

            </div>

            

            <div class="clear"></div>

          </div>

            <input type="hidden" name="user_id" value="<?php echo $user_profile_info->id;?>" />

            <input type="submit" class="btn buttonBlue" id="mybutton" value="Change Password">

        </form>

        </div>

            

        

        <script type="text/javascript">



           

$(document).ready(function() {

     $.validator.addMethod('alphanumeric', function(value, element) {

            return this.optional(element) || (value.match(/[a-zA-Z]/) && value.match(/[0-9]/));

        },

        'Password must contain at least one numeric and one alphabetic character.');

	$('#change_profile_pwd').validate({

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

				required: "Please enter a confirm password",

				minlength: "Your password must be at least 6 characters long",

				equalTo: "Please enter the same password as above"

			}

							

		}

	});

        

        

});



</script>  

        