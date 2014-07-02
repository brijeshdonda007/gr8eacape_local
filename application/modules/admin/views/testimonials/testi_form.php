<div class="row">
  <div class="col-md-12">
    <div class="panel">
      <div class="panel-heading">
        <div class="panel-title"> <i class="fa fa-pencil"></i> <?php echo @$form_title;?> </div>
      </div>
      <div class="panel-body">
        <form class="form-horizontal formholder" method="post" id ="formholder" name="formholder" enctype="multipart/form-data" action="<?php echo site_url('admin/addeditCountry');?>">
          <div class="form-group">
            <label class="col-md-3 control-label">Guest Name</label>
            <div class="col-md-4">
              <input class="form-control" type="text" name="guest_name" value="<?php echo @$sigle_testi->guest_name;?>" required />
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Guest Image:</label>
            <div class="col-md-4">
				<?php if(@$city->featured_image) {?>
				Current Image:<img width="80" src="<?php echo base_url();?>images/testimonials/<?php echo @$sigle_testi->image; ?>" /><br/>
				<?php }?>
				<input type="file" placeholder="" class="form-control" name="image" value="">
				<input type="hidden" name="old_image" value="<?php echo @$sigle_testi->image; ?>" />New Image
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Content</label>
            <div class="col-md-8">
				<?php if(isset($sigle_testi)) $value = stripslashes($sigle_testi->detail);
					elseif($this->input->post('detail')) $value = stripslashes($this->input->post('detail'));
					echo form_fckeditor('detail', @$value); ?>
					<?php echo form_error('detail');?>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-3">
            </div>
            <div class="col-md-4">
				<input type="hidden" name="testi_id" value="<?php echo @$this->uri->segment(3);?>" />
				<button type="submit" class="btn btn-success">Submit</button>
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
  $("#formholder").validate();
 })
</script>