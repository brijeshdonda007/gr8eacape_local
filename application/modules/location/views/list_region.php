    <div class="bodytop">

    <h1>List Region</h1>

   

    <a href="<?php echo base_url();?>location/newRegion" class="add-new pull-right">Add New Region</a>

    	<table class="tabulardata" cellpadding="0" cellspacing="0">

        	<tr>

            	<th>Region Name</th>

                <th>Country</th>

                <th>Featured Image</th>

                <th>Status</th>

                <th>Action</th>

            </tr>

            <?php

            $sn=1;

            foreach($all_region as $ar):

            ?>

            <tr <?php if($sn%2 == 0) {  echo 'class="tablealternate"'; }?>>

            	<td><?php echo $ar['region_name'];?></td>

                <td><?php echo $ar['country_name'];?></td>

                <td><img width="50" src="<?php echo base_url();?>images/region/thumb/<?php echo $ar['featured_image'];?>" /></td>

                <td><?php if($ar['region_status'] == '1') { echo 'Active'; } else { echo 'Inactive';}?></td>

                <td colspan="2"><a href="<?php echo base_url();?>location/editRegion/<?php echo $ar['id'];?>">Edit</a> <a href="<?php echo base_url();?>location/deleteRegion/<?php echo $ar['id'];?>" onclick="return confirm('Are you sure to delete?')">Delete</a></td>

          

            	

            </tr>

             <?php $sn++; endforeach; ?>

            

        </table>

    <?php echo $links; ?>

    </div>

