<div class="row">
  <div class="col-md-12">
    <div class="panel">
      <div class="panel-heading">
        <div class="panel-title"> <i class="fa fa-pencil"></i> <?php echo @$form_title;?> </div>
      </div>
      <div class="panel-body">
        <form class="form-horizontal formholder" method="post" id ="formholder" name="formholder" enctype="multipart/form-data" action="<?php echo site_url('admin/addUpdatePage');?>">
            <input type="hidden" name="page_id" value="<?php echo @$page_content->id; ?>" />
          <div class="form-group">
            <label class="col-md-3 control-label">Page Name</label>
            <div class="col-md-4">
              <input class="form-control" type="text" name="page_name" value="<?php echo @$page_content->page_name; ?>" required />
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Content</label>
            <div class="col-md-8">
                <?php
                if(isset($page_content)) $value = stripslashes($page_content->page_description);
                elseif($this->input->post('content')) $value = stripslashes($this->input->post('content'));
                echo form_fckeditor('content', @$value);
                ?>
                <?php echo form_error('content');?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Status</label>
            <div class="col-md-4">
                <select name="status" class="form-control">
                    <option value="1" <?php if(@$page_content->status == 1){ echo 'selected';} ?>>Show</option>
                    <option value="2" <?php if(@$page_content->status == 2){ echo 'selected';} ?>>Hide</option>
                </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Page Title</label>
            <div class="col-md-4">
              <input class="form-control" id="ckeditor" rows="7" name="page_title" value="<?php echo @$page_content->page_title; ?>" />            
              </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Page Description</label>
            <div class="col-md-4">
              <textarea class="form-control" rows="7" name="meta_description" cols="40"><?php echo @$page_content->meta_description; ?></textarea>
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