<div class="bodyfloatleft">
    <div class="bodytop">
        <h2><?php echo @$form_title;?></h2>
    	<form class="formholder" method="post" id ="formholder" name="formholder" enctype="multipart/form-data" action="<?php echo site_url('users/addeditUser');?>">
			<fieldset>
				<label>User Type</label>
				<select name="user_type">
					<?php foreach (@$usergroup as $ug){ ?>
					<option value="<?php echo $ug->id; ?>" <?php if (@$user->user_type == $ug->id) { echo 'selected'; }?>><?php echo $ug->name; ?></option>
					<?php } ?>
				</select>
			</fieldset>
			<fieldset>
				<label>First Name</label>
				<input class="inputmedium" type="text" name="first_name" value="<?php echo @$user->first_name;?>" required="1"/>
			</fieldset>
			<fieldset>
				<label>Last Name</label>
				<input class="inputmedium" type="text" name="last_name" value="<?php echo @$user->last_name;?>" required="1"/>
			</fieldset>
			<fieldset>
				<label>User Name</label>
				<input class="inputmedium" type="text" name="username" value="<?php echo @$user->username;?>" required="1"/>
			</fieldset>
			<fieldset>
				<label>Email</label>
				<input class="inputmedium" type="text" name="email" value="<?php echo @$user->email;?>" required="1"/>
			</fieldset>
			<fieldset class="border">
				<legend>Gender</legend>
				<label><input class="inputbuttons" type="radio" name="gender" value="1" <?php if((@$user->gender == '1') or !isset($user)) { ?>checked<?php }?>/> Man</label>
				<label><input class="inputbuttons" type="radio" name="gender" value="0" <?php if(@$user->gender == '0') { ?>checked<?php }?> /> Women</label>
			</fieldset>
			<fieldset>
				<label>Profile Picture</label>
				<?php if (@$user->profile_picture == ''){ ?>
				<img src="/assets/frontend/images/no-image.png" style="display:block;margin-bottom:10px;width:100px;"/>
				<?php } else { ?>
				<img src="/images/profile_img/medium/<?php echo @$user->profile_picture; ?>" style="display:block;margin-bottom:10px;"/>
				<?php } ?>
				<input type="file" name="profile_picture">
			</fieldset>
			<fieldset>
				<label>Description</label>
				<textarea class="inputmedium" name="user_description"><?php echo @$user->user_description;?></textarea>
			</fieldset>
			<fieldset>
				<label>Street Number</label>
				<input class="inputmedium" type="text" name="street_no" value="<?php echo @$user->street_no;?>"/>
			</fieldset>
			<fieldset>
				<label>Street Name</label>
				<input class="inputmedium" type="text" name="street_name" value="<?php echo @$user->street_name;?>"/>
			</fieldset>
			<fieldset>
				<label>Suburb</label>
				<input class="inputmedium" type="text" name="suburb" value="<?php echo @$user->suburb;?>"/>
			</fieldset>
			<fieldset>
				<label>City</label>
			    <input class="inputmedium" type="text" name="city" value="<?php echo @$user->city;?>"/>
			</fieldset>
			<fieldset>
				<label>Region</label>
				<input class="inputmedium" type="text" name="region" value="<?php echo @$user->region;?>"/>
			</fieldset>
			<fieldset>
				<label>Country</label>
				<select name="country_id">
					<?php foreach (@$country as $cntry){ ?>
					<option value="<?php echo $cntry->id; ?>" <?php if ($cntry->id == @$user->country_id) echo 'selected'; ?> ><?php echo $cntry->countryname; ?></option>
					<?php } ?>
				</select>
			</fieldset>
			<fieldset>
				<label>Phone</label>
				<input class="inputmedium" type="text" name="phone" value="<?php echo @$user->phone;?>" required="1"/>
			</fieldset>
			<fieldset>
				<label>Mobile</label>
				<input class="inputmedium" type="text" name="mobile" value="<?php echo @$user->mobile;?>" required="1"/>
			</fieldset>
			<fieldset>
				<label>Post Code</label>
				<input class="inputmedium" type="text" name="post_code" value="<?php echo @$user->post_code;?>" />
			</fieldset>
			<fieldset>
				<label>About Me</label>
				<textarea class="inputmedium" name="about_yourself"><?php echo @$user->about_yourself;?></textarea>
			</fieldset>
			<fieldset>
				<label>Business</label>
				<input type="checkbox" name="is_business" id="is_business" <?php if (@$user->is_business == '1') echo 'checked="checked"'; ?>>Is Business?
			</fieldset>
			<?php if (@$user->is_business == '1'){ ?>
			<fieldset class="company_name">
				<label>Company Name</label>
				<input type="text" name="company_name" value="<?php echo @$user->company_name; ?>" />
			</fieldset>
			<fieldset class="gst_area">
				<label>Gst Number</label>
				<input type="text" name="gst_num" value="<?php echo @$user->gst_num; ?>" />
			</fieldset>
			<?php } ?>
			<fieldset class="border">
				<legend>Status</legend>
				<label><input class="inputbuttons" type="radio" name="status" value="1" <?php if((@$user->user_status == '1') or !isset($user)) { ?>checked<?php }?>/> Active</label>
				<label><input class="inputbuttons" type="radio" name="status" value="0" <?php if(@$user->user_status == '0') { ?>checked<?php }?> /> Inactive</label>
			</fieldset>
			<fieldset>
				<input type="hidden" name="userid" value="<?php echo @$user->id;?>" />
				<button class="buttonBlue" type="submit">Submit</button>
			</fieldset>
		</form>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$('#is_business').change(function(){
		if($(this).is(":checked")) {
			var html = '<fieldset class="company_name">';
            		html += '<label>Company Name</label>';
              		html += '<input type="text" name="company_name" value="">';
            		html += '</fieldset>';
			html += '<fieldset class="gst_area">';
            		html += '<label>GST number</label>';
              		html += '<input type="text" name="gst_num" value="">';
            		html += '</fieldset>';
			$(this).parent().after(html);
		}else{
			$('.gst_area').remove();
			$('.company_name').remove();
		}
	});
});
</script>
