<div class="row">
	<div class="col-md-12">
		<div class="panel">
			<div class="panel-heading">
				<div class="panel-title"> <i class="fa fa-pencil"></i> <?php echo @$form_title; ?> </div>
			</div>
			<div class="panel-body">
				<form class="form-horizontal formholder" method="post" id ="formholder" name="formholder" enctype="multipart/form-data" action="<?php echo site_url('admin/addeditcategory');?>">
					<input type="hidden" name="page_id" value="<?php echo @$category->id; ?>" />
					<div class="form-group">
						<label class="col-md-3 control-label">Title</label>
						<div class="col-md-4">
							<input class="form-control" type="text" name="category_title" id="category_title" value="<?php echo @$category->category_title; ?>" required />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Detail</label>
						<div class="col-md-4">
							<textarea class="form-control" name="category_description" id="category_description"><?php echo @$category->category_description;?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Status</label>
						<div class="col-md-4">
				            <select name="category_status" class="form-control">
				            	<option value="1" <?php if(@$category->category_status == 1){ echo 'selected';} ?>>Show</option>
				                <option value="2" <?php if(@$category->category_status == 2){ echo 'selected';} ?>>Hide</option>
				            </select>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-3">
						</div>
						<div class="col-md-4">
							<input type="hidden" name="categoryid" value="<?php echo $this->uri->segment(3);?>" />
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
	$("#formholder").validate();
	$(".checkbox").uniform();
 	$(".radio").uniform();
 })
</script>