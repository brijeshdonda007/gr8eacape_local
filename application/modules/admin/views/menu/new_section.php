<div class="row">
  <div class="col-md-12">
    <div class="panel">
      <div class="panel-heading">
        <div class="panel-title"> <i class="fa fa-pencil"></i> Add new menu section </div>
      </div>
      <div class="panel-body">
        <form class="form-horizontal formholder" method="post" id ="formholder" name="formholder" enctype="multipart/form-data" action="<?php echo site_url('admin/add_new_menu_section');?>">
          <div class="form-group">
            <label class="col-md-3 control-label">Section Name</label>
            <div class="col-md-4">
              <input class="form-control" type="text" name="section_name" value="" required />
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Status</label>
            <div class="col-md-4">
                <select name="status" class="form-control">
                    <option value="1">Enable</option>
                    <option value="0">Disable</option>
                </select>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-3">
            </div>
            <div class="col-md-4">
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
});
</script>