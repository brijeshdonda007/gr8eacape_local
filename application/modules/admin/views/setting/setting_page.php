<div class="row">
  <div class="col-md-12">
    <div class="panel">
      <div class="panel-heading">
        <div class="panel-title"> <i class="fa fa-pencil"></i> Settings </div>
      </div>
      <div class="panel-body">
        <form class="form-horizontal formholder" method="post" id ="formholder" name="formholder" enctype="multipart/form-data" action="<?php echo site_url('admin/addUpdateSetting');?>">
            <input type="hidden" name="setting_id" value="<?php  echo @$settings[0]->id; ?>">
          <div class="form-group">
            <label class="col-md-3 control-label">Government Tax</label>
            <div class="col-md-4">
                <div class="input-group margin-bottom">
                  <input class="form-control" type="text" name="gst" value="<?php echo @$settings[0]->government_tax; ?>" />
                  <span class="input-group-addon"><i class="fa">%</i></span>
                </div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Service Tax</label>
            <div class="col-md-4">
                <div class="input-group margin-bottom">
                  <input class="form-control" type="text" name="service_tax" value="<?php echo @$settings[0]->site_service_tax; ?>" />
                  <span class="input-group-addon"><i class="fa">%</i></span>
                </div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Site Title</label>
            <div class="col-md-4">
              <input class="form-control" type="text" name="site_title" value="<?php echo @$settings[0]->site_title; ?>"  />
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Site Email</label>
            <div class="col-md-4">
                <div class="input-group margin-bottom">
                    <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                    <input class="form-control" type="text" name="email" value="<?php echo @$settings[0]->contact_email; ?>" />
                </div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Facebook Link</label>
            <div class="col-md-4">
              <input class="form-control" type="text" name="facebook" value="<?php echo @$settings[0]->facebook_link; ?>" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Twitter Link</label>
            <div class="col-md-4">
              <input class="form-control" type="text" name="twitter" value="<?php echo @$settings[0]->twitter_link; ?>"  />
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Youtube Video Id</label>
            <div class="col-md-4">
              <input class="form-control" type="text" name="video" value="<?php echo @$settings[0]->video_link; ?>"  />
              <span class="help-block margin-top-sm">Id of the video only</span>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Meta Title</label>
            <div class="col-md-4">
              <input class="form-control" type="text" name="meta_title" value="<?php echo @$settings[0]->meta_title; ?>" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Meta Keyword</label>
            <div class="col-md-4">
              <textarea class="form-control" rows="5" name="meta_keywords" cols="40"><?php echo @$settings[0]->meta_keyword; ?></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Meta Description</label>
            <div class="col-md-4">
              <textarea class="form-control" rows="5" name="meta_description" cols="40"><?php echo @$settings[0]->meta_description; ?></textarea>
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