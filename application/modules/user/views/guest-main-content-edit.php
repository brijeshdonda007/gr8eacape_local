

        <h4 class="marginNone">Edit Profile Details</h4>

        <div class="triangleArrow top"></div>

        

        <div class="Block clearfix">

            <form class="form-horizontal" id="register_frm1" method="post" action="<?php echo site_url('user/editProfile');?>" enctype="multipart/form-data" >

          <div class="row-fluid profileform clearfix">

            <div class="span10">

              <?php if(@$this->session->userdata('profile_edit_msg') != '') ?>

    <label class="error"><?php echo @$this->session->userdata('profile_edit_msg');  $this->session->unset_userdata(array('profile_edit_msg'=>''));?></label>

              <strong class="mediumStrong">Mailing Address:</strong>

              <fieldset>

                <label>First Name:</label> <input type="text" name="first_name" value="<?php echo @$user_profile_info->first_name;?>" />

                </fieldset>

              <fieldset>

                <label>last Name:</label> <input type="text" name="last_name" value="<?php echo @$user_profile_info->last_name;?>" />

                </fieldset>

                <fieldset>

                <label>Street Number:</label> <input type="text" name="street_no" value="<?php echo @$user_profile_info->street_no;?>" />

                </fieldset>

              <fieldset>

                <label>Street Name:</label> <input type="text" name="street_name" value="<?php echo @$user_profile_info->street_name;?>" />

                </fieldset>

              <fieldset>

                <label>Avenue:</label> <input type="text" name="avenue" value="<?php echo @$user_profile_info->avenue;?>" />

                </fieldset>

              <fieldset>

                <label>Suburb:</label> <input type="text" name="suburb" value="<?php echo @$user_profile_info->suburb;?>" />

                </fieldset>

              <?php

              if(@$user_profile_info->user_type == '1')

              {

              ?>

                <fieldset>

                <label>Cityaaaaa:</label> <input type="text" name="city" value="<?php echo @$user_profile_info->city;?>" />

                </fieldset>

              <fieldset>

                <label>Country:</label> <input type="text" name="country_title" value="<?php echo @$user_profile_info->country_title;?>" />

                </fieldset>

              <?php

              

              }

              elseif(@$user_profile_info->user_type == '2')

              {

              ?>

              <fieldset>

                <label>Country:</label> 

                

                <select name="country_id">

                    <option value="aaaaa">aaaa</option>

                </select>

                </fieldset>

              <fieldset>

                <label>Cityvvvv:</label> <input type="text" name="city" value="<?php echo @$user_profile_info->city;?>" />

                </fieldset>

              

              <?php

              }

              else

              {

                  

              }

              ?>

                <fieldset>

                <label>Profile Picture:</label> <input type="file" name="profile_picture" />

                </fieldset>

              <fieldset>

                <label>Phone:</label> <input type="text" name="phone" value="<?php echo @$user_profile_info->phone;?>" />

                </fieldset>

              <fieldset>

                <label>Mobile:</label> <input type="text" name="mobile" value="<?php echo @$user_profile_info->mobile;?>" />

                </fieldset>

              <fieldset>

                <label>Post_code:</label> <input type="text" name="post_code" value="<?php echo @$user_profile_info->post_code;?>" />

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

         

        <div class="Block clearfix"> <a href="#" class="pull-right"><strong>VIEW ALL</strong></a>

          <h4>Booking Request</h4>

          <table class="table table-striped">

            <thead>

              <tr>

                <th>Purchase Code</th>

                <th>Item Purchased</th>

                <th>Starting Date</th>

                <th>Amount</th>

                <th>Action</th>

              </tr>

            </thead>

            <tbody>

              <tr>

                <td>12ACG%3</td>

                <td>Bach in Auckland for 2 nights</td>

                <td>05-04-2013 </td>

                <td><strong>NZ 2000</strong></td>

                <td><div class="hyperlink"><img src="<?php echo base_url(); ?>assets/frontend/images/cross.png" alt="cross" class="pull-left" /> <a href="#">Cancel Booking</a></div>

                  <div class="hyperlink"> <img src="<?php echo base_url(); ?>assets/frontend/images/email.png" alt="cross" class="pull-left" /> <a href="#">Contact Owner</a> </div></td>

              </tr>

              <tr>

                <td>12ACG%3</td>

                <td>Bach in Auckland for 2 nights</td>

                <td>05-04-2013 </td>

                <td><strong>NZ 2000</strong></td>

                <td><div class="hyperlink"><img src="<?php echo base_url(); ?>assets/frontend/images/cross.png" alt="cross" class="pull-left" /> <a href="#">Cancel Booking</a></div>

                  <div class="hyperlink"> <img src="<?php echo base_url(); ?>assets/frontend/images/email.png" alt="cross" class="pull-left" /> <a href="#">Contact Owner</a> </div></td>

              </tr>

              <tr>

                <td>12ACG%3</td>

                <td>Bach in Auckland for 2 nights</td>

                <td>05-04-2013 </td>

                <td><strong>NZ 2000</strong></td>

                <td><div class="hyperlink"><img src="<?php echo base_url(); ?>assets/frontend/images/cross.png" alt="cross" class="pull-left" /> <a href="#">Cancel Booking</a></div>

                  <div class="hyperlink"> <img src="<?php echo base_url(); ?>assets/frontend/images/email.png" alt="cross" class="pull-left" /> <a href="#">Contact Owner</a> </div></td>

              </tr>

              <tr>

                <td>12ACG%3</td>

                <td>Bach in Auckland for 2 nights</td>

                <td>05-04-2013 </td>

                <td><strong>NZ 2000</strong></td>

                <td><div class="hyperlink"><img src="<?php echo base_url(); ?>assets/frontend/images/cross.png" alt="cross" class="pull-left" /> <a href="#">Cancel Booking</a></div>

                  <div class="hyperlink"> <img src="<?php echo base_url(); ?>assets/frontend/images/email.png" alt="cross" class="pull-left" /> <a href="#">Contact Owner</a> </div></td>

              </tr>

              <tr>

                <td>12ACG%3</td>

                <td>Bach in Auckland for 2 nights</td>

                <td>05-04-2013 </td>

                <td><strong>NZ 2000</strong></td>

                <td><div class="hyperlink"><img src="<?php echo base_url(); ?>assets/frontend/images/cross.png" alt="cross" class="pull-left" /> <a href="#">Cancel Booking</a></div>

                  <div class="hyperlink"> <img src="<?php echo base_url(); ?>assets/frontend/images/email.png" alt="cross" class="pull-left" /> <a href="#">Contact Owner</a> </div></td>

              </tr>

              <tr>

                <td>12ACG%3</td>

                <td>Bach in Auckland for 2 nights</td>

                <td>05-04-2013 </td>

                <td><strong>NZ 2000</strong></td>

                <td><div class="hyperlink"><img src="<?php echo base_url(); ?>assets/frontend/images/cross.png" alt="cross" class="pull-left" /> <a href="#">Cancel Booking</a></div>

                  <div class="hyperlink"> <img src="<?php echo base_url(); ?>assets/frontend/images/email.png" alt="cross" class="pull-left" /> <a href="#">Contact Owner</a> </div></td>

              </tr>

            </tbody>

          </table>

        </div>