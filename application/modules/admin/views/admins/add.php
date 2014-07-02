<div class="row">
	<div class="col-md-12">
		<div class="panel">
			<div class="panel-heading">
				<div class="panel-title"> <i class="fa fa-pencil"></i> <?php echo @$form_title;?> </div>
			</div>
			<div class="panel-body">
				<form class="form-horizontal formholder" method="post" role="form" id ="formholder" name="formholder" enctype="multipart/form-data" action="<?php echo site_url('admin/newadmin');?>">
					<div class="form-group">
						<label class="col-md-3 control-label">First Name</label>
						<div class="col-md-4">
							<input class="form-control col-xs-3" type="text" id="first_name" name="first_name" value="" required />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Last Name</label>
						<div class="col-md-4">
							<input class="form-control" type="text" id="last_name" name="last_name" value="" required />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">User Name</label>
						<div class="col-md-4">
							<input class="form-control" type="text" id="username" name="username" value="" required />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Email</label>
						<div class="col-md-4">
							<div class="input-group margin-bottom"><span class="input-group-addon"><i class="fa fa-envelope-o"></i> </span>
								<input class="form-control" type="email" id="email" name="email" value="" required />
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Password</label>
						<div class="col-md-4">
							<div class="input-group margin-bottom"><span class="input-group-addon"><i class="fa fa-key"></i> </span>
								<input class="form-control" type="password" id="password" name="password" value="" required />
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Confirm Password</label>
						<div class="col-md-4">
							<div class="input-group margin-bottom"><span class="input-group-addon"><i class="fa fa-key"></i> </span>
								<input class="form-control" type="password" id="confirm_password" name="confirm_password" value="" required />
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Status</label>
						<div class="col-md-4">
							<label class="radio-inline"><input class="radio" type="radio" name="status" value="1" /> Active</label>
							<label class="radio-inline"><input class="radio" type="radio" name="status" value="0" checked /> Inactive</label>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-3">
						</div>
						<div class="col-md-4">
							<input type="hidden" name="userid" value="" />
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
	$(".checkbox").uniform();
 	$(".radio").uniform();
 	$("#formholder").validate({
 		rules:{
 			first_name:"required",
 			last_name:"required",
 			username:"required",
 			email:{
 				required:true,
 				email:true
 			},
 			password:{
 				required:true,
 				minlength:5
 			},
 			confirm_password:{
 				required:true,
 				minlength:5
 				equalTo:"#password"
 			}
 		},
 		messages:{
 			first_name:"Please enter first name",
 			last_name:"Please enter last name",
 			username:"Please enter user name",
 			email:"Please enter a valid email address",
 			password:{
 				required:"Please provide a password",
 				minlength:"Your password must be at least 5 characters long"
 			},
 			confirm_password:{
 				required:"Please provide a password",
 				minlength:"Your password must be at least 5 characters long",
 				equalTo:"Please enter the same password as above"
 			}
 		}
 	});
});
</script>
