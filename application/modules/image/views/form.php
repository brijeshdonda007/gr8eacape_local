<div class="bodytop">

	<?php if($this->uri->segment(3) == '') {echo '<h3>Add New Page</h3>'; } else { echo '<h3>Edit Page</h3>';} ?>

    

    <form class="formholder" action="<?php echo site_url('image/addUpdateImage'); ?>" enctype="multipart/form-data" method="post">

    

    	<input type="hidden" name="page_id" value="<?php echo @$page_content->id; ?>" />

    	

        <fieldset>

			<label>Title <span>* required</span></label>

			<input class="inputlarge" type="text" name="image_name" value="" />

		</fieldset>

        

        <fieldset>

                        <label>Image</label>

                        <input class="inputlarge" type="file" name="image" value="" />

                </fieldset>

        

        

        

        

        

        

        

        <fieldset>

              	<input type="submit" value="Submit" />

        </fieldset>



    </form>

</div>