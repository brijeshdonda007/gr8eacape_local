<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <div class="panel-title"> <i class="fa fa-pencil"></i> <?php echo @$form_title; ?> </div>
            </div>
            <div class="panel-body">
                <form class="form-horizontal formholder" method="post" id ="formholder" name="formholder" enctype="multipart/form-data" action="<?php echo site_url('admin/addupdatebanner');?>">
                    <input type="hidden" name="bannerid" value="<?php echo @$banner_content->id; ?>" />
                    <div class="form-group">
                        <label class="col-md-3 control-label">Name</label>
                        <div class="col-md-4">
                            <input class="form-control" type="text" name="banner_name" id="banner_name" value="<?php echo @$banner_content->banner_title; ?>" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Banner Link</label>
                        <div class="col-md-4">
                            <input class="form-control" type="text" name="banner_link" id="banner_link" value="<?php echo @$banner_content->banner_link; ?>" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Banner Image</label>
                        <div class="col-md-4">
                            <input type="file" name="banner" class="form-control" value="<?php //echo @$banner_content->image; ?>" id="banner" /> <br>
                            <img  src="<?php echo base_url().'images/banner_img/'.@$banner_content->image; ?>" width="100" height="70" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Detail</label>
                        <div class="col-md-4">
                            <textarea class="form-control" name="banner_description" id="banner_description"><?php echo @$banner_content->banner_description;?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Status</label>
                        <div class="col-md-4">
                            <select name="status" class="form-control">
                                <option value="1" <?php if(@$banner_content->status == 1){ echo 'selected';} ?>>Show</option>
                                <option value="2" <?php if(@$banner_content->status == 2){ echo 'selected';} ?>>Hide</option>
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
    $(".checkbox").uniform();
    $(".radio").uniform();
 })
</script>