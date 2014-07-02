<div class="row">
  <div class="col-md-12">
    <div class="panel">
      <div class="panel-heading">
        <div class="panel-title"> <i class="fa fa-pencil"></i> <?php echo @$form_title;?> </div>
      </div>
      <div class="panel-body">
        <form class="form-horizontal formholder" method="post" id ="formholder" name="formholder" enctype="multipart/form-data" action="<?php echo site_url('admin/addeditRegion');?>">
          <div class="form-group">
            <label class="col-md-3 control-label">Region Name</label>
            <div class="col-md-4">
              <input class="form-control" type="text" name="region_name" value="<?php echo @$region->region_name;?>" required />
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Country</label>
            <div class="col-md-4">
              <select name="country_id" class="form-control" required="1">
                <option value="">All Countries</option>
                <?php
                foreach ($countries as $cn):
                ?>
                <option value="<?php echo $cn->id;?>" <?php if(isset($region) and ($cn->id == $region->country_id)){ ?>selected<?php }?>><?php echo $cn->country_name?></option>
                <?php
                endforeach;
                ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Featured Image:</label>
            <div class="col-md-4">
              <?php if(@$region->featured_image) {?>
              Current Image:<img width="80" src="<?php echo base_url();?>images/region/thumb/<?php echo @$region->featured_image; ?>" /><br/>
              <?php }?>
              <input type="file" placeholder="" class="form-control" name="featured_image" value="">&nbsp;&nbsp;New Image
              <input type="hidden" name="old_featured_image" value="<?php echo @$region->featured_image; ?>" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Status</label>
            <div class="col-md-4">
              <label class="radio-inline"><input class="radio" type="radio" name="status" value="1" <?php if((@$region->region_status == '1') or !isset($country)) { ?>checked<?php }?>/> Active</label>
              <label class="radio-inline"><input class="radio" type="radio" name="status" value="0" <?php if(@$region->region_status == '0') { ?>checked<?php }?> /> Inactive</label>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-3">
            </div>
            <div class="col-md-4">
              <input type="hidden" name="region_id" value="<?php echo @$this->uri->segment(3);?>" />
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
  $("#formholder").validate();
 })
</script>