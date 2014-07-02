<div class="row">
  <div class="col-md-12">
    <div class="panel">
      <div class="panel-heading">
        <div class="panel-title"> <i class="fa fa-pencil"></i> <?php echo @$form_title;?> </div>
      </div>
      <div class="panel-body">
        <form class="form-horizontal formholder" method="post" id ="formholder" name="formholder" enctype="multipart/form-data" action="<?php echo site_url('admin/addeditCountry');?>">
          <div class="form-group">
            <label class="col-md-3 control-label">Country Name</label>
            <div class="col-md-4">
              <input class="form-control" type="text" name="country_name" value="<?php echo @$country->country_name;?>" required/>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Status</label>
            <div class="col-md-4">
              <label class="radio-inline"><input class="radio" type="radio" name="status" value="1" <?php if((@$country->status == '1') or !isset($country)) { ?>checked<?php }?>/> Active</label>
              <label class="radio-inline"><input class="radio" type="radio" name="status" value="0" <?php if(@$country->status == '0') { ?>checked<?php }?> /> Inactive</label>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-3">
            </div>
            <div class="col-md-4">
              <input type="hidden" name="countryid" value="<?php echo @$this->uri->segment(3);?>" />
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