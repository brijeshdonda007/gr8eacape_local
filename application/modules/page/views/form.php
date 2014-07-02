<div class="bodyfloatleft">
<div class="bodytop">

	<?php if($this->uri->segment(3) == '') {echo '<h3>Add New Page</h3>'; } else { echo '<h3>Edit Page</h3>';} ?>

    

    <form id="formholder" class="formholder" action="<?php echo site_url('page/addUpdatePage'); ?>" enctype="multipart/form-data" method="post">

    

    	<input type="hidden" name="page_id" value="<?php echo @$page_content->id; ?>" />

    	

        <fieldset>

			<label>Title <span class="required">* required</span></label>

			<input class="inputlarge" type="text" name="page_title" value="<?php echo @$page_content->page_name; ?>" required="1" />

		</fieldset>

        

        <fieldset>

                        <label>Content</label>

                

        <?php

                if(isset($page_content)) $value = stripslashes($page_content->page_description);

                elseif($this->input->post('content')) $value = stripslashes($this->input->post('content'));

				

               echo form_fckeditor('content', $value);

            ?>

                        <?php echo form_error('content');?>

        </fieldset>

        

        <fieldset>

			<label>Featured Image</label>

            <input type="hidden" name="old_img" id="old_img" value="<?php echo base_url().'images/page_img/'.@$page_content->page_image; ?>" />

			<input class="inputmedium" type="file" name="featured_image">

		</fieldset>

        

        <fieldset>

        	<label>Status</label>

            <select name="status">

            	<option value="1" <?php if(@$page_content->status == 1){ echo 'selected';} ?>>Show</option>

                <option value="2" <?php if(@$page_content->status == 2){ echo 'selected';} ?>>Hide</option>

            </select>

        </fieldset>

        

         <fieldset>

            <label>Meta Keywords</label>

            <textarea class="inputlarge" id="ckeditor" rows="7" name="meta_keywords" cols="40"><?php echo @$page_content->meta_keywords; ?></textarea>

        </fieldset>

        

        <fieldset>

        	<label>Meta Description</label>

            <textarea class="inputlarge" rows="7" name="meta_description" cols="40"><?php echo @$page_content->meta_description; ?></textarea>

        </fieldset>

        

        <fieldset>

              	<button type="submit" class="buttonBlue">Submit</button>

        </fieldset>



    </form>

</div>
</div>