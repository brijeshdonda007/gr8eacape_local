<div class="row">
	<div class="col-md-12">
		<div class="panel">
			<div class="panel-heading">
				<div class="panel-title"> <i class="fa fa-pencil"></i> <?php echo @$form_title;?> </div>
			</div>
			<div class="panel-body">
				<form class="form-horizontal formholder" method="post" role="form" id ="formholder" name="formholder" enctype="multipart/form-data" action="<?php echo site_url('admin/addeditAdmin');?>">
					<div class="form-group">
						<label class="col-md-3 control-label">First Name</label>
						<div class="col-md-4">
							<input class="form-control col-xs-3" type="text" id="first_name" name="first_name" value="<?php echo @$admin->first_name;?>" required="1"/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Last Name</label>
						<div class="col-md-4">
							<input class="form-control" type="text" id="last_name" name="last_name" value="<?php echo @$admin->last_name;?>" required="1"/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">User Name</label>
						<div class="col-md-4">
							<input class="form-control" type="text" id="username" name="username" value="<?php echo @$admin->username;?>" required="1"/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Email</label>
						<div class="col-md-4">
							<div class="input-group margin-bottom"><span class="input-group-addon"><i class="fa fa-envelope-o"></i> </span>
								<input class="form-control" type="text" id="email" name="email" value="<?php echo @$admin->email;?>" required="1"/>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Password</label>
						<div class="col-md-4">
							<div class="input-group margin-bottom"><span class="input-group-addon"><i class="fa fa-key"></i> </span>
								<input class="form-control" type="password" id="password" name="password" value="" />
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Confirm Password</label>
						<div class="col-md-4">
							<div class="input-group margin-bottom"><span class="input-group-addon"><i class="fa fa-key"></i> </span>
								<input class="form-control" type="password" id="confirm_password" name="confirm_password" value="" />
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Status</label>
						<div class="col-md-4">
							<label class="radio-inline"><input class="radio" type="radio" name="status" value="1" <?php if((@$admin->admin_status == '1') or !isset($admin)) { ?>checked<?php }?> /> Active</label>
							<label class="radio-inline"><input class="radio" type="radio" name="status" value="0" <?php if(@$admin->admin_status == '0') { ?>checked<?php }?> /> Inactive</label>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-3">
						</div>
						<div class="col-md-4">
							<input type="hidden" name="adminid" value="<?php echo @$admin->id;?>" />
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
 	$("#formholder").validate({
 		rules:{
 			first_name:"required",
 			last_name:"required",
 			username:"required",
 			email:{
 				required:true,
 				email:true
 			}
 		},
 		messages:{
 			first_name:"Please enter first name",
 			last_name:"Please enter last name",
 			username:"Please enter user name",
 			email:"Please enter a valid email address"
 		}
 	});
});
</script>