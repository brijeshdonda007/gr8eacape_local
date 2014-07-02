<div class="row">
	<div class="col-md-12">
		<div class="panel">
			<div class="panel-heading">
				<div class="panel-title"> <i class="fa fa-pencil"></i> <?php echo @$form_title;?> </div>
			</div>
			<div class="panel-body">
				<form class="form-horizontal formholder" method="post" id ="formholder" name="formholder" enctype="multipart/form-data" action="<?php echo site_url('admin/addeditGroup');?>">
					<div class="form-group">
						<label class="col-md-3 control-label">Group Name</label>
						<div class="col-md-4">
							<input class="form-control" type="text" name="groupname" value="<?php echo @$group->name; ?>" required="1"/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Permission</label>
						<div class="col-md-9">
						<?php foreach($sections as $sc){ ?>
							<div class="col-md-12" style="margin-bottom:20px;"><b><?php echo $sc->name; ?></b><br/>
							<?php foreach($properties as $pr){ ?>
								<?php if ($sc->id == $pr->section_id){ ?>
									<label class="checkbox-inline">
										<?php
											$temp = $group->id.'_'.$sc->id.'_'.$pr->id;
											if (in_array($temp, $group_detail)){
										?>
										<input type="checkbox" class="checkbox" name="group_detail[]" value="<?php echo $group->id;?>_<?php echo $sc->id;?>_<?php echo $pr->id; ?>" checked />
										<?php }else{ ?>
											<input type="checkbox" class="checkbox" name="group_detail[]" value="<?php echo $group->id;?>_<?php echo $sc->id;?>_<?php echo $pr->id; ?>" />
										<?php } ?>
										<?php echo $pr->name;?>
									</label>
								<?php } ?>
							<?php } ?></div>
						<?php } ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Status</label>
						<div class="col-md-4">
							<label class="radio-inline"><input class="radio" type="radio" name="status" value="1" <?php if (@$group->status =='1') {?>checked<?php } ?>/> Active</label>
							<label class="radio-inline"><input class="radio" type="radio" name="status" value="0" <?php if (@$group->status =='0') {?>checked<?php } ?> /> Inactive</label>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-3">
						</div>
						<div class="col-md-4">
							<input type="hidden" name="groupid" value="<?php echo $group->id; ?>" />
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
 })
</script>