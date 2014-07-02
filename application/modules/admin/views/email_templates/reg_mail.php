<div class="row">
  <div class="col-md-12">
    <div class="panel">
      <div class="panel-heading">
        <div class="panel-title"> <i class="fa fa-pencil"></i> <?php echo @$form_title;?> </div>
      </div>
      <div class="panel-body">
        <form class="form-horizontal formholder" method="post" id ="formholder" name="formholder" enctype="multipart/form-data" action="<?php echo site_url('admin/update_reg_mail_template');?>">
          <div class="form-group">
            <div class="col-md-8">
                <?php
                if(isset($content)) $value = stripslashes($content->content);
                elseif($this->input->post('content')) $value = stripslashes($this->input->post('content'));
                echo form_fckeditor('content', @$value);
                ?>
                <?php echo form_error('content');?>
            </div>
			<div class="col-md-4">
				<h4>Here are variables. Please don't change symbol in mail template.</h4>
				<table class="table table-ordered table-striped">
					<tbody>
						<tr>
							<td>First Name</td>
							<td>$first_name</td>
						<tr>
						<tr>
							<td>Link for account activation</td>
							<td>$url</td>
						<tr>
						<tr>
							<td>User Name</td>
							<td>$user_name</td>
						<tr>
					</tbody>
				</table>
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