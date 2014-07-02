<div class="row">
  <div class="col-md-12">
    <div class="panel">
      <div class="panel-heading">
        <div class="panel-title"> <i class="fa fa-pencil"></i> <?php echo @$form_title;?> </div>
      </div>
      <div class="panel-body">
        <form class="form-horizontal formholder" method="post" id ="formholder" name="formholder" enctype="multipart/form-data" action="<?php echo site_url('admin/addeditCity');?>">
          <div class="form-group">
            <label class="col-md-3 control-label">City Name</label>
            <div class="col-md-4">
              <input class="form-control" type="text" name="region_name" value="<?php echo @$city->city_name;?>" required />
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Country</label>
            <div class="col-md-4">
              <select name="country_id" id="country_id" class="form-control" required >
                <option value="">All Countries</option>
                <?php
                foreach ($countries as $cn):
                ?>
                <option value="<?php echo $cn->id;?>" <?php if(isset($city) and ($cn->id == @$city->country_id)) { ?>selected<?php }?>><?php echo $cn->country_name?></option>
                <?php
                endforeach;
                ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Region</label>
            <div class="col-md-4">
              <div id="region-div">
              <select name="region_id" class="form-control" required >
                <option value="">All Regions</option>
                <?php
                foreach($regions as $rn)
                {
                ?>
                  <option value="<?php echo $rn->id; ?>" <?php if($city->region_id == $rn->id ){ echo 'selected'; }?>><?php echo $rn->region_name; ?></option>
                <?
                }
                ?>
              </select>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Featured Image:</label>
            <div class="col-md-4">
              <?php if(@$city->featured_image) {?>
              Current Image:<img width="80" src="<?php echo base_url();?>images/region/thumb/<?php echo @$city->featured_image; ?>" /><br/>
              <?php }?>
              <input type="file" placeholder="" class="form-control input-large" name="featured_image" value="">&nbsp;&nbsp;New Image
              <input type="hidden" name="old_featured_image" value="<?php echo @$city->featured_image; ?>" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Status</label>
            <div class="col-md-4">
              <label class="radio-inline"><input class="radio" type="radio" name="city_status" value="1" <?php if((@$city->city_status == '1') or !isset($city)) { ?>checked<?php }?> /> Active</label>
              <label class="radio-inline"><input class="radio" type="radio" name="city_status" value="0" <?php if(@$city->city_status == '0') { ?>checked<?php }?> /> Inactive</label>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-3">
            </div>
            <div class="col-md-4">
              <input type="hidden" name="city_id" value="<?php echo @$this->uri->segment(3);?>" />
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
  $('#country_id').change(function()
  {
    if($(this).val() > 0)
    {
      $('#region-div').html('Loading...');
      $.ajax({
        url: "<?php echo base_url();?>ajax/getRegionAjax/"+$(this).val(),
        success: function(data){
          $('#region-div').html(data);
        }
      });
    }
  });
 })
</script>