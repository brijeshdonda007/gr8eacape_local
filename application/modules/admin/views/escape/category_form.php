<div class="bodyfloatleft">
<div class="bodytop">

	<?php if($this->uri->segment(3) == '') {echo '<h3>Add New Category</h3>'; } else { echo '<h3>Edit Category</h3>';} ?>

    

    <form id="formholder" class="formholder" action="<?php echo site_url('admin/addeditcategory'); ?>" method="post">

    

    	<input type="hidden" name="page_id" value="<?php echo @$category->id; ?>" />

    	

        <fieldset>

			<label>Title <span class="required">* required</span></label>

			<input class="inputlarge" type="text" name="category_title" value="<?php echo @$category->category_title; ?>" required="1" />

		</fieldset>

        

        <fieldset>

                        <label>Detail</label>

                

                        <textarea name="category_description"><?php echo @$category->category_description;?></textarea>

        </fieldset>

        

        

        <fieldset>

        	<label>Status</label>

            <select name="category_status">

            	<option value="1" <?php if(@$category->category_status == 1){ echo 'selected';} ?>>Show</option>

                <option value="2" <?php if(@$category->category_status == 2){ echo 'selected';} ?>>Hide</option>

            </select>

        </fieldset>

        

        <fieldset>

            <input type="hidden" name="categoryid" value="<?php echo $this->uri->segment(3);?>" />

              	<button type="submit" class="buttonBlue">Submit</button>

        </fieldset>



    </form>

</div>
    
</div>