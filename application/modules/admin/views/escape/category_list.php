<div class="bodytop">

<h1>List Category</h1>

 <a class="pull-right btn btn-primary btn-gradient" href="<?php echo site_url('admin/loadcategoryform'); ?>">Add New Category</a>

    	<table class="tabulardata" cellpadding="0" cellspacing="0">

        	<tr>

            	<th>Category Name</th>

                <th>Category Description</th>

                <th>Status</th>

                <th>Action</th>

            </tr>

            <?php

            $sn=1;

            foreach($all_category as $alc):

            ?>

            <tr <?php if($sn%2 == 0) {  echo 'class="tablealternate"'; }?> id="row_<?php echo $alc->id; ?>">

            	<td><?php echo $alc->category_title;?></td>

                <td><?php echo $alc->category_description;?></td>

                <td><?php if($alc->category_status == '1') { echo 'Active'; } else { echo 'Inactive';}?></td>

                <td colspan="2"><a href="<?php echo base_url();?>escape/editCategory/<?php echo $alc->id;?>">Edit</a> <a href="<?php echo base_url();?>escape/deleteCategory/<?php echo $alc->id;?>" onclick="return confirm('Are you sure to delete?')">Delete</a></td>

          

            	

            </tr>

             <?php $sn++; endforeach; ?>

            

        </table>

    <div class="pagination"><?php echo $links; ?></div>

    </div>

    

