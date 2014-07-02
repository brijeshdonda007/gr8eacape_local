<div class="bodyfloatleft">
	<div class="bodytop">
		<h3><?php echo @$form_title;?></h3>
		<form class="formholder" method="post" id ="formholder" name="formholder" action="<?php echo base_url();?>testimonials/addeditTesti" enctype="multipart/form-data">
			<fieldset>
				<label>Guest Name</label>
				<input class="inputmedium" type="text" name="guest_name" value="<?php echo @$sigle_testi->guest_name;?>" required="1" />
			</fieldset>
			<fieldset>
				<label class="control-label">Guest Image:</label>
				<?php if(@$city->featured_image) {?>
				Current Image:<img width="80" src="<?php echo base_url();?>images/testimonials/<?php echo @$sigle_testi->image; ?>" /><br/>
				<?php }?>
				<input type="file" placeholder="" class="input-large" name="image" value="">
				<input type="hidden" name="old_image" value="<?php echo @$sigle_testi->image; ?>" />New Image
			</fieldset>
			<fieldset>
				<label>Content</label>
				<?php if(isset($sigle_testi)) $value = stripslashes($sigle_testi->detail);
					elseif($this->input->post('detail')) $value = stripslashes($this->input->post('detail'));
					echo form_fckeditor('detail', @$value); ?>
					<?php echo form_error('detail');?>
			</fieldset>
			<fieldset>
				<input type="hidden" name="testi_id" value="<?php echo @$this->uri->segment(3);?>" />
				<button type="submit" class="buttonBlue">Submit</button>
			</fieldset>
		</form>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('#country_id').change(function(){
			if($(this).val() > 0){
				$('#region-div').html('Loading...');
				$.ajax({
					url: "<?php echo base_url();?>ajax/getRegionAjax/"+$(this).val(),
					success: function(data){
						$('#region-div').html(data);
					}
				});
			}
		});
	});
</script>