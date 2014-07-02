<div class="row">
	<div class="col-md-12">
		<div class="panel">
			<div class="panel-heading">
				<div class="panel-title"> <i class="fa fa-pencil"></i> <?php echo @$form_title;?> </div>
			</div>
			<div class="panel-body">
				<form class="form-horizontal formholder" method="post" role="form" id ="formholder" name="formholder" enctype="multipart/form-data" action="<?php echo site_url('admin/addeditUser');?>">
					<div class="form-group">
						<label class="col-md-3 control-label">User Type</label>
						<div class="col-md-4">
							<select name="user_type" class="form-control">
								<?php foreach (@$usergroup as $ug){ ?>
								<option value="<?php echo $ug->id; ?>" <?php if (@$user->user_type == $ug->id) { echo 'selected'; }?>><?php echo $ug->name; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">First Name</label>
						<div class="col-md-4">
							<input class="form-control col-xs-3" type="text" name="first_name" value="<?php echo @$user->first_name;?>" required="1"/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Last Name</label>
						<div class="col-md-4">
							<input class="form-control" type="text" name="last_name" value="<?php echo @$user->last_name;?>" required="1"/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">User Name</label>
						<div class="col-md-4">
							<input class="form-control" type="text" name="username" value="<?php echo @$user->username;?>" required="1"/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Email</label>
						<div class="col-md-4">
							<div class="input-group margin-bottom"><span class="input-group-addon"><i class="fa fa-envelope-o"></i> </span>
								<input class="form-control" type="text" name="email" value="<?php echo @$user->email;?>" required="1"/>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Gender</label>
						<div class="col-md-4">
							<label class="radio-inline"><input class="radio" type="radio" name="gender" value="1" <?php if((@$user->gender == '1') or !isset($user)) { ?>checked<?php }?> /> Man</label>
							<label class="radio-inline"><input class="radio" type="radio" name="gender" value="0" <?php if(@$user->gender == '0') { ?>checked<?php }?> /> Women</label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Profile Picture</label>
						<div class="col-md-4">
							<?php if (@$user->profile_picture == ''){ ?>
							<img src="/assets/frontend/images/no-image.png" style="display:block;margin-bottom:10px;width:100px;"/>
							<?php } else { ?>
							<img src="/images/profile_img/medium/<?php echo @$user->profile_picture; ?>" style="display:block;margin-bottom:10px;"/>
							<?php } ?>
							<input type="file" class="form-control" name="profile_picture">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Description</label>
						<div class="col-md-4">
							<textarea class="form-control" name="user_description"><?php echo @$user->user_description;?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Street Number</label>
						<div class="col-md-4">
							<input class="form-control" type="text" name="street_no" value="<?php echo @$user->street_no;?>"/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Street Name</label>
						<div class="col-md-4">
							<input class="form-control" type="text" name="street_name" value="<?php echo @$user->street_name;?>"/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Suburb</label>
						<div class="col-md-4">
							<input class="form-control" type="text" name="suburb" value="<?php echo @$user->suburb;?>"/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">City</label>
						<div class="col-md-4">
							<input class="form-control" type="text" name="city" value="<?php echo @$user->city;?>"/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Region</label>
						<div class="col-md-4">
							<input class="form-control" type="text" name="region" value="<?php echo @$user->region;?>"/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Country</label>
						<div class="col-md-4">
							<select name="country_id" class="form-control">
								<?php foreach (@$country as $cntry){ ?>
								<option value="<?php echo $cntry->id; ?>" <?php if ($cntry->id == @$user->country_id) echo 'selected'; ?> ><?php echo $cntry->countryname; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Phone</label>
						<div class="col-md-4">
							<div class="input-group margin-bottom"><span class="input-group-addon"><i class="fa fa-phone"></i> </span>
								<input class="form-control" type="text" name="phone" value="<?php echo @$user->phone;?>" required="1"/>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Mobile</label>
						<div class="col-md-4">
							<div class="input-group margin-bottom"><span class="input-group-addon"><i class="fa fa-phone"></i> </span>
								<input class="form-control" type="text" name="mobile" value="<?php echo @$user->mobile;?>" required="1"/>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Post Code</label>
						<div class="col-md-4">
							<div class="input-group margin-bottom"><span class="input-group-addon"><i class="fa fa-bolt"></i> </span>
								<input class="form-control" type="text" name="post_code" value="<?php echo @$user->post_code;?>" />
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">About Me</label>
						<div class="col-md-4">
							<textarea class="form-control" name="about_yourself"><?php echo @$user->about_yourself;?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Business</label>
						<div class="col-md-4">
							<label class="checkbox-inline">
							<input type="checkbox" class="checkbox" name="is_business" id="is_business" <?php if (@$user->is_business == '1') echo 'checked="checked"'; ?>/>Is Business?</label>
						</div>
					</div>
					<?php if (@$user->is_business == '1'){ ?>
					<div class="form-group company_name">
						<label class="col-md-3 control-label">Company Name</label>
						<div class="col-md-4">
							<input type="text" class="form-control" name="company_name" value="<?php echo @$user->company_name; ?>" />
						</div>
					</div>
					<div class="form-group gst_area">
						<label class="col-md-3 control-label">Gst Number</label>
						<div class="col-md-4">
							<input type="text" class="form-control" name="gst_num" value="<?php echo @$user->gst_num; ?>" />
						</div>
					</fieldset>
					<?php } ?>

					<div class="form-group">
						<label class="col-md-3 control-label">Status</label>
						<div class="col-md-4">
							<label class="radio-inline"><input class="radio" type="radio" name="status" value="1" <?php if((@$user->user_status == '1') or !isset($user)) { ?>checked<?php }?> /> Active</label>
							<label class="radio-inline"><input class="radio" type="radio" name="status" value="0" <?php if(@$user->user_status == '0') { ?>checked<?php }?> /> Inactive</label>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-3">
						</div>
						<div class="col-md-4">
							<input type="hidden" name="userid" value="<?php echo @$user->id;?>" />
							<button class="btn btn-success" type="submit">Submit</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$('#is_business').change(function(){
		if($(this).is(":checked")) {
			var html = '<div class="form-group company_name">';
            		html += '<label class="col-md-3 control-label">Company Name</label>';
              		html += '<div class="col-md-4"><input type="text" class="form-control" name="company_name" value=""></div>';
            		html += '</div>';
			html += '<div class="form-group gst_area">';
            		html += '<label class="col-md-3 control-label">GST number</label>';
              		html += '<div class="col-md-4"><input type="text" class="form-control" name="gst_num" value=""></div>';
            		html += '</div>';
			$(this).parent().parent().parent().parent().parent().after(html);
		}else{
			$('.gst_area').remove();
			$('.company_name').remove();
		}
	});
	$(".checkbox").uniform();
 	$(".radio").uniform();
});
</script>