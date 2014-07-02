<div class="bodyfloatleft">
	<div class="bodytop">
		<h2><?php echo @$form_title;?></h2>
		<form class="formholder" method="post" id ="formholder" name="formholder" enctype="multipart/form-data" action="<?php echo site_url('users/newuser');?>">
			<!--<fieldset class="border">
				<legend>User Type</legend>
				<label><input class="inputbuttons" type="radio" name="user_type" value="1" checked />Guest</label>
				<label><input class="inputbuttons" type="radio" name="user_type" value="2" /> Owner</label>
			</fieldset>-->
			<fieldset>
				<label>User Type</label>
				<select name="user_type">
					<?php foreach (@$usergroup as $ug){ ?>
					<option value="<?php echo $ug->id; ?>"><?php echo $ug->name; ?></option>
					<?php } ?>
				</select>
			</fieldset>
			<fieldset>
				<label>First Name</label>
				<input class="inputmedium" type="text" name="first_name" value="" required="1"/>
			</fieldset>
			<fieldset>
				<label>Last Name</label>
				<input class="inputmedium" type="text" name="last_name" value="" required="1"/>
			</fieldset>
			<fieldset>
				<label>User Name</label>
				<input class="inputmedium" type="text" name="username" value="" required="1"/>
			</fieldset>
			<fieldset>
				<label>Email</label>
				<input class="inputmedium" type="text" name="email" value="" required="1"/>
			</fieldset>
			<fieldset class="border">
				<legend>Gender</legend>
				<label><input class="inputbuttons" type="radio" name="gender" value="1" checked /> Man</label>
				<label><input class="inputbuttons" type="radio" name="gender" value="0" checked /> Women</label>
			</fieldset>
			<fieldset>
				<label>Profile Picture</label>
				<input type="file" name="profile_picture">
			</fieldset>
			<fieldset>
				<label>Description</label>
				<textarea class="inputmedium" name="user_description"></textarea>
			</fieldset>
			<fieldset>
				<label>Street Number</label>
				<input class="inputmedium" type="text" name="street_no" value=""/>
			</fieldset>
			<fieldset>
				<label>Street Name</label>
				<input class="inputmedium" type="text" name="street_name" value=""/>
			</fieldset>
			<fieldset>
				<label>Suburb</label>
				<input class="inputmedium" type="text" name="suburb" value=""/>
			</fieldset>
			<fieldset>
				<label>City</label>
				<input class="inputmedium" type="text" name="city" value=""/>
			</fieldset>
			<fieldset>
				<label>Region</label>
				<input class="inputmedium" type="text" name="region" value=""/>
			</fieldset>
			<fieldset>
				<label>Country</label>
				<select name="country_id">
					<?php foreach (@$country as $cntry){ ?>
					<option value="<?php echo $cntry->id; ?>" ><?php echo $cntry->countryname; ?></option>
					<?php } ?>
				</select>
			</fieldset>
			<fieldset>
				<label>Phone</label>
				<input class="inputmedium" type="text" name="phone" value="" required="1"/>
			</fieldset>
			<fieldset>
				<label>Mobile</label>
				<input class="inputmedium" type="text" name="mobile" value="" required="1"/>
			</fieldset>
			<fieldset>
				<label>Post Code</label>
				<input class="inputmedium" type="text" name="post_code" value="" />
			</fieldset>
			<fieldset>
				<label>About Me</label>
				<textarea class="inputmedium" name="about_yourself"></textarea>
			</fieldset>
			<fieldset>
				<label>Business</label>
				<input type="checkbox" name="is_business" id="is_business" />Is Business?
			</fieldset>

			<fieldset class="border">
				<legend>Status</legend>
				<label><input class="inputbuttons" type="radio" name="status" value="1" /> Active</label>
				<label><input class="inputbuttons" type="radio" name="status" value="0" checked /> Inactive</label>
			</fieldset>
			<fieldset>
				<input type="hidden" name="userid" value="" />
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
