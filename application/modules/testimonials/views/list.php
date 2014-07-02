<div class="bodytop">
    <h1>List Testimonials</h1>
    <a class="pull-right" href="<?php echo base_url();?>testimonials/newTesti" class="add-new">Add New</a>
    	<table class="tabulardata" cellpadding="0" cellspacing="0">
        	<tr>
            	<th>Guest Name</th>
                <th>Detail</th>
                <th>Profile Image</th>
                <th>Action</th>
            </tr>
            <?php
            $sn=1;
            foreach($testimonials as $tm):
            ?>
            <tr <?php if($sn%2 == 0) {  echo 'class="tablealternate"'; }?>>
                <td><?php echo $tm->guest_name;?></td>
            	<td><?php echo word_limiter($tm->detail, 10);?></td>
                <td>
                	<?php if (!empty($tm->image)){ ?>
                		<img width="50" src="<?php echo base_url();?>images/testimonials/<?php echo $tm->image;?>" />
                	<?php } else if (!empty($tm->profile_picture)) { ?>
                		<img width="50" src="<?php echo base_url();?>images/profile_img/thumb/<?php echo $tm->profile_picture;?>" />
                	<?php } else { ?>
                		<img width="50" src="<?php echo base_url();?>assets/frontend/images/no-image.png" />
                	<?php } ?>
                </td>
                <td colspan="2"><a href="<?php echo base_url();?>testimonials/editTesti/<?php echo $tm->id;?>">Edit</a> <a href="<?php echo base_url();?>testimonials/deleteTesti/<?php echo $tm->id;?>" onclick="return confirm('Are you sure to delete?')">Delete</a></td>
            </tr>
             <?php $sn++; endforeach; ?>
        </table>
    <div class="pagination"><?php echo $links; ?></div>
</div>