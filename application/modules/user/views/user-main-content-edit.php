<?php
if($this->uri->segment(3))
{
    ?>
<div class="buttonRed" style="width: auto; height: 40px;">Please provide the required (*) fields to list your escape!</div>
<?php
}
?>
        <h4 class="marginNone">Edit Profile Details</h4>
        <div class="triangleArrow top"></div>
        <div class="Block clearfix">
            <form class="form-horizontal edit_profile" id="register_frm1" method="post" action="<?php if($this->uri->segment(3)){ echo site_url('user/editProfile/tolist');} else { site_url('user/editProfile');}?>" enctype="multipart/form-data" >
          <div class="row-fluid profileform clearfix">
            <div class="span10">
              <?php if(@$this->session->userdata('profile_edit_msg') != '') ?>
    <label class="error"><?php echo @$this->session->userdata('profile_edit_msg');  $this->session->unset_userdata(array('profile_edit_msg'=>''));?></label>
              <strong class="mediumStrong">Mailing Address:</strong>
              <fieldset>
                <label>First Name:</label> <input type="text" name="first_name" value="<?php echo @$user_profile_info->first_name;?>" />
                </fieldset>
              <fieldset>
                <label>Last Name:</label> <input type="text" name="last_name" value="<?php echo @$user_profile_info->last_name;?>" />
                </fieldset>
                <fieldset>
                <label>Street Number:</label> <input type="text" name="street_no" value="<?php echo @$user_profile_info->street_no;?>" />
                </fieldset>
              <fieldset>
                <label>Street Name:</label> <input type="text" name="street_name" value="<?php echo @$user_profile_info->street_name;?>" />
                </fieldset>
              <fieldset>
                <label>Suburb:</label> <input type="text" name="suburb" value="<?php echo @$user_profile_info->suburb;?>" />
                </fieldset>
             <fieldset>
                <label>City:</label> <input type="text" name="city" value="<?php echo @$user_profile_info->city;?>" />
                 <?php if($this->uri->segment(3))
{?>
                <span>(*)</span>
<?php }?>
                </fieldset>
              <fieldset>
                <label>Region:</label> <input type="text" name="region" value="<?php echo @$user_profile_info->region;?>" />
                 <?php if($this->uri->segment(3))
{?>
                <span>(*)</span>
<?php }?>
                </fieldset>

                              <fieldset>
                <label>Post Code:</label> <input type="text" name="post_code" value="<?php echo @$user_profile_info->post_code;?>" />
<?php if($this->uri->segment(3))
{?>
                <span>(*)</span>
<?php }?>
                </fieldset>

                <fieldset>
                <label>Country:</label> 
                <select name="country_id" id="country_id">
                        <option value="">Select</option>
                      <?php
                      foreach ($countries_users as $cn):
                      ?>
                      <option value="<?php echo $cn->id;?>" <?php if(($cn->id == @$user_profile_info->country_id)) { ?>selected<?php }?>><?php echo $cn->countryname?></option>
                      <?php
                      endforeach;
                      ?>
                    </select>                <?php if($this->uri->segment(3))
{?>
                <span>(*)</span>
<?php }?>
                </fieldset>
                <fieldset>
                <label>Profile Picture:</label> <input type="file" name="profile_picture" />
                </fieldset>
                <fieldset>
                <label>Youtube ID:</label> <input type="text" name="youtube_id" value="<?php echo @$user_profile_info->youtube_id; ?>"/>
                </fieldset>

              <fieldset>
                <label>Phone:</label> <input type="text" name="phone" value="<?php echo @$user_profile_info->phone;?>" />                <?php if($this->uri->segment(3))
{?>
                <span>(*)</span>
<?php }?>
                </fieldset>
              <fieldset>
                <label>Mobile:</label> <input type="text" name="mobile" value="<?php echo @$user_profile_info->mobile;?>" />
<?php if($this->uri->segment(3))
{?>
                <span>(*)</span>
<?php }?>
                </fieldset>
                <fieldset>
                <label>About Me:</label> <textarea name="about_yourself"><?php echo @$user_profile_info->about_yourself;?></textarea></fieldset>
            </div>
            <div class="clear"></div>
          </div>
			<input type="hidden" name="user_id" value="<?php echo $user_profile_info->id;?>" />
			<input type="hidden" name="old_profile_picture" value="<?php echo $user_profile_info->profile_picture; ?>" />
			<input type="hidden" name="edit_ptofile" value="1"/>
			<input type="submit" class="btn buttonBlue" id="mybutton" value="Submit">
        </form>
        </div>
<?php
if($this->uri->segment(3))
{
?>
<script>
        $(document).ready(function(){
            $(".edit_profile").validate({
               rules:{
                   phone:{
                       required:true
                   },
                   country_id:{
                       required:true
                   },
                   region:{
                       required:true
                   },
                   city:{
                       required:true
                   },
                     mobile:{
                       required:true
                   },
                     post_code:{
                       required:true
                   }
               } ,
               messages:{
                   phone:{
                       required:"Please Enter your Phone"
                   },
                    country_id:{
                       required:"Please Select your Country"
                   },
                    region:{
                       required:"Please enter your Region"
                   },
                    city:{
                       required:"Please enter your City"
                   },
                     mobile:{
                       required:"Please Enter your mobile"
                   },
                    post_code:{
                       required:"Please Enter your post code"
                   }
               }
            });
        });
    </script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/frontend/js/jquery.validate.min.js"></script>
<?php
}
?>
